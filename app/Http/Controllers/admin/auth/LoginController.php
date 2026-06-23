<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    ///login
    public function index()
    {
        return view('admin.auth.login');
    }

    //store login
    public function store(Request $request)
    {
        //validaciones
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //autenticando con la base de datos
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Tus credenciales estan incorrectas');
        } else {
            // Usuario autenticado
            return auth()->user()->redirectToDashboard();
        }
    }
}
