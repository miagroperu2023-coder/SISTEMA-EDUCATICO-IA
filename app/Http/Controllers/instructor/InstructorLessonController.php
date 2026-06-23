<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class InstructorLessonController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:Gestión leccion instructor');
        $this->middleware('auth');
    }

    public function index(Course $course)
    {
        //dd($course->lessons); 
        return view('instructor.lesson.index', [
            'course' => $course
        ]);
    }
}
