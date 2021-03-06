<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img alt="Brand" src="/assets/img/lauren.png" width="35px"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active">
          <a href="/">Home<span class="sr-only">(current)</span></a>
        </li>
        <li>
          <a href="#">Gallery</a>
        </li>
        <li>
          <a href="articles">Article</a>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        
        <li>
          {!! link_to('users/create', 'Sign up') !!}
        </li>
        @if (Auth::check())
        <li>
          {!! link_to('logout', 'Logout') !!}
        </li>
        @else
        <li>
          {!! link_to('', 'Login') !!}
        </li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>