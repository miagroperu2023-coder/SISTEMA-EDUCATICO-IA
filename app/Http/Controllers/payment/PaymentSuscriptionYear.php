<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Mail\EnviarCorreoSuscripcion;
use App\Models\Pay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\SDK;

class PaymentSuscriptionYear extends Controller
{
    //
    public function suscription(Request $request)
    {
        // Agrega credenciales
        SDK::setAccessToken(config('mercadopago.token'));
        $public_key = config('mercadopago.public_key');
        $preference = new Preference();
        $curso = [];

        // Crea un ítem en la preferencia
        $count = 1;
        while ($count <= 1) {
            $item = new Item();
            $item->title = 'PLAN-DOCE-MESES';
            $item->description = 'Pago suscripción EduPeruApp 12 meses';
            $item->quantity = $count;
            $item->unit_price = config('mercadopago.plan_doce_meses'); //179.88
            $count = $count + 1;

            $curso[] = $item;
        }

        //dd($curso);
        $preference->items = $curso;

        $preference->back_urls = [
            'success' => route('mercadopago.suscription.year.success'),
            'failure' => route('mercadopago.suscription.year.failure'),
            'pending' => route('mercadopago.suscription.year.pending'),
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



    public function success(Request $request)
    {
        Log::info('payment Received 12 meses:', $request->all());

        if (isset($request->collection_id)) {
            $pay = Pay::create([
                'user_id' => auth()->user()->id,
                'collection_id' => $request->collection_id ?? '',
                'collection_status' => 'PLAN-DOCE-MESES',
                'payment_id' => $request->payment_id ?? '',
                'status' => 'PAGO SUSCRIPCION',
                'external_reference' =>  $request->external_reference ?? '',
                'payment_type' => $request->payment_type ?? '',
                'merchant_order_id' => $request->merchant_order_id ?? '',
                'preference_id' => $request->preference_id ?? '',
                'site_id' => 'MPE',
                'processing_mode' => 'ONLINE',
                'merchant_account_id' => $request->merchant_account_id ?? '',
                'estado' => 'SUSCRITO',
                'date_start' => Carbon::now()->toDateString(),
                'date_end' => Carbon::now()->addMonths(12)->toDateString(),
            ]);

            if ($pay) {
                Mail::to([auth()->user()->email, 'anthony.anec@gmail.com'])->send(new EnviarCorreoSuscripcion(auth()->user()));
                return redirect()->route('visitador.course.index')->with('mensaje', '¡El pago de tu suscripción se ha procesado correctamente! Ahora tienes acceso ilimitado a nuestros beneficios. ¡Te deseamos mucho éxito!');
            } else {
                return redirect()->route('visitador.course.index')->with('mensaje', 'Tu pago no se registró en nuestra base de datos, pero ya tienes acceso como usuario Premium.');
            }
        } else {
            return redirect()->route('mercadopago.suscription.six.failure');
        }
    }

    public function failure()
    {
        return view('payment.failure');
    }

    public function pending()
    {
        return view('payment.pending');
    }
}
