<?php

namespace App\Http\Livewire\Admin;

use App\Models\Level;
use Livewire\Component;

class Levels extends Component
{
    public $levels;

    public $level_id;
    public $name;

    public function mount()
    {
        $this->levels = Level::all();        
    }

    public function render()
    {
        return view('livewire.admin.levels');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Level::create([
            'name' => $this->name,
        ]);

        $this->reload();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $levels = Level::find($id);
        $this->level_id = $levels->id;
        $this->name = $levels->name;
    }

    public  function update()
    {

        $this->validate([
            'name' => 'required',
        ]);

        $levels = Level::find($this->level_id);
        $levels->update([
            'name' => $this->name,
        ]);

        $this->reload();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $levels = Level::find($id);
        $levels->delete();
        $this->reload();
        $this->resetInputFields();
    }

    public function reload()
    {
        $this->levels = Level::all();
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->level_id = '';
        $this->name = '';
    }
}
