<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['store', 'destroy']);
    }

    public function store($id)
    {
        $user = User::findOrfail($id);

        if ($user->id === Auth::user()->id) {
            return redirect('/');
        }

        if (!Auth::user()->isFollowing($id)) {
            Auth::user()->follow($id);
        }

        return redirect()->route('users.show', $id);
    }

    public function destroy($id)
    {
        $user = User::findOrfail($id);

        if ($user->id === Auth::user()->id) {
            return redirect('/');
        }

        if (Auth::user()->isFollowing($id)) {
            Auth::user()->unfollow($id);
        }

        return redirect()->route('users.show', $id);
    }
}
