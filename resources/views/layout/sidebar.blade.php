@php $name = Route::currentRouteName() @endphp
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ auth()->user()->profile_image }}" alt="User Image" style="border-radius: 50%;height:43px">
      </div>
      <div class="pull-left info">
        <p>{{auth()->user()->name}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    {{-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form> --}}

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{ $name == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
      </li>
      <li class="{{ in_array($name,['category','category.create','category.edit']) ? 'active' : '' }}">
        <a href="{{ route('category')}}"><i class="fa fa-sitemap"></i> <span>Category</span></a>
      </li>
      <li class="{{ in_array($name,['post','post.create','post.edit']) ? 'active' : '' }}">
        <a href="{{ route('post')}}"><i class="fa fa-clipboard"></i> <span>Post</span></a>
      </li>
    </ul>
  </section>
</aside>