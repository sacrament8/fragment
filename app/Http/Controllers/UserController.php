<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Answer;
use App\Post;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(int $id)
    {
        $current_user = User::find($id);
        $posts = Post::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
        $answers = Answer::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
        return view('users.show', [
            'current_user' => $current_user,
            'posts' => $posts,
            'answers' => $answers,
        ]);
    }

    public function edit(int $id)
    {
        $current_user = User::find($id);
        return view('users.edit', [
            'current_user' => $current_user,
        ]);
    }
}
