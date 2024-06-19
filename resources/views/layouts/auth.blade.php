<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{ config('app.name', 'SMARTC') }}</title>
    <!-- Add favicon -->
    <link rel="icon" href="{{asset('backend/dist/img/logo.ico')}}" type="image/x-icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('backend/dist/css/custom.css')}}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">

</head>
<body class="hold-transition login-page">
    <div class="login-box">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{asset('backend/dist/js/adminlte.js')}}"></script>
</body>
</html>
