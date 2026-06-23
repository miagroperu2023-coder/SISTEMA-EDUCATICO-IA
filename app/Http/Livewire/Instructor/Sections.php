<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Section;
use Livewire\Component;

//POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Sections extends Component
{
    use AuthorizesRequests;
    
    //TABLA COURSE
    public $course; //PARA REFREZCAR LOS DATOS 

    //CAMPOS DE LA TABLA SECTION
    public $section_id;
    public $name;
   

    public function mount(Course $course)
    {
        $this->course = $course;
        //POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
        $this->authorize('dicatated', $course);
    }

    public function render()
    {
        return view('livewire.instructor.sections');
    }

    //INSERTAR UNA NUEVA SECCION DEL CURSO
    public function create()
    {
        $this->validate(['name' => 'required',]);
        $section = Section::create([
            'name' => $this->name,
            'course_id' => $this->course->id
        ]);
        $this->reload($section);
    }

    //EDITAR LA SECCION DEL CURSO
    public function edit($id)
    {
        $section = Section::find($id);
        $this->name = $section->name;
        $this->section_id = $section->id;
    }

    //ACTUALIZAR LA SECCION DEL CURSO
    public function update()
    {
        $this->validate(['name' => 'required']);
        $section = Section::find($this->section_id); //BUSCA EL PRIMARY KEY DE LA TABLA
        $section->update(['name' => $this->name]);
        $this->reload($section);
    }

    //ELIMINAR UNA SECCION DEL CURSO
    public function delete($id)
    {
        $section = Section::find($id);
        if($section){
            $data = $section;
            $section->delete();
            $this->reload($data);
        }
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->name = '';
        $this->section_id = '';
    }

    //RECARGAR LOS DATOS 
    public function reload($section)
    {
        $course = Course::find($section->course_id); //BUSCA EL PRIMARY KEY DE LA TABLA
        $this->course = $course;
        $this->resetInputFields();
    }
}
