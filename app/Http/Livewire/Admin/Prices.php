<?php

namespace App\Http\Livewire\Admin;

use App\Models\Price;
use Livewire\Component;

class Prices extends Component
{
    public $prices;

    public $price_id;
    public $name;
    public $value;


    public function mount()
    {
        $this->prices = Price::all();
    }

    public function render()
    {
        return view('livewire.admin.prices');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required',
            'value' => 'required'
        ]);

        Price::create([
            'name' => $this->name,
            'value' => $this->value
        ]);

        $this->reload();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $price = Price::find($id);
        $this->price_id = $price->id;
        $this->name = $price->name;
        $this->value = $price->value;
    }

    public  function update()
    {

        $this->validate([
            'name' => 'required',
            'value' => 'required'
        ]);

        $price = Price::find($this->price_id);
        $price->update([
            'name' => $this->name,
            'value' => $this->value
        ]);

        $this->reload();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $price = Price::find($id);
        $price->delete();
        $this->reload();
        $this->resetInputFields();
    }

    public function reload()
    {
        $this->prices = Price::all();
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->price_id = '';
        $this->name = '';
        $this->value = '';
    }
}
