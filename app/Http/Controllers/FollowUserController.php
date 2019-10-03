<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FollowUser;
use Illuminate\Support\Facades\Auth;
use App\User;

class FollowUserController extends Controller
{
    public function index()
    {
        $folloers = Auth::user()->followers();
        $data = [
            'followers' => $folloers,
        ];
        return view('follow_users.index', $data);
    }

    public function store(int $id)
    {
        $followedUser = User::findOrFail($id);
        FollowUser::firstOrCreate([
            'user_id' => Auth::id(),
            'followed_user_id' => $followedUser->id,
        ]);
        if (url()->previous() == route('follow.index')) {
            return redirect()->action('FollowUserController@index');
        } else {
            return redirect()->route('users.show', ['id' => $id]);
        }
    }

    public function destroy($id)
    {
        $followedUser = User::findOrFail($id);
        $user = Auth::user();
        $user->followUsers()->detach($followedUser->id);
        if (url()->previous() == route('follow.index')) {
            return redirect()->action('FollowUserController@index');
        } else {
            return redirect()->route('users.show', ['id' => $id]);
        }
    }
}
