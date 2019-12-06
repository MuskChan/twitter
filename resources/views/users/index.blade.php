@extends('layouts.default')
@section('title', '所有用户')

@section('content')
<div class="offset-md-2 col-md-8">
  <h2 class="mb-4 text-center" v-if="seen" id="app-3">所有用户</h2>
  <div class="list-group list-group-flush">
    @foreach ($users as $user)
      @include('users._user')
    @endforeach
  </div>

  <div class="mt-3">
    {!! $users->render() !!}
  </div>
</div>
@stop

@section('scriptsAfterJs')
  <script type="text/javascript">
    var app3 = new Vue({
      el: '#app-3',
      data: {
        seen: false
      }
    })
  </script>
@stop
