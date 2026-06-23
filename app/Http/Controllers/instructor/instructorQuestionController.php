<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class instructorQuestionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:Gestión preguntas instructor');
    }

    public function index()
    {
        return view('instructor.question.index');
    }
}
