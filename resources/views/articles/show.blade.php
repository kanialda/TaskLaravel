@extends("layouts.application")
@section("content")
<div>
    <div>
        {!! link_to('excels/export', 'Export Article', array('class' => 'btn btn-success')) !!}
    </div>
  <h1>{!! $article->title !!}</h1>
  </div>
  
  <p>
    <img width="400", src={{asset('upload/' . $article->image)}}>
  </p>
  <p>
    {!! $article->content !!}
  </p>
  <i>By {!! $article->author !!}</i>
</div>

<div>
  <h4><i><font color="pink">Give Comments</font> </i></h4>
  {!! Form::open(array('url' => 'comments', 'class' => 'form-horizontal', 'role' => 'form')) !!}
  <div class="form-group-com">
    
    <div class="col-lg-9-com">
      {!! Form::text('article_id', $value = $article->id, array('class' => 'input-sm-com', 'readonly')) !!}
    <div class="clear"></div>
  </div>
  <div class="form-group-com">
    {!! Form::label('content', 'Content', array('class' => 'col-lg-3-com control-label')) !!}
    <div class="col-lg-9-com">
      {!! Form::textarea('content', null, array('class' => 'input-sm-com', 'rows' => 10, 'autofocus' => 'true')) !!}
      {!! $errors->first('content') !!}
    </div>
    <div class="clear"></div>
  </div>
  
  <div class="form-group-com">
    {!! Form::label('user_name', 'User', array('class' => 'col-lg-3-com control-label')) !!}
    <div class="col-lg-9-com">
      {!! Form::text('user_name', null, array('class' => 'input-sm-com')) !!}
    </div>
    <div class="clear"></div>
  </div>
  <div class="form-group-com">
    <div class="col-lg-3-com"></div>
    <div class="col-lg-9-com">
      {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
    </div>

    <div class="clear"></div>
  </div>

  {!! Form::close() !!}
</div>

@foreach($comments as $comment)

<hr >

    <font size="2px" >{!! $comment->content !!}</font>
  <br>
  <i><font size="0.5px" color="blue">{!! $comment->user_name !!}</font></i>

@endforeach

@stop