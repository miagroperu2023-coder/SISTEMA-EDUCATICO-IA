<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;

class CoursesReviews extends Component
{
    public $course;
    public $comment;
    public $rating = 5;


    public function mount(Course $course)
    {
        $this->course = Course::find($course->id);
    }

    public function render()
    {
        return view('livewire.courses-reviews');
    }


    public function create()
    {
        $this->validate([
            'comment' => 'required'
        ]);


        $course = Course::find($this->course->id);
        $course->reviews()->create([
            'comment' => $this->comment,
            'rating' => $this->rating,
            'user_id' => auth()->user()->id,
        ]);

        $this->reload($course);
    }

    //LIMPIAR CAJAS
    public function resetInputFields()
    {
        $this->comment = '';
        $this->comment = 5;
    }

    public function reload($course)
    {
        $this->course = Course::find($course->id);
        $this->resetInputFields();
    }
}
