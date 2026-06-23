<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Platform;
use App\Models\Section;
use Livewire\Component;

//POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Lessons extends Component
{
    use AuthorizesRequests;

    //TABLAS
    public $course; //PARA REFREZCAR LOS DATOS 
    public $platforms;
    public $sections;
    public $lessons;


    //CAMPOS DE LA TABLA LESSONS
    public $lesson_id;
    public $name;
    public $url;
    public $platform_id;
    public $section_id;


    public function mount(Course $course)
    {
        $this->course = $course;
        // Asignar valores iniciales si es necesario para que no dea null
        $this->platform_id = 1;
        $this->section_id = Section::where('course_id', $this->course->id)->value('id');
        // EL DETALLE ESTA QUI , EL 1: LE PERTENECE A UNA SECCION DEL CURSO CON ID 1

        //DATOS DE LA PLATAFORMA Y LAS SECCION DEL CURSO
        $this->platforms = Platform::all();
        $this->sections = Section::where('course_id', '=', $this->course->id)->get();

        //POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
        $this->authorize('dicatated', $course);
    }

    public function render()
    {
        return view('livewire.instructor.lessons');
    }

    //METODO PARA CREAR UNA LECCION AL CURSO SELECCIONADO
    public function create()
    {
        $this->validateLesson();

        $lesson = Lesson::create([
            'name' => $this->name,
            'url' => $this->url,
            'iframe' => $this->generateIframe($this->url, $this->platform_id),
            'platform_id' => $this->platform_id,
            'section_id' => $this->section_id,
        ]);

        $section = Section::find($lesson->section_id);
        $this->reload($section);
        //DEBUGUEAR LOS CAMPÓS LO PEGAS EN TU COMPONENTE CON LOS DATOS DECLADAROS ARRIBA 
        //@dump($name, $url, $platform_id, $section_id)
    }


    public function edit($id)
    {
        $lesson = Lesson::find($id);
        $this->lesson_id = $lesson->id;
        $this->name = $lesson->name;
        $this->url = $lesson->url;
        $this->platform_id = $lesson->platform_id;
        $this->section_id = $lesson->section_id;
    }


    public function update()
    {
        $this->validateLesson();

        $lesson = Lesson::find($this->lesson_id);
        $lesson->update([
            'name' => $this->name,
            'url' => $this->url,
            'iframe' => $this->generateIframe($this->url, $this->platform_id),
            'platform_id' => $this->platform_id,
            'section_id' => $this->section_id,
        ]);

        $section = Section::find($lesson->section_id);
        $this->reload($section);
    }

    //ELIMINAR UNA LECCION DE LA SECCION DEL CURSO
    public function delete($id)
    {
        $dataLesson =  Lesson::find($id);
        $section = Section::find($dataLesson->section_id);
        if ($section) {
            $this->reload($section);
            $dataLesson->delete();
        }
    }

    public function validateLesson()
    {
        $this->validate([
            'name' => 'required',
            'url' => 'required|url',
            'platform_id' => 'required',
            'section_id' => 'required',
        ]);
    }

    public function resetInputFields()
    {
        $this->lesson_id = '';
        $this->name = '';
        $this->url = '';
    }

    //RECARGAR LOS DATOS 
    public function reload($section)
    {
        $course = Course::find($section->course_id);
        $this->course = $course;
        $this->resetInputFields();
    }


    public function generateIframe($url, $platform_id)
    {
        if ($platform_id == 1) {
            // Para YouTube
            $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com(?:\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)))?([\w-]{10,12})/';
            preg_match($pattern, $url, $matches);
            $videoId = $matches[1] ?? '';

            // Modificar la URL del iframe para agregar autoplay, quitar el banner de videos relacionados y reducir el branding
            $iframeUrl = 'https://www.youtube.com/embed/' . $videoId . '?autoplay=1&rel=0&modestbranding=1';

            return '<iframe width="560" height="315" src="' . $iframeUrl . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        } elseif ($platform_id == 2) {
            // Para Vimeo
            $pattern = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
            preg_match($pattern, $url, $matches);
            $videoId = $matches[2] ?? '';

            return '<iframe src="https://player.vimeo.com/video/' . $videoId . '" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
        }
        return ''; // En caso de no ser una plataforma compatible
    }


    public function generateIdVideo($url, $platform_id)
    {
        if ($platform_id == 1) {
            $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com(?:\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)))?([\w-]{10,12})/';
            preg_match($pattern, $url, $matches);
            return $matches[1] ?? null;
        } elseif ($platform_id == 2) {
            $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:vimeo\.com\/(?:video\/)?)(\d+)/';
            preg_match($pattern, $url, $matches);
            return $matches[1] ?? null;
        }
        return ''; // En caso de no ser una plataforma compatible
    }
}
