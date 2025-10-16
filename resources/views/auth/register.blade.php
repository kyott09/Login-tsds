<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="{{ asset('dist/img/FAVICON.png') }}" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Plug1n | Registro</title>

  <!-- Estilos personalizados -->
  <style>
    body {
      background-color: #edf0f3;
    }

    /* Flecha arriba a la izquierda */
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

    /* Contenedor principal */
    .login-box {
      width: 400px;
      margin: 0 auto;
    }

    /* Ajuste del logo central */
    .login-logo {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: -30px;
      margin-top: -20px;
    }

    .login-logo img {
      width: 180px;
      height: auto;
      opacity: 0.95;
      object-fit: contain;
    }

    /* Tarjeta del formulario */
    .card {
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    /* Botón registrar */
    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3;
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

  <!-- Flecha a Home -->
  <a href="{{ url('/') }}" class="top-left-logo">
    <img src="{{ asset('dist/img/flecha.png') }}" alt="Logo Home">
  </a>

  <div class="login-box">

    <!-- Logo central -->
    <div class="login-logo">
      <img src="{{ asset('dist/img/lugin.png') }}" alt="Logo">
    </div>

    <!-- Formulario -->
    <div class="card">
      <div class="card-body register-card-body">

        <form method="POST" action="{{ route('register') }}">
          @csrf

          <!-- Usuario -->
          <div class="input-group mb-3">
            <input id="user" type="text" class="form-control @error('user') is-invalid @enderror"
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
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" required autocomplete="name"
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
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
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
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password"
                   placeholder="Contraseña">
            <div class="input-group-append">
              <div class="input-group-text">
                <span id="togglePassword" class="fas fa-eye" style="cursor:pointer;"></span>
              </div>
            </div>
            @error('password')
              <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <!-- Confirmar contraseña -->
          <div class="input-group mb-3">
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation" required autocomplete="new-password"
                   placeholder="Confirmar contraseña">
            <div class="input-group-append">
              <div class="input-group-text">
                <span id="togglePasswordConfirm" class="fas fa-eye" style="cursor:pointer;"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 d-flex justify-content-center">
              <button type="submit" class="btn btn-primary btn-block w-50">Registrarme</button>
            </div>
          </div>
        </form>

        <div class="d-flex justify-content-center mt-3">
          <a href="{{ route('logincustomer') }}" class="text-center">Ya tengo una cuenta</a>
        </div>

      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

  <!-- Script para mostrar/ocultar contraseñas -->
  <script>
    // Mostrar/ocultar contraseña principal
    document.getElementById('togglePassword').addEventListener('click', function () {
      const passwordInput = document.getElementById('password');
      const icon = this;
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });

    // Mostrar/ocultar confirmación de contraseña
    document.getElementById('togglePasswordConfirm').addEventListener('click', function () {
      const passwordConfirmInput = document.getElementById('password-confirm');
      const icon = this;
      if (passwordConfirmInput.type === 'password') {
        passwordConfirmInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        passwordConfirmInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });
  </script>

</body>
</html>
