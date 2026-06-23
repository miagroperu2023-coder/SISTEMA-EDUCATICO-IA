<?php

namespace App\Http\Controllers\visitador\home;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Resource;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //INICIO DE LA PAGINA
    public function index()
    {

        //PARA EL CONTENIDO
        $courseIds = [12, 13, 14, 15];

        //$contenidos =  Resource::whereIn('resourceable_id', $courseIds)->get();

        $contenidos = Course::join('resources', 'courses.id', '=', 'resources.resourceable_id')
            ->join('images', 'courses.id', '=', 'images.imageable_id')
            ->select(
                'courses.title',
                'courses.id',
                'courses.subtitle',
                'resources.*',
                'images.url'
            )
            ->whereIn('resourceable_id', $courseIds)
            ->get();

        //CURSOS GRATIS    
        $coursesFree = Course::where('status', '=', 3)->whereIn('id', [22, 12, 14, 17])->get(); //LISTA DE CURSOS GRATIS

        //para mostrarlo de forma ascendente "de las mas actualizada y que me traiga solo 8"
        $courses = Course::where('status', '=', 3)->latest('id')->take(16)->get();
        return view('visitador.home.index', [
            'coursesFree' => $coursesFree,
            'courses' => $courses,
            'contenidos' => $contenidos
        ]);
    }

    public function contenido(Resource $resource)
    {
        $course = Course::find($resource->resourceable_id);
        return view('visitador.contenido.index', [
            'contenido' => $resource,
            'course' => $course
        ]);
    }

    public function panel()
    {
        $this->middleware('auth');

        $user =  auth()->user();
        $courses = Course::all();
        $compendios = Archive::where('type', 'C')->get();
        $archivos = Archive::where(function ($q) {
            $q->where('type', '<>', 'C')
                ->orWhereNull('type');
        })->get();
        $examenes = Exam::all();
        return view('visitador.home.panel', [
            'user' => $user,
            'courses' => $courses,
            'compendios' => $compendios,
            'archivos' => $archivos,
            'examenes' => $examenes
        ]);
    }
}
