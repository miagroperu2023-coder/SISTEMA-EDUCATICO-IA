<?php

namespace App\Http\Livewire\Instructor;

use Livewire\Component;
use App\Models\Topic; // Asegúrate de importar el modelo Topic
use App\Models\Question; // Asegúrate de importar el modelo Question
use App\Models\Answer; // Asegúrate de importar el modelo Answer
use App\Models\Course;
use App\Models\Exam;
use App\Models\Section;
use Illuminate\Support\Facades\DB;

class QuestionForm extends Component
{
    //tabla 
    public $questions = [];
    public $courses;
    public $exams;
    public $sections;


    public $course_id;
    public $exam_id;
    public $section_id;

    public $titulo;
    public $comentario;
    public $dificultad = 'Facil';
    public $puntos = 1;
    public $estado;
    public $respuestas = [];


    public function mount()
    {
        $this->firstExam();
        $this->firstCourse();

        $this->courses = Course::where('status', 3)->get();
        $this->exams = Exam::where('user_id', '=', auth()->user()->id)->where('estado', '=', 'pendiente')->get();

        $this->filterCourseBySection();
        $this->loadQuestions();
    }


    public function render()
    {
        return view('livewire.instructor.question-form');
    }


    private function loadQuestions()
    {
        $this->questions = Question::join('exam_questions', 'questions.id', '=', 'exam_questions.question_id') // Relacionar preguntas con exam_questions
            ->join('exams', 'exam_questions.exam_id', '=', 'exams.id') // Relacionar exam_questions con exámenes
            ->join('sections', 'questions.section_id', '=', 'sections.id') // Relacionar preguntas con sections
           
            ->select(
                'questions.id',
                'questions.titulo',
                'questions.dificultad',
                'questions.puntos'
            )
            ->where('questions.user_id', '=', auth()->user()->id) // Filtrar por usuario
            ->where('exams.id', '=', $this->exam_id) // Filtrar por el examen actual
            ->where('exams.estado', '=', 'pendiente') // Filtrar sections activos
            ->get();
    }

    public function updatedSelectedSectionId()
    {
        $this->loadQuestions();
    }

    //METODO DEL SELECT PARA FILTRAR SECTIONS POR COURSE
    public function filterCourseBySection()
    {
        $course_id = $this->course_id;

        if ($course_id) {
            $sections = Section::where('course_id', $course_id)->get();
        } else {
            $sections = [];
        }
        $this->sections = $sections;
        //@dump($this->topics);
    }

    //Obtener el primer tema y asignar su id a $exam_id
    public function firstExam()
    {
        $firstExam = Exam::where('user_id', '=', auth()->user()->id)->where('estado', '=', 'pendiente')->latest()->first();
        $this->exam_id = $firstExam ? $firstExam->id : null;
    }

    public function firstCourse()
    {
        $firstCourse = Course::where('status', 3)->first(); // Obtiene el primer curso
        $this->course_id = $firstCourse ? $firstCourse->id : null; // Accede al id si el curso existe
    }

    //PARA AÑADIR UNA NUEVA RESPUESTA
    public function addAnswer()
    {
        $this->respuestas[] = ['titulo' => '', 'es_correcta' => false];
        $this->emit('ckeditorReady');
    }

    //PARA QUITAR UNA RESPUESTA
    public function removeAnswer($index)
    {
        unset($this->respuestas[$index]);
        $this->respuestas = array_values($this->respuestas);
        $this->emit('ckeditorReady');
    }

    //PARA GUARDAR LA PREGUNTA - RESPUESTA EN LAS TABLAS 
    public function saveQuestion()
    {
        // Validar los datos según tus necesidades
        $this->validate([
            'titulo' => 'required',
            'exam_id' => 'required',
            'section_id' => 'required',
            'respuestas.*.titulo' => 'required', // Validar que al menos una respuesta tenga un título
            'respuestas.*.es_correcta' => 'nullable|boolean', // Validar que al menos una respuesta sea marcada como correcta
        ], [
            'respuestas.*.titulo.required' => 'Debes agregar al menos una respuesta.', // Mensaje personalizado de error para respuestas sin título
            'respuestas.*.es_correcta.boolean' => 'Debes marcar al menos una respuesta como correcta.', // Mensaje personalizado de error para respuestas sin marcar como correcta
        ]);

        // Guardar la pregunta
        $question = Question::create([
            'titulo' => $this->titulo,
            'comentario' => 'algun comentario',
            'dificultad' => $this->dificultad,
            'puntos' => $this->puntos,
            'estado' => 'activo',
            'section_id' => $this->section_id, //se cambio topic_id por section_id
            'user_id' => auth()->user()->id
        ]);

        // Insertar en la tabla pivot "exam_question"
        DB::table('exam_questions')->insert([
            'exam_id' => $this->exam_id,
            'question_id' => $question->id,
        ]);

        // Insertando las respuestas
        foreach ($this->respuestas as $respuesta) {
            Answer::create([
                'titulo' => $respuesta['titulo'],
                'es_correcta' => $respuesta['es_correcta'],
                'question_id' => $question->id,
            ]);
        }

        // Limpiar campos después de guardar
        $this->reload();
        $this->resetInputFields();
    }


    public function delete($id)
    {
        $question = Question::find($id);
        $question->delete();
        // Limpiar campos después de guardar
        $this->reload();
    }

    //RECARGAR DATOS
    public function reload()
    {
        $this->updatedSelectedSectionId();
        $this->exams = Exam::where('user_id', '=', auth()->user()->id)->where('estado', '=', 'pendiente')->get();
    }

    //PARA PUBLICAR EL EXAMEN
    public function publishExam($section_id, $exam_id)
    {
        $exam = Exam::find($exam_id);
        $exam->update([
            'estado' => Exam::ACTIVO,
        ]);

        return redirect()->route('admin.instructor.exam.index');
    }

    //PARA ANULAR EL EXAMEN
    public function deleteExamen($section_id, $exam_id)
    {
        $exam = Exam::find($exam_id);
        $exam->delete();
    }

    public function resetInputFields()
    {
        $this->titulo = '';
        $this->reset(['titulo']);
    }
}
