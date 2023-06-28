<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ env('APP_NAME') }} | @yield('title') </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
  @include('layout.css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
  <div class="wrapper">
    
    @include('layout.header')
    
    @include('layout.sidebar')
    <!-- Content Wrapper -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    
    @include('layout.footer')
    
  </div>

  @include('layout.script')
</body>
</html>
