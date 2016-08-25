@extends("layouts.application")
@section("content")
<script src="/assets/js/masonry-docs.min.js"></script>
<div class="row">
<form class="navbar-form navbar-left">
          <div class="form-group">
            <input type="text" name="keywords" id="keywords" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default" id="search">
            Submit
          </button>
        </form>
</div>
<div>
  {!! link_to('articles/create', 'Write Article', array('class' => 'btn btn-success')) !!}
  {!! link_to('excels/getImport', 'Import Article', array('class' => 'btn btn-info')) !!}
</div>

<div id="article-list">
  <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 100 }'>
    <div class="grid">
      @include('articles.list')
    </div>
  </div>
</div>
{!! $articles->render() !!}
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
  }</script>

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
@stop

