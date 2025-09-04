<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Plug1n | Log in</title>

  <!-- Estilos personalizados para posicionar y achicar el logo -->
  <style>
    .top-left-logo {
      position: absolute;
      top: 15px;
      left: 15px;
      z-index: 1000;
    }
    /* Logo reducido a 40px de ancho */
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
<body class="hold-transition login-page">

  <!-- Logo clickeable hacia home, ahora más chico -->
  <a href="{{ url('/') }}" class="top-left-logo">
    <img src="{{ asset('dist/img/flecha.png') }}" alt="Logo Home">
  </a>

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
            <input id="user" type="text" 
                 class="form-control @error('user') is-invalid @enderror" 
                 name="user" value="{{ old('user') }}" required autocomplete="username" autofocus
                 placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text"><span class="fas fa-user"></span></div>
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

        <div class="mt-4 d-flex justify-content-center">
          <div>
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="mx-2">Olvidé Mi Contraseña</a>
            @endif
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="mx-2">Registrarse</a>
            @endif
          </div>
        </div>
      </div>
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
