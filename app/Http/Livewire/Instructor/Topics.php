<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Topic;
use Livewire\Component;

class Topics extends Component
{

    public $topics;

    public $topic_id;
    public $nombre;
    public $estado;


    public function mount()
    {
        $this->topics = Topic::where('estado', '=', 'activo')->get();
    }

    public function render()
    {
        return view('livewire.instructor.topics');
    }


    public function create()
    {
        $this->validate([
            'nombre' => 'required',
        ]);

        //insert de datos
        Topic::create([
            'nombre' => $this->nombre,
            'estado' => Topic::ACTIVO,
        ]);

        $this->reload();
    }

    public function edit($id)
    {
        $topic = Topic::find($id);
        $this->topic_id = $topic->id;
        $this->nombre = $topic->nombre;
        $this->estado = $this->estado;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required',
        ]);
        $topic = Topic::find($this->topic_id);
        $topic->update([
            'nombre' => $this->nombre,
        ]);

        $this->reset();
        $this->reload();
    }

    public function delete($id)
    {
        $topic = Topic::find($id);
        $topic->delete();
        $this->reload();
    }


    public function inactivar($id)
    {
        $topic = Topic::find($id);
        $topic->update([
            'estado' => 'inactivo',
        ]);
        $this->reload();
    }

    public function reload()
    {
        $this->topics = Topic::where('estado', '=', 'activo')->get();
    }
}
