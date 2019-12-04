@extends('layouts.default')
@section('title', '推文')

@section('content')
  <li class="media mt-4 mb-4">
    <div class="media-body">
      <h5 class="mt-0 mb-1">
        <small>    {{ $status->created_at->diffForHumans() }}</small>
      </h5>
      {!! parsedown($status->content, true) !!}
    </div>

    @can('destroy', $status)
      <form action="{{ route('statuses.destroy', $status->id) }}" method="POST" onsubmit="return confirm('您确定要删除本条微博吗？');">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-sm btn-danger">删除</button>
      </form>
    @endcan
  </li>

  <div class="reply-box">
    <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="status_id" value="{{ $status->id }}">
      <div class="form-group">
        <textarea class="form-control" rows="3" placeholder="分享你的见解~" name="content"></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share mr-1"></i> 回复</button>
    </form>
    @include('statuses._reply_list', ['replies' => $status->replies()->with('user')->get()])
  </div>
  <hr>
@stop

