<?php

namespace App\Http\Controllers\admin\plan;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $plans = Plan::all();
        return view('admin.plan.index', [
            'plans' => $plans
        ]);
    }

    public function create()
    {
        return view('admin.plan.create');
    }

    public function store(Request $request)
    {
        // validación básica
        $request->validate([
            'promo_code' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'months' => 'required|integer',
            'monthly_price' => 'required|numeric',
            'percentage' => 'required|numeric',
            'activo' => 'boolean',
        ]);

        $request->request->add(['slug' => Str::slug($request->name)]); //PONER EN MINUSCULA Y LOS ESPACION LO RELLENA CON "-"
        // guardar
        $plan = Plan::create([
            'promo_code'   => $request->promo_code,
            'slug' => $request->slug,
            'user_id'      => auth()->user()->id,
            'name'         => $request->name,
            'months'       => $request->months,
            'monthly_price' => $request->monthly_price,
            'percentage'   => $request->percentage,
            'activo'       => $request->activo ?? true, // default
        ]);

        if ($plan) {
            return redirect()->route('admin.plan.index')
                ->with('exito', 'Plan creado correctamente');
        } else {
            echo "no guardado";
        }
    }
}
