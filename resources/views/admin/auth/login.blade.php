<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> @include('admin.layouts.title') </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('adminlte/plugins/fontawesome-free/css/all.min.css')  }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')   }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page" style="background-image: url('{{ asset('images/banner.png') }}')">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript::void(0)"><b>Admin Login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="{{ asset('images/icon.svg') }}"/> &nbsp;&nbsp;
      <a href="#" class="h3">{{ ucwords (str_replace('-', ' ', config('app.name'))) , 'License Now' }}</a>
    </div>
    <div class="card-body">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="{{  route('login') }}" method="POST" id="login-form">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Enter Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="******">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @session('error')
          <span class="text-danger">{{ $value }}</span>
        @endsession
        {{-- @if($errors->any())
          <span class="text-danger">{{ error }}</span>
        @endif --}}
        <div class="row">
          {{-- <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div> --}}
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
        </div>
      </form>

      <p class="mb-1" style="margin-left: 20px;padding-bottom: 10px;">
        <a href="{{ route('password.forgot') }}">Forgot Password ?</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset( 'adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset( 'adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')  }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js')  }}"></script>
</body>
</html>