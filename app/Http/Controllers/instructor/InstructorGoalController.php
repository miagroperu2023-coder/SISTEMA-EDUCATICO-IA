<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class InstructorGoalController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:Gestión metas instructor');
        $this->middleware('auth');
    }

    public function index(Course $course)
    {
        //return $course->goals;
        return view('instructor.goal.index', [
            'course' => $course
        ]);
    }
}
