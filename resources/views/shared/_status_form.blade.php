<form id="form_data" action="{{ route('statuses.store') }}"  method="POST">
  <div id="editor">
    <!-- Tips: Editor.md can auto append a `<textarea>` tag -->
    <textarea style="display:none;" placeholder="share it..." name="content">{{ old('content') }}</textarea>
  </div>
  @include('shared._errors')
  {{ csrf_field() }}
  <div class="text-right">
    <button type="submit" class="btn btn-primary mt-3">发布</button>
  </div>
</form>

