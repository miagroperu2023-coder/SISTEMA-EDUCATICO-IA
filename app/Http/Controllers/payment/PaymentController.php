<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Mail\MailUserController;
use App\Models\Course;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use phpDocumentor\Reflection\Types\This;

class PaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Course $course)
    {
        //SI NO TIENE SUSCRIPCION ENTONCES PUEDE PAGAR CURSO INDIVIDUAL
        $this->authorize('notSubscription', auth()->user());
        
        //return $course;
        return view('payment.index', [
            'course' => $course
        ]);
    }

    //MERCADOPAGO
    public function pay(Request $request)
    {
        $course = Course::find($request->course_id);

        // Agrega credenciales
        SDK::setAccessToken(config('mercadopago.token'));
        $public_key = config('mercadopago.public_key');
        $preference = new Preference();
        $curso = [];

        // Crea un ítem en la preferencia
        $count = 1;
        while ($count <= 1) {
            $item = new Item();
            $item->title = $course->title;
            $item->description = $course->subtitle;
            $item->quantity = $count;
            $item->unit_price = $course->price->value;
            $count = $count + 1;

            $curso[] = $item;
        }

        //dd($curso);
        $preference->items = $curso;

        $preference->back_urls = [
            'success' => route('mercadopago.success', $course),
            'failure' => route('mercadopago.failure'),
            'pending' => route('mercadopago.pending'),
        ];
        $preference->auto_return = 'approved'; // Redirige automáticamente al usuario después de un pago aprobado


        // Guarda la preferencia
        $save = $preference->save();

        // Obtiene el link de pago
        $paymentLink = $preference->init_point;

        //dd($paymentLink);

        if ($save) {
            $dato = [
                'public_key' => $public_key,
                'preference_id' =>  $preference->id,
                'url' => $preference->back_urls,
                'init_point' => $paymentLink
            ];
            return response()->json([
                'code' => 1,
                'msg' => $dato
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => 'Error de Datos'
            ]);
        }
    }

    //MERCADOPAGO
    public function success(Request $request, Course $course)
    {
        //return $course;
        //puedes registrarlo en la base de datos
        if ($request->status === 'approved') {
            $pay = Pay::create([
                'user_id' => auth()->user()->id,
                'collection_id' => $course->id,
                'collection_status' => $request->collection_status,
                'payment_id' => $request->payment_id,
                'status' => $request->status,
                'external_reference' => $request->external_reference,
                'payment_type' => $request->payment_type,
                'merchant_order_id' => $request->merchant_order_id,
                'preference_id' => $request->preference_id,
                'site_id' => $request->site_id,
                'processing_mode' => $request->processing_mode,
                'merchant_account_id' => $request->merchant_account_id,
                'estado' => 'ACTIVO',
            ]);

            if ($pay) {
                //CADA VEZ QUE EL USUARIO LE DE CLICK EN "llevar curso" 
                //SE GUARDARA ESOS DATOS EN LA TABLA "course_user"
                $course->students()->attach(auth()->user()->id);

                return redirect()->route('visitador.course.status', $course);
            }
        }
        //else para las demos estados 
    }

    public function failure()
    {
        return redirect()->route('visitador.home.index')->with('mensaje', 'Se Canceló el Pago');
    }

    public function pending()
    {
        return redirect()->route('visitador.home.index')->with('mensaje', 'El pago se cuentra Pendiente');
    }

    //pagar con yape 
    public function yape(Request $request, Course $course)
    {
        $pay = Pay::create([
            'user_id' => auth()->user()->id,
            'collection_id' => $course->id,
            'collection_status' => 'INDIVIDUAL',
            'payment_id' => $request->payment_id,
            'status' => 'PAGO INDIVIDUAL',
            'external_reference' => '',
            'payment_type' => 'QR',
            'merchant_order_id' => '',
            'preference_id' => $request->payment_id,
            'site_id' => 'MPE',
            'processing_mode' => 'ONLINE',
            'merchant_account_id' => '',
            'estado' => 'VALIDAR',
        ]);

        if ($pay) {
            //CADA VEZ QUE EL USUARIO LE DE CLICK EN "llevar curso" 
            //SE GUARDARA ESOS DATOS EN LA TABLA "course_user"
            $course->students()->attach(auth()->user()->id);

            Mail::to([auth()->user()->email, 'anthony.anec@gmail.com'])->send(new MailUserController($course));

            return redirect()->route('visitador.course.status', $course)->with('mensaje', 'Agradecemos su adquisición del curso. El sistema verificará sus datos y le enviará un correo electrónico. Por favor, continúe con el curso.');
        } else {
            return redirect()->route('visitador.home.index')->with('mensaje', 'No fue posible generar el pago del curso. Por favor, póngase en contacto con el número +51 9922 394 642.');
        }
    }
}
