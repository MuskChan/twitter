@extends('layouts.default')
@section('title', '关于')

@section('content')
  <p id="app">Record something，比如一些人民日报文摘、自己的所思所想；以及分享一些值得分享的东东 @{{ message }}</p>
@stop

@section('scriptsAfterJs')
  <script type="text/javascript">
    var app = new Vue({
      el: '#app',
      data: {
        message: 'Hello Vue!'
      }
    })
  </script>
@stop
