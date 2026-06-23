<?php

namespace App\Http\Controllers\visitador\testimonial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    //
    public function index()
    {
        return view('visitador.testimonial.index');
    }
}
