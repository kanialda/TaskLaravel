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

<script>
    $(document).ready(function() {
    var options = { 
                beforeSubmit:  showRequest,
        success:       showResponse,
        dataType: 'json' 
        }; 
    $('body').delegate('#image','change', function(){
        $('#upload').ajaxForm(options).submit();        
    }); 
});     
function showRequest(formData, jqForm, options) { 
    $("#validation-errors").hide().empty();
    $("#output").css('display','none');
    return true; 
} 
function showResponse(response, statusText, xhr, $form)  { 
    if(response.success == false)
    {
        var arr = response.errors;
        $.each(arr, function(index, value)
        {
            if (value.length != 0)
            {
                $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
            }
        });
        $("#validation-errors").show();
    } else {
         $("#output").html("<img src='"+response.file+"' />");
         $("#output").css('display','block');
    }
}
</script>
@stop