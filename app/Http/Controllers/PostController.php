<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (empty($request->search)) {
            $posts = Post::paginate(15);
        } else {
            $search = $request->search;
            $posts = Post::where('title', 'LIKE', "%$search%")->paginate(15);
        }

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
        $post = new Post();
        $post->title = $request->title;
        $post->src = $request->src;
        $post->content = $request->content;

        $post = Auth::user()->posts()->save($post);
        return redirect()->route('posts.show', ['id' => $post->id]);
    }

    public function show(int $id)
    {
        $post = Post::find($id);
        $answers = $post->answers();

        return view('posts.show', [
            'post' => $post,
            'answers' => $answers,
        ]);
    }

    public function edit(int $id)
    {
        $post = Post::find($id);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    public function update(UpdatePost $request, int $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->src = $request->src;
        $post->content = $request->content;
        $post->save();

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function remove(int $id)
    {
        $post = Post::find($id)->delete();

        return view('posts.index', [
            'posts' => Post::all(),
        ]);
    }
}
