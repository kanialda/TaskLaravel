@extends("layouts.application")
@section("content")
{!! Form::open(['url' => 'sessions', 'class' => 'form-horizontal', 'role' => 'form']) !!}
<div class="form-group">
  {!! Form::label('username', 'Username', array('class' => 'col-lg-3 control-label')) !!}
  <div class="col-lg-4">
    {!! Form::text('username', null, array('class' => 'form-control')) !!}
    {!! $errors->first('username') !!}
  </div>
  <div class="clear"></div>
</div>

<div class="form-group">
  {!! Form::label('password', 'Password', array('class' => 'col-lg-3 control-label')) !!}
  <div class="col-lg-4">
    {!! Form::password('password', array('class' => 'form-control')) !!}
    {!! $errors->first('password') !!}
  </div>
  <div class="clear"></div>
</div>

<div class="form-group">
  {!! Form::label('remember', 'Remember Me', array('class' => 'col-lg-3 control-label')) !!}
  <div class="col-lg-4">
    {!! Form::checkbox('remember', null, array('class' => 'form-control')) !!}
  </div>
  <div class="clear"></div>
</div>

<div class="form-group">
  <div class="col-lg-3"></div>
  <div class="col-lg-4">
    {!! Form::submit('Login', array('class' => 'btn btn-primary')) !!}
  </div>
  <div class="clear"></div>
</div>

{!! Form::close() !!}

@stop