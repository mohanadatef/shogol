<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<title>{{$setting['name'] ?? null}} | @yield('title')</title>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="{{asset('public/AdminLTE/fonts.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset('public/AdminLTE/ionicons.css')}}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
      href="{{asset('public/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/jqvmap/jqvmap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('public/AdminLTE/dist/css/adminlte.min.css')}}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/daterangepicker/daterangepicker.css')}}">
<!-- summernote -->
<link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/summernote/summernote-bs4.min.css')}}">

<link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/summernote/summernote-bs4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/select2/css/select2.min.css')}}">
@yield('head')

