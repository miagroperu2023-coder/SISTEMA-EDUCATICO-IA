<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class Simulacrum extends Component
{
    //tablas
    public $questions = [];
    public $courses;
    public $exams;
    public $sections;

    //ids
    public $course_id;
    public $exam_id;
    public $section_id;
    public $cantidad_pregunta;
    public $duracion;

    //campos
    public $nameSimulacrum;
    public $publicacion;
    public $count;

    //array donde se guarda las preguntas selecciondas por secciones
    public $simulacrum_questions = [];

    public function mount()
    {
        $this->firstCourse();
        $this->cantidad_pregunta = 1; //incial
        $this->duracion = 10; //incial
        $this->publicacion = date('Y-m-d\TH:i:s');
        $this->courses = Course::where('status', 3)->whereNotIn('id', [22])->get();

        //para filtrar las secciones
        $this->filterCourseBySection();
    }

    public function render()
    {
        return view('livewire.simulacrum');
    }

    //ASIGNAR EL ID DEL CURSO AL SELECT DE CURSOS
    public function firstCourse()
    {
        $firstCourse = Course::where('status', 3)->first();
        $this->course_id = $firstCourse ? $firstCourse->id :  null;
    }

    //FILTRAR LAS SECCIONES POR CURSOS
    public function filterCourseBySection()
    {
        $course_id = $this->course_id;

        if ($course_id) {
            $sections = Section::where('course_id', $course_id)->get();
            $this->sections = $sections;
            $this->section_id = $sections->first() ? $sections->first()->id : null;

            // calcular cuántas preguntas tiene la primera sección
            if ($this->section_id) {
                $this->CountQuestion();
            }
        } else {
            $this->sections = [];
            $this->section_id = null;
            $this->count = 0;
        }
    }

    //lifecycle hook de Livewire.
    public function updatedSectionId()
    {
        // cada vez que cambie la sección, recalculamos la cantidad de preguntas disponibles
        $this->CountQuestion();
    }

    public function CountQuestion()
    {
        $this->count = Question::where('section_id', $this->section_id)->count();
    }

    public function deleteSimulacrum($section_id)
    {
        if (isset($this->simulacrum_questions[$section_id])) {
            unset($this->simulacrum_questions[$section_id]); // ❌ elimina esa sección
            session()->flash('message', 'Se eliminó la sección del simulacro correctamente');
        } else {
            session()->flash('message', 'La sección no existe en el simulacro');
        }
    }

    //para generar la pregunta
    public function addAnswer()
    {
        //validar que tenga una seccion seleccioanda
        if (!$this->section_id) {
            return session()->flash('message', 'Debe seleccionar una sección');
        }

        //evitar duplicados
        if (isset($this->simulacrum_questions[$this->section_id])) {
            return session()->flash('message', 'Ya agregaste preguntas de esta sección');
        }

        //obtener preguntas aleatorias 
        $questions = Question::where('section_id', $this->section_id)
            ->inRandomOrder()->take($this->cantidad_pregunta)->get();
        $course = Course::find($this->course_id);
        $section = Section::find($this->section_id);

        $this->simulacrum_questions[$this->section_id] = [
            'curso' => $course->title,
            'cantidad_preguntas' => $this->cantidad_pregunta,
            'section_id' => $this->section_id,
            'section_name' => $section->name,
            'questions' => $questions
        ];

        session()->flash('message', 'Preguntas agregadas al simulacro.');
    }

    public function saveQuestion()
    {

        $this->validate([
            'nameSimulacrum' => 'required|string',
            'section_id' => 'required|integer',
            'cantidad_pregunta' => 'required|integer',
            'publicacion' => 'required|date',
        ]);

        if (empty($this->simulacrum_questions)) {
            return session()->flash('message', 'Debe seleccionar al menos una sección con preguntas');
        }

        DB::transaction(function () use (&$exam) {
            $exam = Exam::create([
                'nombre' => $this->nameSimulacrum,
                'slug' => Str::slug($this->nameSimulacrum),
                'duracion' => $this->duracion,
                'estado' => 'activo',
                'publicacion' => $this->publicacion,
                'type' => 'SIMULACRUM',
                'user_id' => auth()->user()->id,
                'course_id' => $this->course_id
            ]);

            foreach ($this->simulacrum_questions as $sectionData) {
                foreach ($sectionData['questions'] as $question) {
                    DB::table('exam_questions')->insert([
                        'exam_id' => $exam->id,
                        'question_id' => $question['id'],
                    ]);
                    //@dump($question['id']);
                }
            }
        });

        // ahora sí rediriges
        return redirect()->route('visitador.examenes.enrolled', $exam);
    }
}
