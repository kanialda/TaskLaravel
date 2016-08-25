@extends("layouts.application")
@section("content")
<div class="container">
    <h2>Import Article</h2>
    <div class="row">
  <form action="postImport" method="post" enctype="multipart/form-data" class="navbar-form navbar-left">
    <div class="form-group">
      <input type="hidden" name="_token" value="{{csrf_token()}}" />
      <input type="file" name="article"  placeholder="Import">
    </div>
    <button type="submit" class="btn btn-default" value="Import">
      Submit
    </button>
  </form>
  </div>
</div>
@stop