<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use App\Models\Resource;
use Livewire\Component;

class Resources extends Component
{
    public $resources;

    public $resource_id;
    public $url;
    public $resourceable_id; //id de la tabla que se enlaza "courses"
    public $resourceable_type; //MODELOS DE LA TABLA

    public $courses;

    public function mount()
    {
        $this->courses = Course::all();
        $this->resources = Resource::where('resourceable_type','=','App\Models\Course')->get();
        $this->resourceable_id = Course::pluck('id')->first();
        //@dump($url, $resourceable_id)
    }

    public function render()
    {
        return view('livewire.admin.resources');
    }


    public function create()
    {
        $this->validate([
            'url' => 'required',
            'resourceable_id' => 'required'
        ]);

        Resource::create([
            'url' => $this->url,
            'resourceable_id' => $this->resourceable_id,
            'resourceable_type' => 'App\Models\Course'
        ]);

        $this->reload();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $resource = Resource::find($id);
        $this->resource_id = $resource->id;
        $this->url = $resource->url;
        $this->resourceable_id = $resource->resourceable_id;
    }

    public function update()
    {
        $this->validate([
            'url' => 'required'
        ]);

        $resource = Resource::find($this->resource_id);
        $resource->update([
            'url' => $this->url,
            'resourceable_id' => $this->resourceable_id,
            'resourceable_type' => 'App\Models\Course'
        ]);

        $this->reload();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $resource = Resource::find($id);
        $resource->delete();
        $this->reload();
        $this->resetInputFields();
    }

    public function reload()
    {
        $this->courses = Course::all();
        $this->resources = Resource::where('resourceable_type','=','App\Models\Course')->get();
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->resource_id = '';
        $this->url = '';
    }
}
