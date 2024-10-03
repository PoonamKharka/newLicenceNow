<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@include('admin.layouts.title')</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page" style="background-image: url('{{ asset('images/banner.png') }}')">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Reset Password</b></a>
  </div>

  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="{{ asset('images/icon.svg') }}" alt="Logo"/> &nbsp;&nbsp;
      <a href="#" class="h3">{{ ucwords(str_replace('-', ' ', config('app.name'))) }}</a>
    </div>
    
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
      @endif

      <p class="login-box-msg">{{ __('Reset Password') }}</p>

      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
          <label for="email">{{ __('E-Mail address') }}</label>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">
            {{ __('Send Password Reset Link') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
