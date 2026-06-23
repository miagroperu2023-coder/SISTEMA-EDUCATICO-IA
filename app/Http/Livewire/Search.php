<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;

class Search extends Component
{
    //VARIABLE BUSCADOR
    public $search;

    public function render()
    {
        return view('livewire.search');
    }

    //traendo los datos con la busqueda del usuario
    public function getResultsProperty()
    {
        return Course::where('title', 'LIKE', '%' . $this->search . '%')
        ->where('status','=',3)
        ->take(10)->get();
    }
}
