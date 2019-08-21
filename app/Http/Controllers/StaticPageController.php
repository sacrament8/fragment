<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaticPageController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return redirect()->route('users.show', $user->id);
        }
        return view('staticpages.index');
    }
}
