<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;
use App\Notifications\TopicReplied;
use App\Models\User;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, User $user)
    {
        $this->validate($request, [
            'content' => 'required|max:14000'
        ]);

        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);

        $user->notify(new TopicReplied($request['content']));

        session()->flash('success', '发布成功！');
        return redirect()->back();
    }

    public function destroy(Status $status)
    {
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '微博已被成功删除！');
        return redirect()->back();
    }

    public function show(Status $status)
    {
        return view('statuses.show', compact('status'));
    }
}
