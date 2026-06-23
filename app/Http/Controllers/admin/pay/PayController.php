<?php

namespace App\Http\Controllers\admin\pay;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Admin\Pays;
use App\Models\Pay;
use App\Models\User;
use Illuminate\Http\Request;

class PayController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gestion pagos');
    }

    public function index()
    {
        $pays = Pay::all();
        return view('admin.pay.index', [
            'pays' => $pays
        ]);
    }

    public function list()
    { 
        $pays =  User::join('pays', 'users.id', '=', 'pays.user_id')
        ->select(
            'users.*',
            'pays.id',
            'pays.payment_id',
            'pays.status',
            'pays.payment_type',
            'pays.preference_id',
            'pays.estado'
        )
        ->whereIn('pays.estado', ['POR ATENDER'])
        ->get();

        return view('admin.pay.list', [
            'pays' => $pays
        ]);

    }
}
