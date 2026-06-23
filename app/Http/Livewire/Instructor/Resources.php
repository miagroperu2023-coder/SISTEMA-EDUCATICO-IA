<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Lesson;
use App\Models\Resource;
use Livewire\Component;

class Resources extends Component
{
    public $lesson;
    public $resource;

    //CAMPOS DE LA TABLA RESOURCE
    public $resource_id;
    public $url;
    public $resourceable_id; //id de la tabla
    public $resourceable_type = 'App\Models\Lesson';




    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->resourceable_id = $this->lesson->id;//INCIALIZANDO EL ID DE LA LECCION PARA CREAR NUEVO RECURSO

        //BUSCO LA DESCRIPCION POR ID DE LA LESSION Y VALIDO SI EXISTE PARA ALMACENAR LOS VALORES EN SU TABLA
        $this->resource = Resource::where('resourceable_id', '=', $this->resourceable_id)->first();
        if ($this->resource) {
            $this->resource_id = $this->resource->id;
            $this->url = $this->resource->url;
            $this->resourceable_id = $this->resource->resourceable_id;
        }
    }

    public function render()
    {
        return view('livewire.instructor.resources');
    }

    public function create()
    {
        $this->validate(['url' => 'required']);

        $resource = Resource::create([
            'url' => $this->url,
            'resourceable_id' => $this->resourceable_id,
            'resourceable_type' => $this->resourceable_type
        ]);

        $this->reload($resource);
        $this->resource_id = $resource->id;
    }

    public function update()
    {
        $this->validate(['url' => 'required']);

        if ($this->resource) {
            $resource =  $this->resource = Resource::find($this->resource->id);
            $this->resource->update([
                'url' => $this->url,
                'resourceable_id' => $this->resourceable_id,
                'resourceable_type' => $this->resourceable_type
            ]);
            $this->reload($resource);
        }
    }

    public function delete($resource_id)
    {
        $resource = Resource::find($resource_id);
        $data = $resource;
        $resource->delete();

        $this->reload($data);
        $this->resetInputFields();
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->resource_id = '';
        $this->url = '';
    }

    public function reload($resource)
    {
        $this->resource = Resource::find($resource->id);
    }
}
