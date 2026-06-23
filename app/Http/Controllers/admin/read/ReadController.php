<?php

namespace App\Http\Controllers\admin\read;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gestion recursos');
    }

    public function index()
    {
        return view('admin.read.index');
    }
}
