<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta httpequiv="XUACompatible" content="IE=edge">
    <meta name="viewport" content="width=devicewidth, initialscale=1">
    <title>Articles</title>
    <link href="/assets/css/bootstrap.css" rel="stylesheet" />
    <script src="/assets/js/bootstrap.js"></script>
  </head>
  <body style="padding-top:60px;">
    <!--bagian navigation-->
    @include('shared.head_nav')
    <!-- Bagian Content -->
    <div class="container clearfix">
      <div class="row row-offcanvas row-offcanvas-left ">
        
        <!--Bagian Kanan-->
        <div id="main-content" class="col-xs-12 col-sm-9 main pull-right">
          <div class="panel-body">
            @if (Session::has('error'))
            <div class="session-flash alert-danger">
              {{Session::get('error')}}
            </div>
            @endif
            @if (Session::has('notice'))
            <div class="session-flash alert-info">
              {{Session::get('notice')}}
            </div>
            @endif
            @yield("content")
          </div>
        </div>
      </div>
    </div>
    <script src="/js/jquery-1.1.js"></script>
    <script src="/js/bootstrap.js"></script>
     <script src="/assets/js/custom.js"></script>
  </body>
</html>