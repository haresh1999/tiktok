<header class="main-header">
  <a href="#" class="logo">
    <span class="logo-mini"><b>{{ env('APP_NAME') }}</span>
    <span class="logo-lg">{{env('APP_NAME')}}</span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ getImageUrl(auth()->user()->profile_image)}}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{auth()->user()->name}}</span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="{{ getImageUrl(auth()->user()->profile_image)}}" class="img-circle" alt="User Image">
              <p>
                {{auth()->user()->name}} - Web Developer
                <small>Member since {{dateFormat(auth()->user()->created_at)}}</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="{{ route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>