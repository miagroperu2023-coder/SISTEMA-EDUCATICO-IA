<?php

namespace App\Http\Controllers\visitador\post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //lista de publicaciones y que le den linke o dislike
    public function index()
    {
        $user = auth()->user();

        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            return view('visitador.post.index');
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }

    //para ver cada publicacion y poder comentar
    public function comment(Post $post)
    {
        //dd($post);
        $user = auth()->user();

        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionSixMonth', $user) || Gate::allows('viewSubscriptionYear', $user)) {
            $randomPosts = Post::inRandomOrder()->limit(4)->get();
            return view('visitador.post.comment', [
                'post' => $post,
                'randomPosts' => $randomPosts
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }
}
