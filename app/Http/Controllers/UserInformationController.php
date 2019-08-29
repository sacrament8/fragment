<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInformationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserInformation;
use Illuminate\Support\Facades\DB;

class UserInformationController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(User $user)
    {
        if (DB::table('user_informations')->where('user_id', $user->id)->exists()) {
            $user_info = $user->userInformation;
        } else {
            $user_info = $user->userInformation()->create();
        }

        return view('user_informations.edit', [
            'user' => $user,
            'user_info' => $user_info,
        ]);
    }

    public function update(UserInformationRequest $request)
    {
        $user_info = UserInformation::where('user_id', Auth::id());
        if (!empty($request->avatar)) {
            $filename = $request->file('avatar')->store('public/avatar_images');
            $user_info->avatar = basename($filename);
            $user_info->update(['avatar' => basename($filename)]);
        }
        return redirect()->route('users.show', ['id' => Auth::id()]);
    }
}
