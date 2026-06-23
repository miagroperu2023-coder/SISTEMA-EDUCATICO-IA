<?php

namespace App\Http\Controllers\visitador\solve;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SolveController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Post $post)
    {
        return view('visitador.solve.index', [
            'post' => $post,
        ]);
    }

    //PARA PODER GUARDAR LA PIZARRA
    public function firmar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'signature' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'  => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            // Depurar la firma
            $signature = $request->input('signature');
            // Puedes usar Log::info($signature) para verificar el valor en los logs


            $save = Comment::create([
                'content' => $signature,
                'user_id' => auth()->user()->id,
                'commentable_id' => 5,
                'commentable_type' => Post::class,
                'parent_id' => null //cuando es publicacion inicial, el parent_id es null de lo contraio iriaa el id de la publicacion 
            ]);

            if ($save) {
                return response()->json([
                    'code' => 1,
                    'msg' => 'Firma Agregada Correctamente',
                    'post_id' => $save->commentable_id
                ]);
            }
        }
    }
}
