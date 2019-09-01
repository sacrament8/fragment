<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Answer;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Services\GetWeatherService;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(int $id, GetWeatherService $getweatherservice)
    {
        $user = User::find($id);
        $posts = Post::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
        $answers = Answer::where('user_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get();
        $selfPostsCount = Post::where('user_id', Auth::id())->count();  // ログインユーザの投稿件数
        $selfAnswersCount = Answer::where('user_id', Auth::id())->count();  // ログインユーザの回答件数

        $today_weather = $getweatherservice->getWeather(User::find($id));    // 外部apiから今日の天気取得して整形
        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
            'answers' => $answers,
            'selfPostsCount' => $selfPostsCount,
            'selfAnswersCount' => $selfAnswersCount,
            'today_weather' => $today_weather,
        ]);
    }

    public function edit(int $id)
    {
        $current_user = User::find($id);
        return view('users.edit', [
            'current_user' => $current_user,
        ]);
    }

    public function usersposts(User $user)
    {
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('users.usersposts', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function usersanswers(User $user)
    {
        $answers = Answer::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('users.usersanswers', [
            'user' => $user,
            'answers' => $answers,
        ]);;
    }
}
