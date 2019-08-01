<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Board;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreComment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(StoreComment $request)
    {
        $board = Board::find($request->board_id);
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $board->comments()->save($comment);

        return redirect()->route('boards.show', [
            'id' => $board->id,
        ]);
    }
}
