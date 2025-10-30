<!DOCTYPE html>
<html lang="en">
<head>
  @stack('styles')

  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="{{ asset('dist/img/FAVICON.png') }}" /> 
  <title>Plugin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">

<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('dist/img/pluginbordenegro.png')}}" alt="logoplugin" height="200" width="140">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- Eliminar el botón Home del navbar -->
      <!--
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">Home</a>
      </li>
      -->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://www.canva.com/design/DAG1_f59X08/hPruPsav-8wcMWSKifN2-w/edit?utm_content=DAG1_f59X08&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton" class="nav-link" target="_blank">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item d-flex align-items-center">

        <!-- Miniatura de usuario -->
        <div class="dropdown" title="{{ Auth::user()->email }}">
          <a href="#" class="nav-link p-0 ml-2" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display:flex;align-items:center;">
            <img src="{{ auth()->user()->profile_image ? asset('img/users_profile/' . auth()->user()->profile_image) : asset('dist/img/USUARIO.png') }}" 
                class="img-circle elevation-2" 
                alt="User Image" 
                style="width:32px; height:32px; object-fit:cover;">
            <span class="ml-2">{{ Auth::user()->name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a href="{{ route('user.profile') }}" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Perfil
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item"
              onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();">
              <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
            </a>
            <form id="logout-form-navbar" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </div>

      </li>


      <!-- Notifications Dropdown Menu -->

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{asset('dist/img/LOGO-FONDOBLANCO-BORDE-NEGRO.png')}}" alt="Plugin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Plugin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ auth()->user()->profile_image ? asset('img/users_profile/' . auth()->user()->profile_image) : asset('dist/img/USUARIO.png') }}" 
            class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('user.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>


      <!-- SidebarSearch Form -->

    @can ('ver user')
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-signature"></i>
              <p>
                @role('admin')
                  Registrar
                @else('empleado')
                  Ver
                @endrole
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              @can('solicitar tarea')
              <li class="nav-item">
                <a href="{{ route('tareas.solicitar') }}" class="nav-link">
                  <i class="nav-icon fas fa-tty"></i>
                  <p>Solicitar Tarea</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ route('tareas.mis_tareas') }}" class="nav-link">
                  <i class="nav-icon fas fa-inbox"></i>
                  <p>Mis solicitudes</p>
                </a>
              </li>
              @endcan
              @can('ver vehiculos')
                <li class="nav-item">
                  <a href="{{ route('vehiculos.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-car"></i>
                    <p>Vehículo</p>
                  </a>
                </li>
              @endcan



              @can('ver empleado')
              <li class="nav-item">
                <a href="{{ route('employees.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Empleado</p>
                </a>
              </li>
              @endcan

              @can ('ver tarea')
              <li class="nav-item">
                <a href="{{ route('tareas.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>Tarea</p>
                </a>
              </li>
              @endcan
              @can ('modificar roles')
              <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-lock"></i>
                  <p>Roles</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

          @can('ver nadie')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>
                Asignar
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-handshake nav-icon"></i>
                  <p>Grupo de Trabajo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-clipboard nav-icon"></i>
                  <p>Tarea</p>
                </a>  
              </li>
            </ul>   
          </li>
          @endcan

          <li class="nav-header">OTROS</li>
          <li class="nav-item">
            <a href="{{ route('calendar')}}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendario
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('gallery.index')}}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Galería de Fotos
              </p>
            </a>
          </li>
          
          
          <li class="nav-header">Informacion General</li>
          
          <li class="nav-item">
            <a href="https://docs.google.com/document/d/1JC98Rt9nGGjNZfoviXGIm7WS6m19Nmp3SRO_4PRLAXc/edit?usp=sharing" class="nav-link" target="_blank">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentación</p>
            </a>
          </li>
          </li>
          </li>
        </ul>
      </nav>
    @endcan
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> 
          


         
                  @yield('content')	

     
      
      </div>
      </section>
       <!-- /.content-wrapper -->









    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>



@stack('scripts')




</body>
</html>