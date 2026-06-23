<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConditionController extends Controller
{
    //
    public function index()
    {
        return view('visitador.condiciones.index');
    }
}
