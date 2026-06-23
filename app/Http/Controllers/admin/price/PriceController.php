<?php

namespace App\Http\Controllers\admin\price;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gestion precios');
    }
    
    public function index()
    {
        return view('admin.price.index');
    }
}
