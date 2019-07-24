<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show(int $id)
    {
        $current_user = User::find($id);
        return view('users.show', [
            'current_user' => $current_user,
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
