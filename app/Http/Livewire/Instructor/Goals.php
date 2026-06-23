<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Goal;
use Livewire\Component;

//POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Goals extends Component
{
    use AuthorizesRequests;
    
    //TABLA COURSE
    public $course; //PARA REFREZCAR LOS DATOS 

    //CAMPOS DE LA TABLA GOALS
    public $goal_id;
    public $name;

    public function mount(Course $course)
    {
        $this->course = $course;

        //POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
        $this->authorize('dicatated', $course);
    }

    public function render()
    {
        return view('livewire.instructor.goals');
    }

    //INSERTAR NUEVA META AL CURSO
    public function create()
    {
        $this->validate(['name' => 'required']);

        $goal = Goal::create([
            'name' => $this->name,
            'course_id' => $this->course->id
        ]);
        $this->reload($goal);
    }

    public function edit($id)
    {
        $goal = Goal::find($id);
        $this->goal_id = $goal->id;
        $this->name = $goal->name;
    }

    public function update()
    {
        $this->validate(['name' => 'required']);
        $goal = Goal::find($this->goal_id); //BUSCA EL PRIMARY KEY DE LA TABLA
        $goal->update(['name' => $this->name,]);
        $this->reload($goal);
    }

    //ELIMINAR UNA SECCION DEL CURSO
    public function delete($id)
    {
        $goal = Goal::find($id);
        if ($goal) {
            $data = $goal;
            $goal->delete();
            $this->reload($data);
        }
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->name = '';
        $this->goal_id = '';
    }

    public function reload($goal)
    {
        $course = Course::find($goal->course_id);
        $this->course = $course;
        $this->resetInputFields();
    }
}
