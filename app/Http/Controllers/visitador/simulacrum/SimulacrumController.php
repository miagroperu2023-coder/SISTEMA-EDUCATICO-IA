<?php

namespace App\Http\Controllers\visitador\simulacrum;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class SimulacrumController extends Controller
{
    //
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //pora crear simulacros
    public function index()
    {
        $user = auth()->user();
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            $exams = Exam::where('type', 'SIMULACRUM')->where('user_id', $user->id)->get();
            return view('visitador.simulacrum.index', [
                'exams' => $exams
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }
}
