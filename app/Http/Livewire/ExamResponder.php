<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamUser;
use App\Models\ExamUserAnswer;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class ExamResponder extends Component
{
    public $exam;
    public $examUser;
    public $examenes;
    public $currentQuestionIndex = 0;
    public $respuestasSeleccionadas = [];
    public $botonDesactivado = false;

    protected $listeners = ['tiempoFuera'];

    public function mount(Exam $exam, ExamUser $examUser)
    {
        $this->exam = $exam;
        $this->examUser = $examUser;
        $this->examenes = ExamQuestion::with('question.answers')
            ->where('exam_id', $this->exam->id)
            ->inRandomOrder()
            ->get();

        foreach ($this->examenes as $examen) {
            $this->respuestasSeleccionadas[$examen->question->id] = null;
        }
    }

    public function render()
    {
        return view('livewire.exam-responder', [
            'currentQuestion' => $this->examenes[$this->currentQuestionIndex],
            'totalQuestions' => $this->examenes->count()
        ]);
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->examenes) - 1) {
            $this->currentQuestionIndex++;
        }
    }

    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    public function selectQuestion($index)
    {
        // Asegurarse de que el índice esté dentro del rango de preguntas disponibles
        if ($index >= 0 && $index < count($this->examenes)) {
            $this->currentQuestionIndex = $index;
        }
    }


    public function submitExam($tiempoFuera = false)
    {
        if (!$tiempoFuera) {
            $this->validate();
        }

        $this->guardarPreguntaRespuestas();
        $this->botonDesactivado = true;
    }

    public function guardarPreguntaRespuestas()
    {
        foreach ($this->respuestasSeleccionadas as $questionId => $respuestaId) {
            if ($respuestaId) {
                $respuesta = Answer::find($respuestaId);
                $puntos = $respuesta && $respuesta->es_correcta ? $respuesta->es_correcta : 0;

                $examenQuestion = ExamQuestion::where('question_id', $questionId)
                    ->where('exam_id', $this->exam->id)
                    ->first();

                if ($examenQuestion) {
                    ExamUserAnswer::create([
                        'exam_user_id' => $this->examUser->id,
                        'exam_question_id' => $examenQuestion->id,
                        'answer_id' => $respuesta->id,
                        'puntos' => $puntos,
                    ]);
                }
            }
        }

        // Calcular cuántas correctas tuvo
        $correctas = ExamUserAnswer::where('exam_user_id', $this->examUser->id)
            ->sum('puntos');

        // Total de preguntas del examen
        $totalPreguntas = ExamQuestion::where('exam_id', $this->exam->id)->count();

        // Nota sobre 20
        $nota20 = $totalPreguntas > 0 ? ($correctas / $totalPreguntas) * 20 : 0;

        $this->examUser->update([
            'calificacion' => round($nota20, 2),
            'status' => 'Culminado'
        ]);

        if (auth()->user()->userSuscriptionUrl()->exists()) {
            return redirect()->route('visitador.examenes.show', $this->exam);
        } else {
            return redirect()->route('visitador.examenes.free.show', $this->exam);
        }
    }

    public function rules()
    {
        return [
            'respuestasSeleccionadas.' . $this->examenes[$this->currentQuestionIndex]->question->id => 'required',
        ];
    }

    public function validateExamenStatus()
    {
        //$data = $this->examUser->status;
        //@dump($data);
        if ($this->examUser->status == 'Culminado') {
            if (auth()->user()->userSuscriptionUrl()->exists()) {
                return redirect()->route('visitador.examenes.show', $this->exam);
            } else {
                return redirect()->route('visitador.examenes.free.show', $this->exam);
            }
        }
    }

    public function tiempoFuera()
    {
        $this->submitExam(true);
    }
}
