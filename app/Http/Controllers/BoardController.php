<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\User;
use App\Http\Requests\StoreBoard;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::all();

        return view('boards.index', [
            'boards' => $boards,
        ]);
    }

    public function show(int $id)
    {
        $board = Board::find($id);
        $comments = $board->comments();

        return view('boards.show', [
            'board' => $board,
            'comments' => $comments,
        ]);
    }

    public function create()
    {
        return view('boards.create');
    }

    public function store(StoreBoard $request)
    {
        $board = new Board();
        $board->title = $request->title;
        $board->content = $request->content;
        Auth::user()->boards()->save($board);

        return redirect()->route('boards.index');
    }
}
