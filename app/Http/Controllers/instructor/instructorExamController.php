<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class instructorExamController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:Gestión examen instructor');
    }

    public function index()
    {
        return view('instructor.exam.index');
    }
}
