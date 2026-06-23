<?php

namespace App\Http\Livewire;

use App\Models\Section;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Recomendation extends Component
{
    public $exam;
    public $examUser;
    public $userExamAnswers;
    public $recomendacion = null; // Aquí guardamos la respuesta de la IA
    public $loading = false; // Estado de carga

    public function mount($exam, $examUser, $userExamAnswers)
    {
        $this->exam = $exam;
        $this->examUser = $examUser;
        $this->userExamAnswers = $userExamAnswers;
    }

    public function render()
    {
        return view('livewire.recomendation');
    }

    // ✅ NUEVO MÉTODO: Generar recomendación al hacer clic
    public function generar()
    {
        $this->loading = true;

        $resultado = $this->generarRecomendacion($this->exam, $this->examUser, $this->userExamAnswers);

        $this->recomendacion = $resultado;
        $this->loading = false;
    }

    // 🔹 Tu método existente (sin cambios sustanciales)
    public function generarRecomendacion($exam, $examUser, $userExamAnswers)
    {
        $seccionesFalladas = [];
        $seccionesAcertadas = [];

        foreach ($userExamAnswers as $respuesta) {
            $pregunta = $respuesta->examQuestion->question ?? null;
            if (!$pregunta || !$pregunta->section || !$pregunta->section->course) {
                continue;
            }

            $seccion = $pregunta->section;
            $curso = $seccion->course;

            if (!$respuesta->answer->es_correcta) {
                $seccionesFalladas[$curso->title][$seccion->name][] = $pregunta->titulo;
            } else {
                $seccionesAcertadas[$curso->title][$seccion->name][] = $pregunta->titulo;
            }
        }

        $videosRecomendados = collect();

        foreach ($seccionesFalladas as $curso => $secciones) {
            foreach ($secciones as $nombreSeccion => $preguntas) {
                $sectionModel = Section::where('name', $nombreSeccion)
                    ->with('lessons')
                    ->first();

                if ($sectionModel && $sectionModel->lessons->isNotEmpty()) {
                    foreach ($sectionModel->lessons as $lesson) {
                        $videosRecomendados->push([
                            'curso' => $curso,
                            'seccion' => $nombreSeccion,
                            'titulo' => $lesson->name ?? 'Lección sin título',
                            'url' => $lesson->url ?? null,
                            'iframe' => $lesson->iframe ?? null,
                        ]);
                    }
                }
            }
        }

        $resumen = "📘 Examen: {$exam->nombre}\n";
        $resumen .= "👤 Alumno: {$examUser->user->name}\n";
        $resumen .= "📊 Puntaje: {$examUser->calificacion}\n\n";

        if (count($seccionesFalladas) > 0) {
            $resumen .= "❌ Secciones con errores:\n";
            foreach ($seccionesFalladas as $curso => $secciones) {
                $resumen .= "Curso: $curso\n";
                foreach ($secciones as $nombreSeccion => $preguntas) {
                    $resumen .= "  - $nombreSeccion (" . count($preguntas) . " falladas)\n";
                }
            }
        } else {
            $resumen .= "✅ Sin errores significativos. ¡Excelente desempeño!\n";
        }

        if (count($seccionesAcertadas) > 0) {
            $resumen .= "\n✅ Secciones dominadas:\n";
            foreach ($seccionesAcertadas as $curso => $secciones) {
                $resumen .= "Curso: $curso\n";
                foreach ($secciones as $nombreSeccion => $preguntas) {
                    $resumen .= "  - $nombreSeccion (" . count($preguntas) . " correctas)\n";
                }
            }
        }

        $prompt = "
            Eres un tutor pedagógico especializado en preparación preuniversitaria (Perú).
            Analiza el rendimiento del alumno y genera una recomendación personalizada.

            Formato de respuesta: 
            1️⃣ Análisis general del desempeño.
            2️⃣ Temas y secciones que debe reforzar.
            3️⃣ Recomendaciones y motivación final.
        $resumen
        ";

        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'Eres un tutor educativo experto de PreuniCursos.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return [
            'texto' => $response->json('choices.0.message.content'),
            'videos' => $videosRecomendados,
        ];
    }
}
