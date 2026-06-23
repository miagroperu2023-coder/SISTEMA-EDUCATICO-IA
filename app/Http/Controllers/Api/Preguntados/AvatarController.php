<?php

namespace App\Http\Controllers\Api\Preguntados;

use App\Http\Controllers\Controller;
use App\Models\Avatar;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    //

    public function store(Request $request)
    {
        $userId = $request->user_id;

        $avatar = Avatar::updateOrCreate(
            ['user_id' => $userId],
            ['avatar_url' => $request->avatar_url]
        );

        return response()->json([
            'message' => 'Avatar guardado exitosamente ✅',
            'data' => $avatar
        ]);
    }

    public function show($user_id)
    {
        $avatar = Avatar::where('user_id', $user_id)->first();

        if (!$avatar) {
            return response()->json(['message' => 'Avatar no encontrado'], 404);
        }

        return response()->json($avatar);
    }
}
