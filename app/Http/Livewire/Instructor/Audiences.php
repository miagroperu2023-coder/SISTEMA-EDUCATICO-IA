<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Audience;
use App\Models\Course;
use Livewire\Component;

//POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Audiences extends Component
{
    use AuthorizesRequests;

    //TABLA COURSE
    public $course; //PARA REFREZCAR LOS DATOS 

    //CAMPOS DE LA TABLA AUDIENCES
    public $audience_id;
    public $name;


    public function mount(Course $course)
    {
        $this->course = $course;

        //POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
        $this->authorize('dicatated', $course);
    }

    public function render()
    {
        return view('livewire.instructor.audiences');
    }

    //INSERTAR NUEVA META AL CURSO
    public function create()
    {
        $this->validate(['name' => 'required']);

        $audience = Audience::create([
            'name' => $this->name,
            'course_id' => $this->course->id
        ]);
        $this->reload($audience);
    }

    public function edit($id)
    {
        $audience = Audience::find($id);
        $this->audience_id = $audience->id;
        $this->name = $audience->name;
    }

    public function update()
    {
        $this->validate(['name' => 'required']);
        $audience = Audience::find($this->audience_id); //BUSCA EL PRIMARY KEY DE LA TABLA
        $audience->update(['name' => $this->name,]);
        $this->reload($audience);
    }

    //ELIMINAR UNA SECCION DEL CURSO
    public function delete($id)
    {
        $audience = Audience::find($id);
        if ($audience) {
            $data = $audience;
            $audience->delete();
            $this->reload($data);
        }
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->name = '';
        $this->audience_id = '';
    }

    public function reload($audience)
    {
        $course = Course::find($audience->course_id);
        $this->course = $course;
        $this->resetInputFields();
    }
}
