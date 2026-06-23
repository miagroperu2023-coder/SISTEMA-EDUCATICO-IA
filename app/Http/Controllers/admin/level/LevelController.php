<?php

namespace App\Http\Controllers\admin\level;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gestion nivel');
    }

    public function index()
    {
        return view('admin.level.index');
    }
}
