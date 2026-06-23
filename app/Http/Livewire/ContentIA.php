<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use App\Models\Resource;
use App\Models\Section;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ContentIA extends Component
{
    public $tema = '';
    public $recomendacion = null;
    public $loading = false;
    public $sugerencias = [];

    public function updatedTema()
    {
        // Si el texto es corto, solo limpiamos sugerencias (NO tocamos la info generada)
        if (strlen($this->tema) < 2) {
            $this->sugerencias = [];
            return;
        }

        // Buscar sugerencias
        $this->sugerencias = Section::where('name', 'like', "%{$this->tema}%")
            ->limit(5)
            ->get();
    }

    public function seleccionarTema($id)
    {
        $seccion = Section::find($id);

        if (!$seccion) return;

        $this->tema = $seccion->name;
        $this->sugerencias = [];

        // Llama al generador desde JS
        $this->dispatchBrowserEvent('runGenerar', ['id' => $id]);
        $this->dispatchBrowserEvent('blurInput');
    }

    public function generar($seccionId = null)
    {
        $this->loading = true;

        if ($seccionId) {
            $seccion = Section::find($seccionId);
            if ($seccion) {
                $this->tema = $seccion->name;
            }
            $this->sugerencias = [];
        } else {
            $seccion = Section::where('name', 'like', "%{$this->tema}%")->first();
        }

        if (!$seccion) {
            $this->recomendacion = ['error' => "No se encontró una sección relacionada con '{$this->tema}' 😢"];
            $this->loading = false;
            return;
        }

        $videos = $seccion->lessons()->limit(5)->get();
        $pdfs = Resource::where('resourceable_type', 'App\\Models\\Lesson')
            ->whereIn('resourceable_id', $videos->pluck('id'))
            ->limit(5)
            ->get();
        $preguntas = $seccion->questions()->limit(5)->get();

        $descripcion = $seccion->description ?? 'Sin descripción disponible';

        $prompt = "
Eres un docente experto en educación secundaria y preuniversitaria.

Tema: {$seccion->name}

Descripción disponible:
{$descripcion}

Aunque no dispongas de información completa del curso, utiliza tus conocimientos académicos para explicar el tema.

Genera la respuesta con el siguiente formato:

📚 ¿Qué es este tema?
Explica de forma sencilla y clara qué estudia este tema.

🎯 Conceptos importantes
Menciona los conceptos clave que el estudiante debe conocer.

📝 ¿Por qué es importante?
Explica dónde se utiliza o por qué debe aprenderse.

🚀 Recomendación de estudio
Indica cómo aprovechar mejor los videos, PDFs y preguntas disponibles.

Información relacionada encontrada:

Videos:
" . implode(', ', $videos->pluck('name')->toArray()) . "

Material:
" . implode(', ', $pdfs->pluck('titulo')->toArray()) . "

Preguntas:
" . implode(', ', $preguntas->pluck('titulo')->toArray()) . "
";


        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'Eres un tutor educativo experto de PreuniCursos.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $textoIA = $response->json('choices.0.message.content') ?? 'No se pudo generar la recomendación.';

        // Convertimos todo a arrays seguros
        $this->recomendacion = [
            'texto' => $textoIA,
            'seccion' => $seccion->toArray(),
            'videos' => $videos->toArray(),
            'pdfs' => $pdfs->toArray(),
            'preguntas' => $preguntas->toArray(),
        ];

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.content-i-a');
    }
}
