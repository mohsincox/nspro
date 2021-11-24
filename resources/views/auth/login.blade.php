<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nestle</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('assets/css/blue.css') }}"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- <body class="hold-transition login-page" style="background-image: url({{ asset('assets/images/login.jpg') }}); background-repeat: no-repeat;"> -->
<body class="hold-transition login-page" style="background-image: url({{ asset('assets/image/nestle-login-bg.jpg') }}); background-repeat: no-repeat; background-size: cover;">
   <!-- <div class="container">
    <div class="pull-left">
      <a href="#"><img src="{{ asset('assets/images/myol8171.png') }}" ></a>
    </div>
    <div class="pull-right">
      <h1>Need Help:<span style="color: red;"><i class="fa fa-phone"></i> 01706392777</span></h1>
    </div>
    
  </div> -->
<div class="login-box" style="margin: 2% auto; width: 421px;">
  <!-- <div class="login-logo">
    <a href="#"><b>MYOL</b>Attendance</a>
    <a href="#"><img src="{{ asset('assets/images/myol8171.png') }}" ></a>
  </div> -->
  <div class="login-logo">
    <a href="#"><b>Nestle</b> Database Managenent</a>
    <!-- <a href="#"><img src="{{ asset('assets/images/myol8171.png') }}" ></a> -->
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ url('/login') }}" method="post">
      {{ csrf_field() }}
      <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
        @endif
      </div>

      <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
          <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif
      </div>

      <div class="row">
        <div class="col-sm-8">
          <div class="checkbox icheck" style="margin-left: 20px;">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <div class="col-sm-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          <!-- <a href="{{ url('/registration') }}" class="btn btn-danger btn-flat">Registration</a> -->
        </div>
      </div>
      
    </form>

  </div>
</div>
<!-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script> -->
</body>
</html>
