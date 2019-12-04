<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function store(ReplyRequest $request, Reply $reply)
    {
        $data = $request->except('_token');

        $reply->content = $data['content'];
        $reply->user_id = Auth::id();
        $reply->status_id = $data['status_id'];
        $reply->save();

        return redirect()->to($reply->status->link())->with('success', '评论创建成功');
    }
}
