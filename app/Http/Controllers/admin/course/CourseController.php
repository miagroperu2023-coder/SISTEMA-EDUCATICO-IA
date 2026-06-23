<?php

namespace App\Http\Controllers\admin\course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:Publicar cursos')->only('index','show','approved');
    }

    public function index()
    {
        $courses = Course::where('status', '=', 2)->get();
        return view('admin.course.index', [
            'courses' => $courses
        ]);
    }

    public function show(Course $course)
    {
        //return $course;
        $this->authorize('revision',$course);
        return view('admin.course.show', [
            'course' => $course
        ]);
    }

    public function approved(Course $course)
    {
        $this->authorize('revision',$course);
        if (!$course->lessons || !$course->goals || !$course->requirements || !$course->image) {
            return back()->with('info', 'El curso debe estar completo para poder publicarlo a los estudiantes');
        }

        $course->status = 3;
        $course->save();
        return redirect()->route('admin.courses.index')->with('info', 'Curso aprobado correctamente');
    }
}
