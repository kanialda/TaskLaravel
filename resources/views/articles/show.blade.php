@extends("layouts.application")
@section("content")

<div>
  <h1>{!! $article->title !!}</h1>
  <p>
    {!! $article->content!!}
  </p>
  <i>By {!! $article->author !!}</i>
</div>

@stop