<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\StorePost;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePost $request)
    {
        $post = Auth::user()->posts()->fill($request->all())->save();
        return redirect()->route('posts.show', ['id' => $post->id]);
    }
}
