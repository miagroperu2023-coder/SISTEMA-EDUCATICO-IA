<?php

namespace App\Http\Livewire\Admin;

use App\Mail\MailUserCursoAutorizarController;
use App\Mail\MailUserCursoRechazadoController;
use App\Models\Course;
use App\Models\Pay;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use MercadoPago\SDK;
use MercadoPago\Preapproval;

use Livewire\Component;

class Pays extends Component
{
    public $pays;

    public $pay_id;
    public $payment_id;
    public $status;
    public $payment_type;
    public $preference_id;
    public $estado;

    public $cancelSubscriptionMessage;



    public function mount()
    {
        //$this->pays = Pay::where('estado', '=', 'VALIDAR')->get();
        $this->reload();
    }

    public function render()
    {
        return view('livewire.admin.pays');
    }


    public function edit($id)
    {
        $pay = Pay::find($id);
        $this->pay_id = $pay->id;
        $this->payment_id = $pay->payment_id;
        $this->status = $pay->status;
        $this->payment_type = $pay->payment_type;
        $this->preference_id = $pay->preference_id;
        $this->estado = $pay->estado;
        $this->reload();
    }

    public function update()
    {
        $pay = Pay::find($this->pay_id);

        $pay->update([
            'estado' => 'AUTORIZADO'
        ]);

        $user = User::find($pay->user_id);
        $course = Course::find($pay->collection_id);

        Mail::to([$user->email, auth()->user()->email])->send(new MailUserCursoAutorizarController($course, $user));
        $this->reload();
        $this->resetInputFields();
    }

    //QUITAR EL CURSO AL USUARIO
    public function delete($id)
    {
        $pay = Pay::find($id);

        $pay->update([
            'estado' => 'RECHAZADO'
        ]);

        $user = User::find($pay->user_id);
        $course = Course::find($pay->collection_id);
        $course->students()->detach($user->id);

        Mail::to([$user->email, auth()->user()->email])->send(new MailUserCursoRechazadoController($course, $user));
        $this->reload();
        $this->resetInputFields();
    }

    public function cancelSuscription($id)
    {
        try {
            $pay = Pay::find($id);
            // Configura las credenciales de Mercado Pago
            SDK::setAccessToken(config('mercadopago.token'));

            // Obtén la instancia de Preapproval
            $preapproval = Preapproval::find_by_id($pay->preference_id);

            // Realiza la cancelación de la suscripción
            $preapproval->status = 'cancelled';
            $preapproval->update();

            // Verifica el estado de la suscripción después de la actualización
            $preapproval = Preapproval::find_by_id($pay->preference_id);

            if ($preapproval->status === 'cancelled') {
                $pay->update(['estado' => 'CANCELADO']);
                $this->cancelSubscriptionMessage = 'Suscripción cancelada con éxito';
                $this->reload();
            } else {
                $this->cancelSubscriptionMessage = 'No se pudo cancelar la suscripción';
                $this->reload();
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function activeSuscription($id)
    {
        try {
            $pay = Pay::find($id);
            // Configura las credenciales de Mercado Pago
            SDK::setAccessToken(config('mercadopago.token'));

            // Obtén la instancia de Preapproval
            $preapproval = Preapproval::find_by_id($pay->preference_id);

            // Realiza la cancelación de la suscripción
            $preapproval->status = 'active';
            $preapproval->update();

            // Verifica el estado de la suscripción después de la actualización
            $preapproval = Preapproval::find_by_id($pay->preference_id);

            if ($preapproval->status === 'active') {
                $pay->update(['estado' => 'SUSCRITO']);
                $this->cancelSubscriptionMessage = 'Suscripción activada con éxito';
                $this->reload();
            } else {
                $this->cancelSubscriptionMessage = 'No se pudo activar la suscripción';
                $this->reload();
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function reload()
    {
        $this->pays = User::join('pays', 'users.id', '=', 'pays.user_id')
            ->select(
                'users.*',
                'pays.id',
                'pays.payment_id',
                'pays.status',
                'pays.payment_type',
                'pays.preference_id',
                'pays.estado'
            )
            ->whereIn('pays.estado', ['CANCELADO', 'SUSCRITO'])
            ->get();
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->pay_id = '';
        $this->payment_id = '';
        $this->status = '';
        $this->payment_type = '';
        $this->preference_id = '';
        $this->estado = '';
    }
}
