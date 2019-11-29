<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Twitter') - Record something</title>
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
  @yield('js')
  @yield('scriptsAfterJs')
</html>

