<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use Livewire\Component;

class Students extends Component
{
    public $course;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function render()
    {
        return view('livewire.instructor.students');
    }
}
