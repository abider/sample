<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Sessionscontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        $user = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($user, $request->has('remember'))) {
            session()->flash('success', '恭喜您，登陸成功');
            return Redirect()->intended(route('users.show', Auth::id()));
        } else {
            session()->flash('danger', '驗證不通過！登陸失敗');
            return back();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出登錄！');
        return Redirect()->route('login');
    }
}
