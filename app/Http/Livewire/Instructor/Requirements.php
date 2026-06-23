<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Requirement;
use Livewire\Component;

//POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Requirements extends Component
{
    use AuthorizesRequests;

    //TABLA COURSE
    public $course; //PARA REFREZCAR LOS DATOS 

    //CAMPOS DE LA TABLA GOALS
    public $requirement_id;
    public $name;

    public function mount(Course $course)
    {
        $this->course = $course;

        //POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
        $this->authorize('dicatated', $course);
    }

    public function render()
    {
        return view('livewire.instructor.requirements');
    }

    //INSERTAR NUEVA META AL CURSO
    public function create()
    {
        $this->validate(['name' => 'required']);

        $requirement = Requirement::create([
            'name' => $this->name,
            'course_id' => $this->course->id
        ]);
        $this->reload($requirement);
    }

    public function edit($id)
    {
        $requirement = Requirement::find($id);
        $this->requirement_id = $requirement->id;
        $this->name = $requirement->name;
    }

    public function update()
    {
        $this->validate(['name' => 'required']);
        $requirement = Requirement::find($this->requirement_id); //BUSCA EL PRIMARY KEY DE LA TABLA
        $requirement->update(['name' => $this->name,]);
        $this->reload($requirement);
    }

    //ELIMINAR UNA SECCION DEL CURSO
    public function delete($id)
    {
        $requirement = Requirement::find($id);
        if ($requirement) {
            $data = $requirement;
            $requirement->delete();
            $this->reload($requirement);
        }
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->name = '';
        $this->requirement_id = '';
    }

    public function reload($requirement)
    {
        $course = Course::find($requirement->course_id);
        $this->course = $course;
        $this->resetInputFields();
    }
}
