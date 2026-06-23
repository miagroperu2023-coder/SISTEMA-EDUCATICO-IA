<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class InstructorRequirementController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('can:Gestión requerimiento instruc');
        $this->middleware('auth');
    }

    public function index(Course $course)
    {
        //return $course->requirements;
        return view('instructor.requirement.index', [
            'course' => $course
        ]);
    }
}
