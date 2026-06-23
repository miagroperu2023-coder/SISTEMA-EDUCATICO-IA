<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class InstructorStudentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Course $course)
    {
        //return $course->students;
        return view('instructor.student.index', [
            'course' => $course
        ]);
    }
}
