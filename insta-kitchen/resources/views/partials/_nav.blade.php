
 <nav class="navbar navbar-default">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand {{ Request::is('/') ? "active" : "" }}" href="/">InstaKitchen</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="{{ Request::is('about') ? "active" : "" }}"><a href="/about">About</a></li>
        <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="/contact">Contact</a></li>
      </ul>
      
      
          <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
            <li><a href="{{ route('notifications.index') }}">Notifications <span class="badge">{{ App\Http\Controllers\PagesController::getNotifications() }}</span></a></li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    Welcome {{ Auth::user()->name }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Account</a></li>
                  <li><a href="{{ route('posts.index', Auth::user()->id ) }}" >Posts</a></li>
                  <li role="separator" class="divider"></li>
                  @if (Auth::user()->status == 0) 
                  <li><a href="{{ route('categories.index') }}">Categories</a></li>
                  <li><a href="{{ route('tags.index') }}">Tags</a></li>
                  <li role="separator" class="divider"></li>
                  @endif
                  <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
              </li>
              @else
              <!-- Split button -->
                    <div class="btn-group" style="padding-top: 10px">
                      <button type="button" class="btn btn-primary">Login | Register</button>
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                      </ul>
                    </div>
              @endif
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>