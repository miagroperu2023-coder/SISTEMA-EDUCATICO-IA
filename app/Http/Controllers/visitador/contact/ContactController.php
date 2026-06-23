<?php

namespace App\Http\Controllers\visitador\contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index()
    {
        return view('visitador.contact.index');
    }
}
