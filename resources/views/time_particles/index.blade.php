@extends('layouts.default')
@section('title', '时间粒子')

@section('content')
<div class="offset-md-2 col-md-8">
  <h2 class="mb-4 text-center" v-if="seen" id="app-3">时间粒子</h2>
  <div class="list-group list-group-flush">
    @foreach ($timeParticles as $timeParticle)
      <div class="list-group-item">
        {{ $timeParticle->created_at }}
      </div>
    @endforeach
  </div>

  <div class="mt-3">
    {!! $timeParticles->render() !!}
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
