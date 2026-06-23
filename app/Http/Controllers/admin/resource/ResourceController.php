<?php

namespace App\Http\Controllers\admin\resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gestion recursos');
    }

    public function index()
    {
        return view('admin.resource.index');
    }
}
