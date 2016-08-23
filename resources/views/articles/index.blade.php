@section("content")
@extends("layouts.application")
<script src="/assets/js/masonry-docs.min.js"></script>
<div>
  {!! link_to('articles/create', 'Write Article', array('class' => 'btn btn-success')) !!}
</div>


  <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 100 }'>
    <div class="grid">
    @foreach ($articles as $article)
    <div class="grid-item">
    <div>
      <h1>{{$article->title}}</h1>
      <p>
        <img src={{$article->image}}>
      </p>
      <p>
        {{$article->content}}
      </p>
      <i>By {{$article->author}}</i>
      <div>
        {!! link_to('articles/'.$article->id, 'Show', array('class' => 'btn btn-info')) !!}
        {!! link_to('articles/'.$article->id.'/edit', 'Edit', array('class' => 'btn btn-warning')) !!}
        {!! Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete')) !!}
        {!! Form::submit('Delete', array('class' => 'btn btn-danger', "onclick" => "return confirm('are you sure?')")) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
</div>
@endforeach
@stop
