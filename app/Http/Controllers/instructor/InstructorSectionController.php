<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class InstructorSectionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:Gestión seccion instructor');
        $this->middleware('auth');
    }

    public function index(Course $course)
    {
        //dd($course->sections); 
        return view('instructor.section.index', [
            'course' => $course
        ]);
    }
}
