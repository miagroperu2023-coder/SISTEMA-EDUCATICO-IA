<?php

namespace App\Http\Controllers\visitador\bot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class BotController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            return view('visitador.bot.index');
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }

    public function conversation(Request $request)
    {
        $chatHistory = [
            ['role' => 'user', 'content' => $request->message]
        ];

        $contenido = $request->message;
        $messages = [
            [
                'role' => 'system',
                'content' => "Eres un asistente educativo especializado en preparación preuniversitaria para postulantes de la Universidad Nacional Federico Villarreal (UNFV). 
Tu tarea es responder preguntas de los estudiantes sobre los cursos y temas incluidos en PreuniCursos: Matemática, Física, Química, Biología, Lenguaje, Literatura, Historia, Geografía, Economía, Filosofía, Psicología, Lógica, Trigonometría, Álgebra, Aritmética y Geometría. 

Debes:
- Explicar los conceptos de manera clara, sencilla y paso a paso, como un profesor que enseña a un alumno.
- Fundamentar tus respuestas con ejemplos, fórmulas o definiciones básicas, según el tema.
- Cuando sea posible, relacionar la explicación con los materiales de estudio, compendios o simulacros oficiales del examen de admisión de la UNFV.
- Si el usuario pide resolver una pregunta o ejercicio, primero explica el procedimiento y luego da la respuesta.
- Si no encuentras información exacta, brinda una explicación general del tema preuniversitario, pero nunca inventes datos.

Recuerda: siempre mantén un tono motivador y pedagógico, como un tutor que ayuda a que el alumno entienda mejor el curso.

Aquí tienes contenido de referencia extraído de la plataforma PreuniCursos:\n\n" . $contenido
            ],
            ...$chatHistory
        ];


        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages,
        ]);

        if ($response->failed()) {
            return response()->json([
                'messages' => [
                    ['type' => 'text', 'content' => 'Error al obtener respuesta del modelo.']
                ]
            ], 500);
        }

        $content = $response['choices'][0]['message']['content'] ?? 'Sin respuesta.';

        return response()->json([
            'messages' => [
                ['type' => 'text', 'content' => nl2br($content)]
            ]
        ]);
    }

    public function readBook()
    {
        $pdfPath = storage_path('app/libros/Geografa.pdf'); // Ajusta la ruta

        $parser = new Parser();
        $pdf = $parser->parseFile($pdfPath);

        $text = $pdf->getText();

        return response()->json([
            'extracto' => substr($text, 0, 500), // Solo para probar
        ]);
    }

    //funcion para generar contenido con ia pora reforzar
    public function contenidoIA()
    {
        $user = auth()->user();
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            return view('visitador.bot.contenido-i-a', [
                'user' => $user
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }
}
