<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Mail\MailUserRecover;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RecoverController extends Controller
{

    public function recover()
    {
        return view('admin.auth.send');
    }

    //formulario para recuperar contraseña
    public function send(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required'
            ]);

            //mandar  correo
            $user = User::whereEmail($request->email)->first();


            if (!$user) {
                return back()->with('mensaje', 'El correo proporcionado no existe en nuestra base de datos');
            } else {
                $roles = $user->getRoleNames();
                if ($roles->contains('Admin') || $roles->contains('Instructor')) {
                    return back()->with('mensaje', 'Ingrese su correo por favor, el correo proporcionado no es valido.');
                } else {
                    if ($user) {
                        Mail::to($request->email)->send(new MailUserRecover($user));
                        return back()->with('mensaje', 'Se envio un mensaje al correo proporcionado');
                    } else {
                        return back()->with('sin_correo', 'El correo proporcionado no existe en nuestra base de datos');
                    }
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function index()
    {
        return view('admin.auth.recover');
    }

    //metodo para actualizar los datos
    public function update(Request $request)
    {
        //VALIDACIONES DE LOS CAMPOS DEL FORMULARIO
        $this->validate($request, [
            'email' => 'required|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        //actualizamos los datos
        $user = User::whereEmail($request->email)->first();

        if (!$user) {
            return back()->with('mensaje', 'El correo proporcionado no existe en nuestra base de datos');
        } else {
            $roles = $user->getRoleNames();
            if ($roles->contains('Admin') || $roles->contains('Instructor')) {
                return back()->with('mensaje', 'Ingrese su correo por favor, el correo proporcionado no es valido.');
            } else {
                if ($user) {
                    /*actualizamos datos*/
                    $user->update([
                        'password' => Hash::make($request->password)
                    ]);

                    //aqui guarda los datos del update en una tabla para mayor seguridad, solo una vez que se pueda cambiar el correo
                    //para la otra que te pidan para mayor seguridad

                    return back()->with('mensaje', 'Se restablecio los datos correctamente');
                } else {
                    return back()->with('mensaje', 'El correo proporcionado no existe');
                }
            }
        }
    }
}
