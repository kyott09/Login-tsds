<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="{{ asset('dist/img/FAVICON.png') }}" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Plugin SRL | Registro de Cliente</title>
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
<body class="hold-transition register-page">

  <!-- Logo clickeable hacia home, ahora más chico -->
  <a href="{{ url('/') }}" class="top-left-logo">
    <img src="{{ asset('dist/img/flecha.png') }}" alt="Logo Home">
  </a>

<div class="register-box">
      <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1">
        <img src="{{ asset('dist/img/lugin.png') }}" alt="Plugin SRL" style="height:100px;max-width:90vw;">
      </a>
    </div>

    <div class="card-body">
      <p class="login-box-msg">Registrar nuevo cliente</p>

      <form action="{{ route('registercustomer.submit') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Nombre completo" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="dni" class="form-control" placeholder="DNI" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="telefono" class="form-control" placeholder="Teléfono" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Reingrese la contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
          </div>
        </div>
      </form>
      <a href="{{ route('logincustomer') }}" class="text-center mt-3">Ya tengo una cuenta</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
