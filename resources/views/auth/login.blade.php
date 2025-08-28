<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Plug1n | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <div style="display: flex; justify-content: center; align-items: center;">
      <img src="{{ asset('dist/img/plugin logo.png') }}" 
           alt="Logo"
           style="opacity: .9; width: 260px; height: 220px; margin-bottom: -60px; margin-top: -80px;">
    </div>
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia sesión para comenzar</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
          <input id="email" type="email" 
                 class="form-control @error('email') is-invalid @enderror" 
                 name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                 placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
          </div>
          @error('email')
            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password" type="password" 
                 class="form-control @error('password') is-invalid @enderror" 
                 name="password" required autocomplete="current-password"
                 placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
          @error('password')
            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">Recordar Contraseña</label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- O -</p>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Inicia utilizando Google+
        </a>
      </div>

      <p class="mb-1">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}">Olvidé Mi Contraseña</a>
        @endif
      </p>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
