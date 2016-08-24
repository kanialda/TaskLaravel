@extends("layouts.application")
@section("content")
<script src="/assets/js/masonry-docs.min.js"></script>
<div class="row">
  <div class="col-md-12 search">
    <div class="col-md-6">
      <div class="input-group input-group-sm">
        <input type="text" class="form-control" id="keywords" placeholder="Keywords">
        <span class="input-group-btn">
          <button id="search" class="btn btn-info btn-flat" type="button">
            Go!
          </button> </span>
      </div><!-- /input-group -->
    </div>
  </div>
</div>
<div>
  {!! link_to('articles/create', 'Write Article', array('class' => 'btn btn-success')) !!}
</div>
 <div id="list-article">
    @include('articles.list')
  </div>
<div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 100 }'>
  <div class="grid">

    @foreach ($articles as $article)
    <div class="grid-item">
      <div>
        <h1>{{$article->title}}</h1>
      </div>
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

      @endforeach
      {!! $articles->render() !!}
      </div>
    </div>
  </div>
  <script>
    $('#search').on('click', function() {
        $.ajax({
            url : '/articles',
            type : 'GET',
            dataType : 'json',
            data : {
                'keywords' : $('#keywords').val()
            },
            success : function(data) {
                $('#articles-list').html(data['view']);
            },
            error : function(xhr, status) {
                console.log(xhr.error + " ERROR STATUS : " + status);
            },
            complete : function() {
                alreadyloading = false;
            }
        });
    });
  </script>

  <script>
    $(document).ready(function() {
    $(document).on('click', '.pagination a', function(e) {
    get_page($(this).attr('href').split('page=')[1]);
    e.preventDefault();
    });
    });
    function get_page(page) {
    $.ajax({
    url : '/articles?page=' + page,
    type : ‘GET’,
    dataType : 'json',
    success : function(data) {
    $('#articles-list').html(data['view']);
    },
    error : function(xhr, status, error) {
    console.log(xhr.error + "\n ERROR STATUS : " + status + "\n" + error);
    },
    complete : function() {
    alreadyloading = false;
    }
    });
    }
  </script>
  @stop
