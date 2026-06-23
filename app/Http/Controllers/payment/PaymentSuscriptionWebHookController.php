<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MercadoPago\Preapproval;
use MercadoPago\Payment;
use MercadoPago\SDK;

class PaymentSuscriptionWebHookController extends Controller
{
    public function index(Request $request)
    {
        // 1. Obtener el payload del webhook en formato JSON
        $payloadRaw   = $request->getContent();
        $payloadArray = json_decode($payloadRaw, true);

        Log::info('🌐 Webhook recibido:', $payloadArray);

        // 2. Validar que tenga lo mínimo
        if (!isset($payloadArray['data']['id']) || !isset($payloadArray['type'])) {
            Log::error('❌ Datos incompletos o incorrectos recibidos del webhook: ' . $payloadRaw);
            return response()->json(['status' => 'error', 'message' => 'Invalid payload'], 400);
        }

        $eventId   = $payloadArray['data']['id'];
        $eventType = $payloadArray['type'];

        // 3. Configurar credenciales de Mercado Pago
        SDK::setAccessToken(config('mercadopago.token'));

        switch ($eventType) {
            /**
             * 🚀 Caso 1: Suscripciones recurrentes (tarjeta cada mes)
             */
            case 'preapproval':
                $preapproval = $this->obtenerDetalleSuscripcion($eventId);

                if (!$preapproval || !isset($preapproval->status)) {
                    Log::error("❌ No se pudo obtener información de la suscripción $eventId");
                    return response()->json(['status' => 'error', 'message' => 'Preapproval not found'], 404);
                }

                if ($preapproval->status === 'authorized') {
                    // Crear o actualizar suscripción
                    Pay::updateOrCreate(
                        ['payment_id' => $eventId],
                        [
                            'user_id'           => $preapproval->external_reference ?? 1,
                            'collection_id'     => $preapproval->id,
                            'collection_status' => 'PLAN-PRE-UNI',
                            'status'            => 'PAGO SUSCRIPCION',
                            'external_reference' => $preapproval->external_reference ?? '',
                            'payment_type'      => 'TARJETA',
                            'merchant_order_id' => $preapproval->auto_recurring->transaction_amount ?? '',
                            'preference_id'     => $eventId,
                            'site_id'           => 'MPE',
                            'processing_mode'   => 'ONLINE',
                            'merchant_account_id' => '',
                            'estado'            => 'POR ATENDER',
                        ]
                    );

                    Log::info("✅ Suscripción recurrente autorizada: $eventId");
                } elseif (in_array($preapproval->status, ['rejected', 'cancelled'])) {
                    Pay::where('payment_id', $eventId)->update(['estado' => 'CANCELADO']);
                    Log::warning("⚠️ Suscripción cancelada/rechazada: $eventId");
                }
                break;

            /**
                 * 🚀 Caso 2: Pagos únicos (Yape, PagoEfectivo, Plin, tarjeta única, etc.)
                 */
            case 'payment':
                $payment = $this->obtenerDetallePago($eventId);

                if (!$payment || !isset($payment->status)) {
                    Log::error("❌ No se pudo obtener información del pago $eventId");
                    return response()->json(['status' => 'error', 'message' => 'Payment not found'], 404);
                }

                if ($payment->status === 'approved') {
                    Pay::updateOrCreate(
                        ['payment_id' => $payment->id],
                        [
                            'user_id'           => $payment->external_reference ?? 1,
                            'collection_id'     => $payment->id,
                            'collection_status' => $payment->status,
                            'status'            => 'PAGO UNICO',
                            'external_reference' => $payment->external_reference ?? '',
                            'payment_type'      => $payment->payment_type_id, // ej: yape, account_money, ticket, card
                            'merchant_order_id' => $payment->order->id ?? '',
                            'preference_id'     => $payment->additional_info->items[0]->id ?? '',
                            'site_id'           => $payment->site_id ?? 'MPE',
                            'processing_mode'   => $payment->processing_mode ?? 'ONLINE',
                            'merchant_account_id' => $payment->merchant_account_id ?? '',
                            'estado'            => 'POR ATENDER',
                        ]
                    );

                    Log::info("✅ Pago único aprobado ({$payment->payment_type_id}): {$payment->id}");
                } elseif (in_array($payment->status, ['rejected', 'cancelled'])) {
                    Pay::where('payment_id', $payment->id)->update(['estado' => 'CANCELADO']);
                    Log::warning("⚠️ Pago único rechazado/cancelado: {$payment->id}");
                }
                break;

            default:
                Log::notice("ℹ️ Evento no contemplado: $eventType");
                break;
        }

        return response()->json(['status' => 'success'], 200);
    }

    // 🔹 Función para consultar el estado de la suscripción
    private function obtenerDetalleSuscripcion($preapprovalId)
    {
        try {
            return Preapproval::find_by_id($preapprovalId);
        } catch (\Throwable $th) {
            Log::error("Error al obtener detalles de la suscripción $preapprovalId: " . $th->getMessage());
            return null;
        }
    }

    // 🔹 Función para consultar el estado de un pago único
    private function obtenerDetallePago($paymentId)
    {
        try {
            return Payment::find_by_id($paymentId);
        } catch (\Throwable $th) {
            Log::error("Error al obtener detalles del pago $paymentId: " . $th->getMessage());
            return null;
        }
    }
}
