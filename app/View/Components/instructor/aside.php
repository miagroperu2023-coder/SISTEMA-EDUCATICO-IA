<?php

namespace App\View\Components\instructor;

use Illuminate\View\Component;

class aside extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $course;
    public function __construct($course)
    {
        //
        $this->course = $course;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.instructor.aside');
    }
}
