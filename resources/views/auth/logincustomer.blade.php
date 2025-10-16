<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="{{ asset('dist/img/FAVICON.png') }}" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Plugin SRL | Cliente</title>

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
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

  <!-- Logo clickeable hacia home, ahora más chico -->
  <a href="{{ url('/') }}" class="top-left-logo">
    <img src="{{ asset('dist/img/flecha.png') }}" alt="Logo Home">
  </a>

  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1">
          <img src="{{ asset('dist/img/lugin.png') }}" alt="Plugin SRL" style="height:100px;max-width:90vw;">
        </a>
      </div>

      <div class="card-body">
        <p class="login-box-msg">Inicia sesión para comenzar</p>

        <form action="{{ route('logincustomer') }}" method="post">
          @csrf

          <!-- Email -->
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <!-- Contraseña con ojito -->
          <div class="input-group mb-3">
            <input id="password" type="password" name="password" class="form-control" placeholder="Contraseña" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span id="togglePassword" class="fas fa-eye" style="cursor:pointer;"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Recuérdame
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </div>
          </div>
        </form>

        <div class="social-auth-links text-center mt-2 mb-3"></div>

        <p class="mb-0">
          <a href="{{ route('register') }}" class="text-center">Registrar nueva cuenta</a>
        </p>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>

  <!-- Script para mostrar/ocultar contraseña -->
  <script>
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
  </script>

</body>
</html>
