<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAnswer;
use App\Post;
use App\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(StoreAnswer $request)
    {
        $post = Post::find($request->post_id);
        $answer = new Answer();
        $answer->user_id = Auth::id();
        $answer->content = $request->content;
        $answer->src = $request->src;
        $post->answers()->save($answer);

        return redirect()->route('posts.show', ['id' => $request->post_id]);
    }

    public function remove(int $post_id, int $answer_id)
    {
        $answer = Answer::find($answer_id)->delete();

        return view('posts.show', [
            'id' => $post_id,
            'post' => Post::find($post_id),
            'answers' => Answer::where('post_id', $post_id)->get(),
        ]);
    }
}
