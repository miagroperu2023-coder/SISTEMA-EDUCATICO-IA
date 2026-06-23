<?php

namespace App\Http\Controllers\visitador\course;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseFreeController extends Controller
{
    //MOSTRANDO TODOS LOS CURSOS GRATIS PARA LOS USUARIOS QUE NO TENGAN UN PLAN
    public function index(Request $request)
    {
        //JALANDO LOS CURSOS QUE PONDRE GRATIS POR ID
        $courses = Course::where('status', '=', 3)->whereIn('id', [22,12,14,17])->get(); //LISTA DE CURSOS GRATIS
        $categories = Category::all();
        $levels = Level::all();

        return view('visitador.courseFree.index', [
            'categories' => $categories,
            'levels' => $levels,
            'courses' => $courses
        ]);
    }

    //MOSTRANDO EL CURSO POR SLUG DE LOS CURSO DE PRUEBA
    public function show(Course $course)
    {
        //METODO AUTORIZAR SOLO CURSOS PUBLICADOS
        $this->authorize('published', $course);

        $similares = Course::where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->where('status', '=', 3)
            ->take(5)
            ->get();

        //PARA VALIDAR SI EL CURSO QUE MANDA COMO PARAMETRO ESTA DENTRO DE LOS CURSOS GRATIS
        $isFreeCourse = Course::where('status', '=', 3)
            ->whereIn('id', [22,12,14,17])
            ->where('id', $course->id)
            ->exists();

        if ($isFreeCourse) {
            return view('visitador.courseFree.show', [
                'course' => $course,
                'similares' => $similares
            ]);
        } else {
            return redirect()->route('visitador.course.show', $course);
        }
    }

    //METODO DE LOS ALUMNOS QUE ESTAN MATRICULANDO AL CURSO
    //METODO CON AUTENTICACION PARA ACCEDER A EL
    public function enrolled(Course $course)
    {
        //tabla pivot nueva de cursos gratis
        //echo $course->id;
        $course->freeStudents()->syncWithoutDetaching(auth()->user()->id);
        return redirect()->route('visitador.course.status', $course);
    }

    //MI CURSOS EN DONDE ME INSCRITO GRATIS
    public function courses()
    {
        $courseIds = DB::table('course_user_free')->where('user_id', '=', auth()->user()->id)->pluck('course_id');
        $courseUsers = Course::whereIn('id', $courseIds)->get();
        $courses = Course::where('status', '=', 3)->whereIn('id', [22,12,14,17])->get(); //LISTA DE CURSOS GRATIS

        return view('visitador.courseFree.list', [
            'courseUsers' => $courseUsers,
            'courses' => $courses
        ]);
    }
}
