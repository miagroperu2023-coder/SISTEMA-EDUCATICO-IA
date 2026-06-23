<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:Profile instructor')->only('index');
    }

    public function index(User $user)
    {
        return view('instructor.profile.index', [
            'user' => $user
        ]);
    }
}
