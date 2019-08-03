<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAnswer;
use App\Post;
use App\Answer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateAnswer;
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

    public function edit(int $post_id, int $answer_id)
    {
        $answer = Answer::find($answer_id);
        $post = Post::find($post_id);
        return view('answers.edit', [
            'post'=>$post,
            'answer'=>$answer,
        ]);

    }

    public function update(UpdateAnswer $request, int $post_id, int $answer_id)
    {
        $post = Post::find($post_id);
        $answer = Answer::find($answer_id);
        $answer->src = $request->src;
        $answer->content = $request->content;
        $answer->save();

        return redirect()->route('posts.show', [
            'id'=>$post->id,
        ]);
    }
}
