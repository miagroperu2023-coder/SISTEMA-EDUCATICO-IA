<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Description;
use App\Models\Lesson;
use Livewire\Component;

class Descriptions extends Component
{
    //TABLAS
    public $lesson;
    public $description; //PARA REFREZCAR LOS DATOS 

    //CAMPOS DE LA TABLA DESCRIPTION
    public $description_id;
    public $name;
    public $lesson_id; //id de la leccion actual 


    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->lesson_id = $this->lesson->id; //INCIALIZANDO EL ID DE LA LECCION PARA CREAR NUEVA DESCRIPCION

        //BUSCO LA DESCRIPCION POR ID DE LA LESSION Y VALIDO SI EXISTE PARA ALMACENAR LOS VALORES EN SU TABLA
        $this->description = Description::where('lesson_id', '=', $this->lesson_id)->first();
        if ($this->description) {
            $this->description_id = $this->description->id;
            $this->name = $this->description->name;
            $this->lesson_id = $this->description->lesson_id;
        }
    }

    public function render()
    {
        return view('livewire.instructor.descriptions');
    }

    public function create()
    {
        $this->validate(['name' => 'required']);

        $description = Description::create([
            'name' => $this->name,
            'lesson_id' => $this->lesson_id
        ]);
        $this->reload($description);
        $this->description_id = $this->description->id;
    }

    public function update()
    {
        $this->validate(['name' => 'required']);

        if ($this->description) {
            $description = Description::find($this->description->id);
            $this->description->update([
                'name' => $this->name,
                'lesson_id' => $this->lesson_id
            ]);
            $this->reload($description);
        }/*$this->data = $description;@dump($data)*/
    }

    public function delete($description_id)
    {
        $description = Description::find($description_id);
        $data = $description;
        $description->delete();

        $this->reload($data);
        $this->resetInputFields();
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->description_id = '';
        $this->name = '';
    }

    //RECARGAR DATOS
    public function reload($data)
    {
        $this->description = Description::find($data->id);
    }
}
