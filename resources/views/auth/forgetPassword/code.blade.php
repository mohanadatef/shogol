<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$setting[strtolower('name')]??""}} | {{$custom[strtolower('recover_password')]??""}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('public/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/AdminLTE/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <img src="{{getLogoSetting()}}" style="width:100px;height: 100px">
        <a {{--href="../../index2.html"--}}><b>{{$setting[strtolower('name')]??""}}</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{$custom[strtolower('message_recover_password')]??""}}</p>
            @include('errors.error')
            <form action="{{route('forget_password.cheek_code')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           value="{{ Request::old('email') }}" name="email"
                           placeholder="{{$custom[strtolower('email')]??""}}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                           value="{{ Request::old('code') }}" name="code"
                           placeholder="{{$custom[strtolower('code')]??""}}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           value="{{ Request::old('password') }}" name="password"
                           placeholder="{{$custom[strtolower('password')]??""}}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                           value="{{ Request::old('password_confirmation') }}" name="password_confirmation"
                           placeholder="{{$custom[strtolower('confirm_password')]??""}}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Change password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1">
                        <a href="{{route("login")}}">{{$custom[strtolower('login_button')]??""}}</a>
                    </p>
                </div>
                <div class="col-md-6">
                    @if($languageActive)
                        <div class="pull-right" style="float:right">
                            <form method="post" action="{{route('setLang')}}">
                                @csrf
                                <div class="form-group">
                                    <select name='lang' onchange="this.form.submit();">
                                        @foreach($languageActive as $lang)
                                            <option value='{{$lang->code}}'
                                                    @if( languageLocale() == $lang->code )selected @endif >{{$lang->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- /.login-card-body -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('public/AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/AdminLTE/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
