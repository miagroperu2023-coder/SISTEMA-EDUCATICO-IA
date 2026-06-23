<?php

namespace App\Http\Controllers\visitador\course;

use App\Http\Controllers\Controller;
use App\Mail\EnviarCorreoLinkCaido;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class CourseController extends Controller
{
  //MOSTRANDO TODOS LOS CURSOS Y POR FILTROS
  public function index(Request $request)
  {

    $courses = Course::where('status', '=', 3)->inRandomOrder()->limit(16)->get();
    $categories = Category::all();
    $levels = Level::all();

    return view('visitador.course.index', [
      'categories' => $categories,
      'levels' => $levels,
      'courses' => $courses
    ]);
  }


  //MOSTRANDO EL CURSO POR SLUG
  public function show(Course $course)
  {
    //METODO AUTORIZAR SOLO CURSOS PUBLICADOS
    $this->authorize('published', $course);

    $similares = Course::where('category_id', $course->category_id)
      ->where('id', '!=', $course->id)
      ->where('status', '=', 3)
      ->take(5)
      ->get();

    return view('visitador.course.show', [
      'course' => $course,
      'similares' => $similares
    ]);
  }


  //METODO DE LOS ALUMNOS QUE ESTAN MATRICULANDO AL CURSO
  //METODO CON AUTENTICACION PARA ACCEDER A EL
  public function enrolled(Course $course)
  {
    //CADA VEZ QUE EL USUARIO LE DE CLICK EN "llevar curso" 
    //SE GUARDARA ESOS DATOS EN LA TABLA "course_user"
    $user = auth()->user();

    if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
      $course->students()->attach(auth()->user()->id);
      return redirect()->route('visitador.course.status', $course);
    } else {
      // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
      return redirect()->route('mercadopago.suscription.subscribe');
    }
  }


  //DENTRO DEL CURSO PARA TOMAR LAS CLASES QUE HAY DENTRO DE EL
  //METODO CON AUTENTICACION PARA ACCEDER A EL
  public function status(Course $course)
  {
    return view('visitador.course.status', [
      'course' => $course
    ]);
  }

  //MI CURSOS EN DONDE ME INSCRITO
  public function courses()
  {
    $user = auth()->user();

    if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
      $courseIds = DB::table('course_user')->where('user_id', '=', auth()->user()->id)->pluck('course_id');
      $courseUsers = Course::whereIn('id', $courseIds)->get();
      $courses = Course::where('status', '=', 3)->latest('id')->take(8)->get();

      return view('visitador.course.list', [
        'courseUsers' => $courseUsers,
        'courses' => $courses
      ]);
    } else {
      // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
      //return redirect()->route('mercadopago.suscription.subscribe');

      return redirect() - route('visitador.course.free.index');
    }
  }

  //metodo que va enviar la alerta del link caido a los administradores
  public function alert(Request $request)
  {

    $id_lesson = $request->id_lesson;
    $lesson = Lesson::find($id_lesson);

    if ($lesson) {
      $section = Section::find($lesson->section_id);
      $course = Course::find($section->course_id);

      $administradores = ['anthony.anec@gmail.com'];

      Mail::to($administradores)->send(new EnviarCorreoLinkCaido($lesson, $section, $course));

      return response()->json([
        'code' => 1, //si hay daros
        'msg' => [
          'id' => $lesson->id,
          'name' => $lesson->name,
          'section_id' => $lesson->section_id,
          'url' => $lesson->url,
          'description' => $lesson->description,
        ]
      ]);
    } else {
      return response()->json([
        'code' => 0,
        'msg' => 'No se encontro datos'
      ]);
    }
  }
}
