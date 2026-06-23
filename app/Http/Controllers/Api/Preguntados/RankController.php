<?php

namespace App\Http\Controllers\Api\Preguntados;

use App\Http\Controllers\Controller;
use App\Models\GamePlayer;
use App\Models\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{
    //
    //
    public function show($user_id)
    {
        //sumando los puntos ganados
        $totalPoints = GamePlayer::where('user_id', $user_id)
            ->sum('score');

        // Rango actual
        $currentRank = Rank::where('min_points', '<=', $totalPoints)
            ->where(function ($query) use ($totalPoints) {
                $query->where('max_points', '>=', $totalPoints)
                    ->orWhereNull('max_points');
            })
            ->first();

        // Todos los rangos (para el mapa)
        $ranks = Rank::orderBy('min_points')->get();

        return response()->json([
            'totalPoints' => $totalPoints,
            'currentRank' => $currentRank,
            'ranks' => $ranks,
        ]);
    }

    //rango de los 10 primeros puestos
    public function topPlayers()
    {
        $ranking = GamePlayer::select('user_id')
            ->selectRaw('SUM(score) as total_points')
            ->groupBy('user_id')
            ->with('user.avatar')
            ->orderByDesc('total_points')
            ->limit(10)
            ->get();

        return response()->json([
            'ranking' => $ranking
        ]);
    }
}
