<?php

namespace App\Http\Controllers\visitador\charts;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ChartsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            return view('visitador.chart.index');
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }

    public function dataChart()
    {
        $user = auth()->user();
        $courses = $user->courses_enrolled()->with('lessons.users')->get();

        $data = [];

        foreach ($courses as $course) {
            $totalLessons = $course->lessons->count();

            if ($totalLessons === 0) {
                $advance = 0;
            } else {
                $completed = $course->lessons->filter(function ($lesson) use ($user) {
                    return $lesson->users->contains($user->id);
                })->count();

                $advance = ($completed * 100) / $totalLessons;
            }

            $data[] = [
                'course' => $course->title,
                'advance' => round($advance, 2)
            ];
        }

        return response()->json($data);
    }
}
