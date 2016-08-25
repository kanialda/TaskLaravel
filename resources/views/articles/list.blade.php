@foreach ($articles as $article)
<div class="grid-item">
  <div>
    <h1>{{$article->title}}</h1>
  </div>
  <p>
    <img width="200", src={{asset('upload/' . $article->image)}}>
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
@endforeach


