<?php

namespace App\Http\Controllers\Api\Twilio;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\WhatsAppsSchedule;
use App\Models\WhatsAppsUserQuestionSchedule;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class WhatsAppWebHookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info("WebHook de WhatsApp recibido:", $request->all());

        $from = $request->input('From');  // Número del usuario
        $body = strtolower(trim($request->input('Body')));
        $fromNumber = str_replace("whatsapp:+", "", $from);

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $fromTwilio  = env('TWILIO_WHATSAPP_FROM');

        $twilio = new Client($sid, $token);

        // Detectar si ya tenemos registro
        $schedule = WhatsAppsSchedule::firstOrCreate(['phone' => $fromNumber]);

        $mensaje = "";
        $urlImagen = null; // 🔑 centralizamos aquí

        // === PEDIR PREGUNTA ===
        if ($body === 'pregúntame' || $body === 'preguntame') {
            if ($schedule->day && $schedule->time) {
                $question = Question::inRandomOrder()->first();
                $answers = $question->answers;

                // Guardar la pregunta enviada
                WhatsAppsUserQuestionSchedule::updateOrCreate(
                    ['phone' => $fromNumber],
                    ['question_id' => $question->id]
                );

                // Buscar imagen en la pregunta
                $titulo = $question->titulo;

                preg_match('/<img.*?src=["\'](.*?)["\']/', $titulo, $matches);
                if (!empty($matches[1])) {
                    $srcImagen = $matches[1];

                    if (str_starts_with($srcImagen, 'data:image')) {
                        $urlImagen = $this->saveImageFromBase64($srcImagen, "pregunta_{$question->id}");
                    } else {
                        $urlImagen = $srcImagen;
                    }

                    // ❌ Eliminar la etiqueta <img> del texto
                    $titulo = preg_replace('/<img.*?>/', '', $titulo);
                }

                // Construir mensaje con texto
                $mensaje = "🧠 *Pregunta del día:*\n";
                $mensaje .= $this->formatForWhatsapp($titulo) . "\n\n";

                foreach ($answers as $index => $answer) {
                    $mensaje .= ($index + 1) . ". " . $this->formatForWhatsapp($answer->titulo) . "\n";
                }
                $mensaje .= "\n📩 Responde con el número de la opción correcta (1-" . count($answers) . ")";
            } else {
                $mensaje = "⚠️ Antes de comenzar, por favor escribe *hola* para registrar tu día y hora preferidos.";
            }
        }
        // === RESPONDER OPCIONES ===
        elseif (preg_match('/^[1-5]$/', $body)) {
            $registro = WhatsAppsUserQuestionSchedule::where('phone', $fromNumber)->first();

            if ($registro && $registro->question_id) {
                $question = Question::find($registro->question_id);

                if ($question) {
                    $answers = $question->answers;
                    $respuestaUsuario = intval($body) - 1;
                    $respuestaSeleccionada = $answers[$respuestaUsuario] ?? null;

                    if ($respuestaSeleccionada) {
                        if ($respuestaSeleccionada->es_correcta) {
                            $mensaje = "✅ ¡Correcto! 🎉\nHas elegido la opción correcta.";
                        } else {
                            $respuestaCorrecta = $answers->firstWhere('es_correcta', true);
                            $indexCorrecto = $answers->search($respuestaCorrecta) + 1;
                            $mensaje = "❌ Incorrecto.\nLa respuesta correcta era:\n{$indexCorrecto}. " . $this->formatForWhatsapp($respuestaCorrecta->titulo);
                        }

                        // 🔥 Eliminar imagen temporal
                        $this->deleteTempImage("pregunta_{$question->id}");

                        // Borrar registro de la pregunta
                        $registro->delete();
                    } else {
                        $mensaje = "⚠️ Opción no válida. Responde con un número entre 1 y " . count($answers) . ".";
                    }
                } else {
                    $mensaje = "⚠️ No se pudo encontrar la pregunta anterior. Escribe *pregúntame* para recibir una nueva.";
                }
            } else {
                $mensaje = "⚠️ No hay ninguna pregunta activa para ti. Escribe *pregúntame* para comenzar.";
            }
        }
        // === REGISTRO INICIAL ===
        elseif ($body === 'hola' && $schedule->day && $schedule->time) {
            $mensaje = "👋 ¡Hola {$request->input('ProfileName')}! Bienvenido/a nuevamente al entrenamiento médico.\n\nTus datos ya están guardados. Escribe *pregúntame* para comenzar.";
        } elseif ($body === 'hola') {
            $mensaje = "👋 ¡Hola! {$request->input('ProfileName')}! Bienvenido/a al entrenamiento médico.\n\nPor favor responde con un *día de la semana* (ej: martes) en que desees recibir tus preguntas.";
        } elseif (!$schedule->day && in_array($body, ['lunes', 'martes', 'miércoles', 'miercoles', 'jueves', 'viernes', 'sábado', 'sabado', 'domingo'])) {
            $schedule->day = $body === 'miercoles' ? 'miércoles' : ($body === 'sabado' ? 'sábado' : $body);
            $schedule->save();

            $mensaje = "📅 Perfecto. {$request->input('ProfileName')}! Ahora por favor responde con una *hora* en formato 24h (ej: 14:30) en que deseas recibir las preguntas.";
        } elseif ($schedule->day && !$schedule->time && preg_match('/^\d{1,2}:\d{2}$/', $body)) {
            $schedule->time = $body;
            $schedule->save();

            $mensaje = "✅ Listo. Te enviaremos tu formulario cada *{$schedule->day}* a las *{$schedule->time}*. ¡Gracias!";
        } else {
            $mensaje = "⚠️ Por favor {$request->input('ProfileName')}! elije un número del 1 al 5.";
        }

        // === ENVÍO MENSAJE ===
        $params = [
            'from' => $fromTwilio,
            'body' => $mensaje
        ];

        if ($urlImagen) {
            $params['mediaUrl'] = [$urlImagen];
        }

        // cortar en partes si es muy largo
        if (strlen($mensaje) > 1500) {
            $partes = str_split($mensaje, 1500);
            foreach ($partes as $parte) {
                $twilio->messages->create($from, [
                    'from' => $fromTwilio,
                    'body' => $parte
                ]);
            }
        } else {
            $twilio->messages->create($from, $params);
        }

        Log::info("Mensaje enviado a $from", $params);
    }




    /**
     * Guarda imagen base64 como archivo temporal en storage/app/public
     */
    private function saveImageFromBase64($base64String, $prefix = 'pregunta')
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $type)) {
            $base64String = substr($base64String, strpos($base64String, ',') + 1);
            $extension = strtolower($type[1]);

            $data = base64_decode($base64String);
            if ($data === false) return null;

            // 📂 Ruta en public/preguntas
            $directory = public_path('preguntas');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $fileName = $prefix . '.' . $extension;
            $filePath = $directory . '/' . $fileName;

            file_put_contents($filePath, $data);

            // 🔗 URL accesible públicamente
            return asset('preguntas/' . $fileName);
        }
        return null;
    }



    /**
     * Elimina la imagen temporal asociada a una pregunta
     */
    private function deleteTempImage($prefix)
    {
        $files = glob(public_path("preguntas/{$prefix}.*"));
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }


    /**
     * Limpia HTML de CKEditor y lo convierte a formato WhatsApp
     */
    private function formatForWhatsapp($html)
    {
        $clean = strip_tags($html, "<b><strong><i><em><br><ul><li><img>");

        $clean = str_replace(["<b>", "<strong>"], "*", $clean);
        $clean = str_replace(["</b>", "</strong>"], "*", $clean);
        $clean = str_replace(["<i>", "<em>"], "_", $clean);
        $clean = str_replace(["</i>", "</em>"], "_", $clean);

        $clean = preg_replace('/<br\s*\/?>/i', "\n", $clean);
        $clean = preg_replace('/<li>(.*?)<\/li>/', "- $1\n", $clean);
        $clean = str_replace(["<ul>", "</ul>"], "", $clean);

        $clean = preg_replace('/\s+/', ' ', $clean);

        return trim($clean);
    }


    //BUSCANDO LAS PREGUNTAS CON SUS RESPUESTAS
    public function questions()
    {
        $question = Question::inRandomOrder()->first();
        //dd($question);
        $answers = $question->answers;
        //dd($answers);
        $mensaje = "Pregunta del día: \n";
        $mensaje .= $question->titulo . "\n\n";

        //dd('Pregunta: ', $mensaje);
        //lista respuestas
        foreach ($answers as $index => $answer) {
            $mensaje .= ($index + 1) . "." . $answer->titulo . "\n";
        }

        //qui guarda la lista del recorrido
        echo $mensaje .= "\n📩 Responde con el número de la opción correcta (1-5)";
    }
}
