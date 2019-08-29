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
        $user = User::find($id);
        $posts = Post::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
        $answers = Answer::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
        $selfPostsCount = Post::where('user_id', Auth::id())->count();  // ログインユーザの投稿件数
        $selfAnswersCount = Answer::where('user_id', Auth::id())->count();  // ログインユーザの回答件数
        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
            'answers' => $answers,
            'selfPostsCount' => $selfPostsCount,
            'selfAnswersCount' => $selfAnswersCount,
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
