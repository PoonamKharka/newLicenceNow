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
<body class="hold-transition login-page" style="background-image: asset('images/banner.png')">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript::void(0)"><b>Reset Password</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="{{ asset('images/icon.svg') }}"/> &nbsp;&nbsp;
      <a href="#" class="h3">{{ ucwords (str_replace('-', ' ', config('app.name'))) , 'License Now' }}</a>
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

      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group row pl-4 pr-4 ">
            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror            
        </div>
        <div class="form-group row pl-4 pr-4 ">
            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>            
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror            
        </div>
        <div class="form-group row pl-4 pr-4 ">
            <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>            
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            
        </div>

        <div class="form-group row mb-0 pl-4 pr-4 ">            
            <button type="submit" class="btn btn-primary">
                {{ __('Reset Password') }}
            </button>            
        </div>
      </form>     
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