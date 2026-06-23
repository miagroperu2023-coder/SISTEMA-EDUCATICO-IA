<?php

namespace App\Http\Controllers\admin\post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('can:gestion publicaciones');
    }

    public function index()
    {
        return view('admin.post.index');
    }

    public function store(Request $request)
    {
        //validaciones
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        // Mostrar los datos enviados desde el formulario
        //dd($request->all());

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => 1, //activo
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back();
    }

    public function list()
    {
        $posts = Post::all();
        return view('admin.post.list', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('admin.post.show', [
            'post' => $post
        ]);
    }

    public function update(Post $post, Request $request)
    {
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => 1, //activo
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('admin.posts.list');
    }
}
