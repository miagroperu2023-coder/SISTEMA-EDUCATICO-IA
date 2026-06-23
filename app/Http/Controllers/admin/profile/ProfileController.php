<?php

namespace App\Http\Controllers\admin\profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:Profile admin')->only('index');
    }

    public function index(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return view('admin.profile.index', [
                'user' => $user
            ]);
        } else {
            echo "este perfil no te pertenece :(";
        }
    }
}
