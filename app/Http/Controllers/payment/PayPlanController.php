<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;
use PHPUnit\Framework\Constraint\Count;

class PayPlanController extends Controller
{
    //

    public function descuentoPlanPreunicursos(Plan $plan)
    {
        $plan = Plan::find($plan->id);
        if ($plan->promo_code === 'SEMESTRAL20') {
            $precioOriginal  = config('mercadopago.plan_seis_meses');
        } else {
            $precioOriginal  = config('mercadopago.plan_doce_meses');
        }

        $precioDescuento = $precioOriginal - ($precioOriginal * ($plan->percentage / 100));
        SDK::setAccessToken(config('mercadopago.token'));
        $preference = new Preference();
        $curso = [];

        // Crea un ítem en la preferencia
        $count = 1;
        while ($count <= 1) {
            $item = new Item();
            $item->title = $plan->name . "-" . $plan->promo_code;
            $item->description = "EDUPERUAPP -" . $plan->promo_code;
            $item->quantity = $count;
            $item->unit_price = $precioDescuento; //
            $count = $count + 1;

            $curso[] = $item;
        }

        //dd($curso);
        $preference->items = $curso;

        if ($plan->promo_code === 'SEMESTRAL20') {
            $preference->back_urls = [
                'success' => route('mercadopago.suscription.six.success'),
                'failure' => route('mercadopago.suscription.six.failure'),
                'pending' => route('mercadopago.suscription.six.pending'),
            ];
        } else {
            $preference->back_urls = [
                'success' => route('mercadopago.suscription.year.success'),
                'failure' => route('mercadopago.suscription.year.failure'),
                'pending' => route('mercadopago.suscription.year.pending'),
            ];
        }

        $preference->auto_return = 'approved'; // Redirige automáticamente al usuario después de un pago aprobado

        // Guarda la preferencia
        $save = $preference->save();

        $paymentLink = $preference->init_point;

        if ($save) {
            $dato = [
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
}
