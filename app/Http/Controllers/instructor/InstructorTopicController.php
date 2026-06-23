<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructorTopicController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:Gestión tema instructor');
    }

    public function index()
    {
        return view('instructor.topic.index');
    }
}
