@extends('layouts.default')

@section('content')
  @if (Auth::check())
    <div class="row">
      <div class="col-md-8">
        <section class="status_form">
          @include('shared._status_form')
        </section>
        <h4>twitter List</h4>
        <hr>
        @include('shared._feed')
      </div>
      <aside class="col-md-4">
        <section class="user_info">
          @include('shared._user_info', ['user' => Auth::user()])
        </section>
        <section class="stats mt-2">
          @include('shared._stats', ['user' => Auth::user()])
        </section>
      </aside>
    </div>
  @else
    <div class="row">
      <div class="col-md-8">
        <section class="status_form">
          @include('shared._status_form')
        </section>
        <h4>twitter List</h4>
        <hr>
        @include('shared._feed')
      </div>
    </div>
  @endif
@stop
<script src="https://cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
<script src="{{asset('editormd/editormd.min.js')}}"></script>
<script src="{{asset('editormd/marked.min.js')}}"></script>
<script src="{{asset('editormd/prettify.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
@section('script')
  <script type="text/javascript">

    $(function() {
      var editor = editormd("editor", {
        width: "100%",
        height: 240,
        watch : false,
        // markdown: "xxxx",     // dynamic set Markdown text
        toolbarIcons : function() {
          // Or return editormd.toolbarModes[name]; // full, simple, mini
          // Using "||" set icons align right.
          return ["undo", "redo", "|", "bold", "hr"]
        },
        path : "editormd/lib/"  // Autoload modules mode, codemirror, marked... dependents libs path
      });

      @foreach ($feed_items as $status)
      @endforeach
      var testView = editormd.markdownToHTML("test-markdown-view0", {
          // markdown : "[TOC]\n### Hello world!\n## Heading 2", // Also, you can dynamic set Markdown text
          // htmlDecode : true,  // Enable / disable HTML tag encode.
          // htmlDecode : "style,script,iframe",  // Note: If enabled, you should filter some dangerous HTML tags for website security.
        });
    });


{{--    document.getElementById('content{{$loop->index}}').innerHTML =--}}
{{--      marked('{{ $status->content }}');--}}
  </script>
@stop
