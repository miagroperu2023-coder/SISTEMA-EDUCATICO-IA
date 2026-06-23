<?php

namespace App\Http\Controllers\visitador\examResponder;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamUser;
use App\Models\ExamUserAnswer;
use App\Models\Question;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class ExamResponderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //para inscribirme al examen
    public function index()
    {
        $user = auth()->user();
        //SI TIENE SUSCRIPCION VA TENER ACCESO A LOS EXAMENES
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            $exams = Exam::where('estado', '=', 'activo')->get();
            $courses = Course::where('status', 3)->get();
            return view('visitador.examResponder.index', [
                'exams' => $exams,
                'courses' => $courses
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }

    //para matricularse y dirigirlo a la ruta del componente en donde estan las preguntas
    public function enrolled(Exam $exam)
    {
        //agregado al alumno con el examen
        //dd($exam);

        $examUser = ExamUser::where('user_id', '=', auth()->user()->id)
            ->where('exam_id', '=', $exam->id)
            ->first();
        //dd($examUser);
        if ($examUser && $examUser->status == 'Culminado') {
            return redirect()->route('visitador.examenes.show', $exam);
        } else if ($examUser && $examUser->status == 'Pendiente') {
            return redirect()->route('visitador.examenes.status', ['exam' => $exam]);
        } else {
            $examUser = ExamUser::create([
                'calificacion' => '0',
                'observaciones' => '',
                'status' => 'Pendiente',
                'exam_id' => $exam->id,
                'user_id' => auth()->user()->id,
            ]);

            //dirigiendo al alumno para resolver el examen
            return redirect()->route('visitador.examenes.status', ['exam' => $exam]);
        }
    }

    //para resolver el examen
    public function status(Exam $exam)
    {
        $user = auth()->user();
        //SI TIENE SUSCRIPCION VA TENER ACCESO A LOS EXAMENES
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            $examUser = ExamUser::where('user_id', '=', auth()->user()->id)
                ->where('exam_id', '=', $exam->id)
                ->first();
            //dd($examUser);
            if ($examUser && $examUser->status == 'Culminado') {
                return redirect()->route('visitador.examenes.show', $exam);
            } else {
                return view('visitador.examResponder.estatus', [
                    'exam' => $exam,
                    'examUser' => $examUser
                ]);
            }
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }


    //para mostrar el examen las respuestas y su calificacion
    public function show(Exam $exam)
    {
        $user = auth()->user();
        //SI TIENE SUSCRIPCION VA TENER ACCESO A LOS EXAMENES Y  //METODO AUTORIZAR ENTRAR AL EXAMEN AL USUARIO AUTENTICADO
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            $examUser = ExamUser::where('user_id', auth()->user()->id)->where('exam_id', $exam->id)->first();
            $userExamAnswers = ExamUserAnswer::where('exam_user_id', $examUser->id)
                ->with(['answer', 'examQuestion.question.answers'])->get();

            //$recomendacion = $this->generarRecomendacion($exam, $examUser, $userExamAnswers);
            //dd($questions);
            return view('visitador.examResponder.show', [
                'exam' => $exam,
                'examUser' => $examUser,
                'userExamAnswers' => $userExamAnswers,
                //  'recomendacion' => $recomendacion
                'user' => $user
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
        //dd($exam);
    }

    // para volver a tomar el examen
    public function reset(Exam $exam, ExamUser $examUser)
    {
        $user = auth()->user();
        //SI TIENE SUSCRIPCION VA TENER ACCESO A LOS EXAMENES Y  //METODO AUTORIZAR ENTRAR AL EXAMEN AL USUARIO AUTENTICADO
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            try {
                // Encuentra el usuario del examen o lanza una excepción si no existe
                $deleteExmenUser = ExamUser::findOrFail($examUser->id);

                // Elimina las respuestas del usuario del examen
                $deleteExamUserAnswer = ExamUserAnswer::where('exam_user_id', $examUser->id);

                if ($deleteExamUserAnswer->exists()) {
                    $deleteExamUserAnswer->delete();
                }

                // actualizar el registro del usuario del examen
                $deleteExmenUser->update(['status' => 'Pendiente']);

                // Redirige a la ruta indicada con éxito
                return redirect()->route('visitador.examenes.enrolled', ['exam' => $exam]);
            } catch (\Exception $e) {
                // Maneja cualquier excepción y redirige con un mensaje de error
                return redirect()->back()->with('mensaje', 'Ocurrió un error al intentar reiniciar el examen: ' . $e->getMessage());
            }
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }

    // GENERAR RECOMENDACIÓN PERSONALIZADA DEL SIMULACRO
    public function generarRecomendacion($exam, $examUser, $userExamAnswers)
    {
        $seccionesFalladas = [];
        $seccionesAcertadas = [];

        // Recorrer respuestas del alumno
        foreach ($userExamAnswers as $respuesta) {
            $pregunta = $respuesta->examQuestion->question ?? null;
            if (!$pregunta || !$pregunta->section || !$pregunta->section->course) {
                continue; // evitar errores si falta alguna relación
            }

            $seccion = $pregunta->section;
            $curso = $seccion->course;

            // Clasificar la respuesta según si fue correcta o no
            if (!$respuesta->answer->es_correcta) {
                $seccionesFalladas[$curso->title][$seccion->name][] = $pregunta->titulo;
            } else {
                $seccionesAcertadas[$curso->title][$seccion->name][] = $pregunta->titulo;
            }
        }

        // Buscar lecciones (videos) de las secciones falladas
        $videosRecomendados = collect();

        foreach ($seccionesFalladas as $curso => $secciones) {
            foreach ($secciones as $nombreSeccion => $preguntas) {
                // Buscar la sección con sus lecciones
                $sectionModel = Section::where('name', $nombreSeccion)
                    ->with('lessons') // relación: Section hasMany Lesson
                    ->first();

                if ($sectionModel && $sectionModel->lessons->isNotEmpty()) {
                    foreach ($sectionModel->lessons as $lesson) {
                        $videosRecomendados->push([
                            'curso' => $curso,
                            'seccion' => $nombreSeccion,
                            'titulo' => $lesson->name ?? 'Lección sin título',
                            'url' => $lesson->url ?? null, // ✅ en tu tabla "lessons" el campo es "url"
                            'iframe' => $lesson->iframe ?? null, // ✅ en tu tabla "lessons" el campo es "url"
                        ]);
                    }
                }
            }
        }

        // Crear resumen textual del desempeño
        $resumen = "📘 Examen: {$exam->nombre}\n";
        $resumen .= "👤 Alumno: {$examUser->user->name}\n";
        $resumen .= "📊 Puntaje: {$examUser->calificacion}\n\n";

        if (count($seccionesFalladas) > 0) {
            $resumen .= "❌ Secciones donde tuvo errores:\n";
            foreach ($seccionesFalladas as $curso => $secciones) {
                $resumen .= "Curso: $curso\n";
                foreach ($secciones as $nombreSeccion => $preguntas) {
                    $resumen .= "  - $nombreSeccion (" . count($preguntas) . " preguntas falladas)\n";
                }
            }
        } else {
            $resumen .= "✅ No tuvo errores significativos. ¡Excelente desempeño!\n";
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

        // Prompt para IA (GPT)
        $prompt = "
                    Eres un tutor pedagógico especializado en preparación preuniversitaria (Perú).
                    Analiza el rendimiento del alumno y genera una recomendación personalizada.

                    Formato de respuesta: 
                        1️⃣ Análisis general del desempeño.
                        2️⃣ Temas y secciones que debe reforzar.
                        3️⃣ Recomendaciones y motivación final.
        $resumen
          ";

        // Llamada a la API de OpenAI
        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'Eres un tutor educativo experto de EduPeruApp.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return [
            'texto' => $response->json('choices.0.message.content'),
            'videos' => $videosRecomendados,
        ];
    }
}
