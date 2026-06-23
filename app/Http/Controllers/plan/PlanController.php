<?php

namespace App\Http\Controllers\plan;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use App\Models\User;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index(User $user)
    {
        $this->middleware('auth');

        if ($user->id === auth()->user()->id) {
            $suscription = Pay::where('estado', 'SUSCRITO')->where('user_id', auth()->user()->id)->first();

            if (!$suscription) {
                return redirect()->route('mercadopago.suscription.subscribe');
            } else {
                return view('visitador.plan.index', [
                    'user' => $user,
                    'suscription' => $suscription
                ]);
            }
        } else {
            echo "no puedes ver el plan de otro usuario :(";
        }
    }

    public function show()
    {
        return view('visitador.plan.show');
    }
}
