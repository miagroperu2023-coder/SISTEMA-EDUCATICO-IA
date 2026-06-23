<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ChatBot extends Component
{
    public $userMessage = '';
    public $chatHistory = [];

    public function sendMessage()
    {
        if (trim($this->userMessage) === '') return;

        $this->chatHistory[] = ['role' => 'user', 'content' => $this->userMessage];

        // Buscar contexto desde PDF
        $context = $this->getRelevantContextFromPdf($this->userMessage);

        $messages = [
            [
                'role' => 'system',
                'content' => "Responde en base al siguiente texto extraído de un libro: \n\n$context"
            ],
            ...$this->chatHistory
        ];

        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => $messages,
        ]);

        if (!$response->successful()) {
            dd($response->status(), $response->body());
        }

        $reply = $response['choices'][0]['message']['content'] ?? 'Error al obtener respuesta.';
        $this->chatHistory[] = ['role' => 'assistant', 'content' => $reply];
        $this->userMessage = '';

        $this->dispatchBrowserEvent('messageSent');
    }

    public function getRelevantContextFromPdf($question)
    {
        Log::info("📌 Estoy dentro de getRelevantContextFromPdf");

        $text = (function () {
            try {
                $parser = new Parser();
                $pdf = $parser->parseFile(storage_path('app/libros/Geografa.pdf'));
                $contenido = $pdf->getText();

                Log::info("📘 Contenido leído del libro: " . Str::limit($contenido, 500));
                return $contenido;
            } catch (\Exception $e) {
                Log::error("❌ Error al leer el PDF: " . $e->getMessage());
                return "No se pudo leer el contenido del libro.";
            }
        })();

        // 2. Dividir el texto en fragmentos para simular la "búsqueda semántica"
        $chunks = Str::of($text)->split('/\n\s*\n/');

        // 3. Buscar fragmento que contenga palabras clave de la pregunta
        $keywords = explode(' ', strtolower($question));
        $bestChunk = '';
        $bestScore = 0;

        foreach ($chunks as $chunk) {
            $score = 0;
            foreach ($keywords as $word) {
                if (Str::contains(strtolower($chunk), $word)) {
                    $score++;
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $bestChunk = $chunk;
            }
        }

        // ✅ LOG del mejor fragmento encontrado
        if (empty($bestChunk)) {
            Log::warning("❌ No se encontró fragmento relevante para la pregunta: $question");
        } else {
            Log::info("✅ Fragmento encontrado para '$question': " . Str::limit($bestChunk, 300));
        }

        // ✅ También puedes hacer dump para verlo directamente en pantalla (solo en desarrollo)
        //dump($bestChunk);

        return Str::limit($bestChunk, 1200); // máximo 1200 caracteres para no saturar el prompt
    }


    public function render()
    {
        return view('livewire.chat-bot');
    }
}
