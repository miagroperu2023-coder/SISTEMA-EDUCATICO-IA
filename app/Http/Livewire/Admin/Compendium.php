<?php

namespace App\Http\Livewire\Admin;

use App\Models\Archive;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class Compendium extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $courses;
    public $archive_id;
    public $course_id;
    public $name;
    public $image;
    public $cita;
    public $url;
    public $description;
    public $type;

    public function mount()
    {
        $this->courses = Course::all(); // Cargar los cursos una vez al montar el componente
        $this->course_id = $this->courses->first()->id ?? null; // Asignar el primer ID del curso si existe
    }

    public function render()
    {
        $archives = Course::join('archives', 'courses.id', '=', 'archives.course_id')
            ->select(
                'courses.title',
                'archives.id',
                'archives.url',
                'archives.name',
                'archives.image',
                'archives.url'
            )
            ->whereIn('archives.type', ['', 'C'])
            ->paginate(10);
        return view('livewire.admin.compendium', [
            'courses' => $this->courses,
            'archives' => $archives, // Pasar los archivos paginados a la vista
        ]);
    }
    public function create()
    {
        $this->validate([
            'name' => 'required',
            'image' => 'required',
            'cita' => 'required',
            'url' => 'required',
            'description' => 'required'
        ]);

        Archive::create([
            'course_id' => $this->course_id,
            'name' => $this->name,
            'image' => $this->image,
            'cita' => $this->cita,
            'url' => $this->url,
            'description' => $this->description,
            'type' => 'C' //compendios
        ]);

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $archive = Archive::findOrFail($id);
        $this->archive_id = $archive->id;
        $this->course_id = $archive->course_id;
        $this->name = $archive->name;
        $this->image = $archive->image;
        $this->cita = $archive->cita;
        $this->url = $archive->url;
        $this->description = $archive->description;
        $this->type = 'C';
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'image' => 'required',
            'cita' => 'required',
            'url' => 'required',
            'description' => 'required'
        ]);

        $archive = Archive::findOrFail($this->archive_id);
        $archive->update([
            'course_id' => $this->course_id,
            'name' => $this->name,
            'image' => $this->image,
            'cita' => $this->cita,
            'url' => $this->url,
            'description' => $this->description,
            'type' => $this->type
        ]);

        $this->resetInputFields();
    }

    public function delete($id)
    {
        $archive = Archive::findOrFail($id);
        $archive->delete();
    }

    // Limpiar campos de entrada
    public function resetInputFields()
    {
        $this->name = '';
        $this->image = '';
        $this->cita = '';
        $this->url = '';
        $this->description = '';
    }
}
