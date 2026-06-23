<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class InstructorAudienceController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Course $course)
    {
        //return $course->audiences;
        return view('instructor.audience.index', [
            'course' => $course
        ]);
    }
}
