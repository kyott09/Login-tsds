<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Plug1n | Registro</title>

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
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registrar Usuario</p>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-group mb-3">
          <input id="name" type="text" 
                 class="form-control @error('name') is-invalid @enderror" 
                 name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                 placeholder="Nombre completo">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
          @error('name')
            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="email" type="email" 
                 class="form-control @error('email') is-invalid @enderror" 
                 name="email" value="{{ old('email') }}" required autocomplete="email"
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
                 name="password" required autocomplete="new-password"
                 placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
          @error('password')
            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password-confirm" type="password" 
                 class="form-control" 
                 name="password_confirmation" required autocomplete="new-password"
                 placeholder="Confirmar contraseña">
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>

        <div class="row">
          <!-- Eliminar el checkbox de términos y centrar el botón -->
          <div class="col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary btn-block w-50">Registrar</button>
          </div>
        </div>
      </form>
      <div class="d-flex justify-content-center mt-3">
        <a href="{{ route('login') }}" class="text-center">Ya tengo una cuenta</a>
      </div>
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
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
