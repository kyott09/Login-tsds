<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="{{ asset('dist/img/FAVICON.png') }}" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Plug1n | Registro</title>

  <!-- Estilos personalizados para posicionar y achicar el logo -->
  <style>
    .top-left-logo {
      position: absolute;
      top: 15px;
      left: 15px;
      z-index: 1000;
    }
    .top-left-logo img {
      display: block;
      opacity: .9;
      width: 40px;
      height: auto;
    }
  </style>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">

  <div class="login-box">
    <!-- Logo -->
    <div class="login-logo">
      <div style="display: flex; justify-content: center; align-items: center;">
        <img src="{{ asset('dist/img/plugin logo.png') }}" 
             alt="Logo"
             style="opacity: .9; width: 260px; height: 220px; margin-bottom: -80px; margin-top: -70px;">
      </div>
    </div>

    <!-- Logo clickeable hacia home -->
    <a href="{{ url('/') }}" class="top-left-logo">
      <img src="{{ asset('dist/img/flecha.png') }}" alt="Logo Home">
    </a>

    <!-- Formulario -->
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Registrar Usuario</p>

        <form method="POST" action="{{ route('register') }}">
          @csrf

          <!-- Usuario -->
          <div class="input-group mb-3">
            <input id="user" type="text"
                   class="form-control @error('user') is-invalid @enderror"
                   name="user" value="{{ old('user') }}" required autocomplete="username"
                   placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-user"></span></div>
            </div>
            @error('user')
              <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <!-- Nombre -->
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

          <!-- Email -->
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

          <!-- Contraseña -->
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

          <!-- Confirmar contraseña -->
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

  <!-- Scripts -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

</body>
</html>
