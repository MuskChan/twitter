<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Twitter') - Record something</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- editormd -->
    <link rel="stylesheet" href="{{asset('editormd/editormd.preview.min.css')}}" />
    <link rel="stylesheet" href="{{asset('editormd/editormd.min.css')}}" />
  </head>

  <body>
    @include('layouts._header')

    <div class="container">
      <div class="offset-md-1 col-md-10">
        @include('shared._messages')
        @yield('content')
        @include('layouts._footer')
      </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
  </body>
  <!-- JS 脚本 -->
  <!-- development version, includes helpful console warnings -->
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  @yield('js')
  @yield('scriptsAfterJs')
</html>

