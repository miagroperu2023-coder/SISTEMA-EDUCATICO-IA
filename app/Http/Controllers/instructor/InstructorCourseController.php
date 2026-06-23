<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Image;
use App\Models\Level;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class InstructorCourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:Gestión mis cursos instructor');
        $this->middleware('can:Listar cursos')->only('index');
        $this->middleware('can:Crear cursos')->only('create', 'store');
        $this->middleware('can:Editar cursos')->only('edit', 'update');
        $this->middleware('can:Eliminar cursos')->only('destroy');
    }

    //
    public function index()
    {
        $courses = Course::where('user_id', '=', auth()->user()->id)->get();

        return view('instructor.course.index', [
            'courses' => $courses
        ]);
    }
    public function create()
    {
        //PARA LARAVEL COLECTIVE SE PASA DE ESTA FORMA CUANDO QUIERES ITERAR DATOS
        $categories = Category::pluck('name', 'id');
        $levels = Level::pluck('name', 'id');
        $prices = Price::pluck('value', 'id');
        return view('instructor.course.create', [
            'categories' => $categories,
            'levels' => $levels,
            'prices' => $prices
        ]);
    }

    public function store(Request $request)
    {
        $request->request->add(['slug' => Str::slug($request->title)]); //PONER EN MINUSCULA Y LOS ESPACION LO RELLENA CON "-"

        $this->validate($request, [
            'title' => 'required|unique:courses',
            'subtitle' => 'required',
            'description' => 'required',
            'level_id' => 'required',
            'category_id' => 'required',
            'price_id' => 'required'
        ]);

        $course = Course::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'status' => Course::BORRADOR,
            'slug' => $request->slug,
            'user_id' => auth()->user()->id,
            'level_id' => $request->level_id,
            'category_id' => $request->category_id,
            'price_id' => $request->price_id
        ]);

        //guadando la url de la imagen en la tabla image
        if (isset($request->photo)) {
            $image = $request->photo;
        } else {
            $image = 'https://i.postimg.cc/cJBC6tty/carrasco-960.jpg';
        }

        Image::create([
            'url' =>  $image,
            'imageable_id' => $course->id,
            'imageable_type' => 'App\Models\Course'
        ]);

        return redirect()->route('admin.instructor.course.edit', $course);
    }

    public function edit(Course $course)
    {
        //POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
        $this->authorize('dicatated', $course);


        //PARA LARAVEL COLECTIVE SE PASA DE ESTA FORMA CUANDO QUIERES ITERAR DATOS
        $categories = Category::pluck('name', 'id'); //[]
        $levels = Level::pluck('name', 'id');
        $prices = Price::pluck('value', 'id');

        return view('instructor.course.edit', [
            'course' => $course,
            'categories' => $categories,
            'levels' => $levels,
            'prices' => $prices
        ]);
    }

    public function update(Request $request, Course $course)
    {
        //POLICE PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR "usuario logeado"
        $this->authorize('dicatated', $course);

        $request->request->add(['slug' => Str::slug($course->title)]); //PONER EN MINUSCULA Y LOS ESPACION LO RELLENA CON "-"

        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'level_id' => 'required',
            'category_id' => 'required',
            'price_id' => 'required'
        ]);

        $course->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'slug' => $request->slug,
            'user_id' => auth()->user()->id,
            'level_id' => $request->level_id,
            'category_id' => $request->category_id,
            'price_id' => $request->price_id
        ]);

        //actualizando la url de la imagen en la tabla image
        if (isset($request->photo)) {
            $course->image->update([
                'url' =>  $request->photo,
            ]);
        }

        return redirect()->route('admin.instructor.course.edit', $course);
    }

    public function status(Course $course)
    {
        $course->status = 2;
        $course->save();
        return back();
    }
}
