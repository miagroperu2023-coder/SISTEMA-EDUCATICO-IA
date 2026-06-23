<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        //return $user;
        if ($user->id === auth()->user()->id) {
            return view('visitador.profile.index', [
                'user' => $user
            ]);
        } else {
            echo "este perfil no te pertenece :(";
        }
    }
}
