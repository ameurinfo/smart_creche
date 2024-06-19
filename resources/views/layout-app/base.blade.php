<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>تسيير الحضانة</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="{{asset('backend/dist/img/logo.ico')}}" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('backend/dist/css/custom.css')}}">
  @yield('head')
</head>
<body class="hold-transition sidebar-mini layout-fixed noto-naskh-arabic-body-font">
<div class="wrapper">
  @include('layout-app.navbar')
  @include('layout-app.sidebar')
  <div class="content-wrapper">
    <div class="content">
      @yield('content')
    </div>
  </div>
  </div>
 @include('layout-app.footer')
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
<script src="{{asset('backend/dist/js/adminlte.js')}}"></script>
@yield('footer')
</body>
</html>
