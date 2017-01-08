<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['store', 'destroy']
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);

        Auth::user()->statuses()->create([
            'content' => $request->content
        ]);

        session()->flash('success', '发布动态成功！');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '动态删除成功！');
        return back();
    }
}
