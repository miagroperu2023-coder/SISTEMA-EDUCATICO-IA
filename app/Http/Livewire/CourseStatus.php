<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;


//AUTORIZAR ENTRAR AL CURSO AL USUARIO AUTENTICADO
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CourseStatus extends Component
{
    use AuthorizesRequests;

    public $course;
    public $current;

    // Extraer el ID del archivo de Google Drive de la URL
    public $fileId = null;

    public function mount(Course $course)
    {
        $this->course = $course;
        foreach ($course->lessons as $lesson) {
            if (!$lesson->completed) {
                $this->current = $lesson;
                break;
            }
        }

        //PARA SOLUCIONAR EL ERROR DEL IFRAME MANDADOLE UN VALOR
        if (!$this->current) {
            $this->current = $course->lessons->last();
        }

        //METODO AUTORIZAR ENTRAR AL CURSO AL USUARIO AUTENTICADO Y QUE VALIDE EN LAS DOS TABLAS
        $this->authorize('insideCourse', $course);

        //para mostrar el boton de descarga de archivo
        $this->uploadField();
    }

    public function render()
    {
        return view('livewire.course-status');
    }

    //METODO PARA CAMBIAR LA LECCION ACTUAL
    public function changeLesson(Lesson $lesson)
    {
        $this->current = $lesson;

        // Emitir un evento de Livewire para actualizar la interfaz
        $this->emit('lessonChanged', $lesson->section_id);
    }

    //METODO PARA DAR CLICK Y CULMINAR UNA LECCION
    public function completed()
    {
        if ($this->current->completed) {
            //ELIMINAR REGISTRO DE COMPLETADO EN LA TABLA "lesson_user"
            $this->current->users()->detach(auth()->user()->id);
        } else {
            //AGREGAR REGISTRO DE COMPLETADO EN LA TABLA "lesson_user"
            $this->current->users()->attach(auth()->user()->id);
        }

        //REFREZCANDO LAS LECCIONES CULMINADAS
        $this->current = Lesson::find($this->current->id);
        $this->course = Course::find($this->course->id);

        //nos vamos a la siguiente leccion
        $nextLesson = $this->getNextProperty(); // nos retorna la leccion siguiente
        if ($nextLesson) {
            $this->current = $nextLesson;
        }

        // Emitir un evento de Livewire para actualizar la interfaz
        $this->emit('lessonChanged', $this->current->section_id);
    }


    //PROPIEDADES COMPUTADAS
    public function getIndexProperty()
    {
        //INDICE ACTUAL DEL LAS LECCION
        return $this->course->lessons->pluck('id')->search($this->current->id); //ESTE METODO ESTA EN LA DOCUEMNTACION DE LARAVEL
    }

    //BOTON PARA IR A LA LECCION ANTERIOR
    public function getPreviousProperty()
    {
        //HABILITANDO EL PRIMER INDICE SEGUN POSICION
        if ($this->index == 0) {
            return null;
        } else {
            //INDICE ANTERIOR
            return $this->course->lessons[$this->index - 1]; //DEL INDICE ACTUAL ME RETORNA EL ANTERIOR
        }
    }

    //BOTON PARA IR A LA LECCION SIGUIENTE 
    public function getNextProperty()
    {
        //HABILITANDO EL ULTIMO INDICE SEGUN POSICION
        if ($this->index == $this->course->lessons->count() - 1) {
            return null;
        } else {
            //INDICE POSTERIOR 
            return $this->course->lessons[$this->index + 1]; //DEL INDICE ACTUAL ME RETORNA EL SIGUIENTE
        }
    }

    //PARA PINTAR EL AVENCE DEL CURSO EN EL PROGRESSBAR
    public function getAdvanceProperty()
    {
        $i = 0;
        foreach ($this->course->lessons as $lesson) {
            if ($lesson->completed) {
                $i++;
            }
        }

        $advance = ($i * 100) / ($this->course->lessons->count());
        return round($advance, 2);
    }

    //para la descarga de archivos
    public function uploadField()
    {
        // Verificamos si $current existe y si tiene un recurso
        if ($this->current && $this->current->resource) {
            // Verificamos si la URL del recurso es válida
            if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $this->current->resource->url, $matches)) {
                $this->fileId = $matches[1];
            } else {
                $this->fileId = null; // No se encontró un ID válido
            }
        } else {
            $this->fileId = null; // No hay recurso
        }
    }
}