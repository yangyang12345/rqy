<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('global.title') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/font-awesome/css/font-awesome.min.css")}}">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/Ionicons/css/ionicons.min.css")}}">
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="dist/css/AdminLTE.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}">

    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/iCheck/square/blue.css")}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    @if(!empty(session('success')))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
        <?php session()->forget('success');?>
    @endif
    <div class="login-logo">
        <a href=""><b>启拉</b>云️</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">商家登录</p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group has-feedback">
                    <input id="tel" type="tel" placeholder="请输入手机" class="form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}" name="tel" value="{{ old('tel') }}" required autofocus>
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    @if ($errors->has('tel'))
                        <p class="text-danger text-left">
                            <strong>{{ $errors->first('tel') }}</strong>
                        </p>
                    @endif
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" placeholder="请输入密码" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <p class="text-danger text-leftr">
                        <strong>{{ $errors->first('password') }}</strong>
                    </p>
                @endif
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" style="width: 217px;display: inline-block;" class="form-control {{$errors->has('captcha')?'parsley-error':''}}" name="captcha" placeholder="请输入验证码">
                <img src="{{captcha_src()}}" style="cursor: pointer;margin-top: -3px" onclick="this.src='{{captcha_src()}}'+Math.random()">

                @if ($errors->has('captcha'))
                    <p class="text-danger text-left">
                        <strong>{{$errors->first('captcha')}}</strong>
                    </p>
                @endif

            </div>
            <div class="row">
                <div class="col-xs-8"></div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div>
            </div>
        </form>
        <a href="{{ route('register') }}" class="text-center">注册账号</a>
    </div>
</div>

<!-- jQuery 3 -->
<script src="{{ asset("/bower_components/jquery/dist/jquery.min.js")}}"></script>

<!-- Bootstrap 3.3.7 -->
<script src="{{ asset("/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>

<script src="{{ asset("/bower_components/admin-lte/plugins/iCheck/icheck.min.js")}}"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
</body>
</html>
