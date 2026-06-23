<?php

namespace App\Http\Controllers\Api\Preguntados;

use App\Http\Controllers\Controller;
use App\Models\GameScoreSingle;
use App\Models\Question;
use Illuminate\Http\Request;

class PreguntadosSingleController extends Controller
{
    /**
     * LISTA DE PREGUNTAS RANDOM (modo individual)
     */
    public function index($categoryId, $size)
    {
        $questions = Question::where('estado', 'activo')
            ->whereHas('section.course', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->with('answers')   // cargar respuestas si las necesitas
            ->inRandomOrder()
            ->take($size)
            ->get();

        return response()->json($questions);
    }


    public function saveScoreSingle($user_id, $correct)
    {
        // Calcular incorrectas
        $incorrect = 10 - $correct;

        // Calcular score según correctas
        if ($correct <= 4) {
            $scoreDelta = -30;
        } elseif ($correct >= 5 && $correct <= 7) {
            $scoreDelta = 15;
        } elseif ($correct >= 8) {
            $scoreDelta = 30;
        } else {
            $scoreDelta = 0;
        }

        // Si sale negativo, guardar como 0
        $finalScore = max(0, $scoreDelta);

        // INSERT SIEMPRE → nunca update
        $save = GameScoreSingle::create([
            'user_id'       => $user_id,
            'score'         => $finalScore,
            'correct'       => $correct,
            'incorrect'     => $incorrect,
            'total_questions' => 10,
            'time_seconds'  => null,
            'mode'          => 'single',
            'match_uuid'    => null
        ]);

        if ($save) {
            return response()->json(['success' => 'score insertado']);
        }

        return response()->json(['error' => 'no se pudo guardar']);
    }
}
