<?php

namespace App\Http\Controllers\visitador\compendium;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CompendiumController extends Controller
{
    //

    public function index()
    {
        $user = auth()->user();
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            // Cargar los cursos y filtrar archivos por type "C"
            $courses = Course::with(['archives' => function ($query) {
                $query->where('type', 'C');
            }])->get();

            return view('visitador.compendio.index', [
                'courses' => $courses
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }

    public function show(Archive $archive)
    {
        $user = auth()->user();
        // Verifica si el usuario tiene acceso a la suscripción pre-universitaria o universitaria
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            $course = Course::find($archive->course_id);

            return view('visitador.compendio.show', [
                'archive' => $archive,
                'course' => $course
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }
}
