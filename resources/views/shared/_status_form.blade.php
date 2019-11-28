<form id="form_data" action="{{ route('statuses.store') }}"  method="POST">
{{----}}

  <link rel="stylesheet" href="{{asset('editormd/editormd.preview.min.css')}}" />
  <link rel="stylesheet" href="{{asset('editormd/editormd.min.css')}}" />


  <div id="editor">
    <!-- Tips: Editor.md can auto append a `<textarea>` tag -->
    <textarea style="display:none;" name="content"></textarea>
  </div>
  @include('shared._errors')
  {{ csrf_field() }}
{{--  <textarea class="form-control" rows="3" placeholder="share it..." name="content">{{ old('content') }}</textarea>--}}
  <div class="text-right">
    <button type="submit" class="btn btn-primary mt-3">发布</button>
  </div>
</form>

