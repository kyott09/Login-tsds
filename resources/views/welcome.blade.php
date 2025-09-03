<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plugin SRL</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
        .center { min-height:100vh; display:flex; flex-direction:column; justify-content:center; align-items:center; }
        .logo { height:220px; max-width:90vw; display:block; margin-bottom:10px; }
        .links { margin-top:54px; display:flex; gap:32px; }
        a { font-size:1.25rem; color:#fff; text-decoration:underline; }
        .links a { color:#000 !important; }
    </style>
</head>
<body class="login-page">
    <div class="center">
        <img src="{{ asset('dist/img/LOGOGRANDE.png') }}" alt="Plugin SRL company logo featuring stylized text Plugin SRL in bold modern font, set against a clean background that conveys professionalism and innovation, with a welcoming and optimistic tone" class="logo" style="height:185px;">
        <div class="card" style="max-width:1500px; width:100%; margin-bottom:32px;">
            <div class="card-body">
                <h3 class="text-center mb-3 font-weight-bold">Bienvenidos a Plugin</h3>
                <p class="text-center mb-2" style="font-size:1.1rem;">Conectando el futuro, optimizando el presente</p>
            </div>
        </div>
        <div style="display:flex; gap:24px; justify-content:center; margin-bottom:32px;">
            <a href="{{ route('login') }}" class="btn btn-warning btn-lg">
                <button class="btn btn-warning btn-lg">
                <i class="fas fa-user-tie">
            <span style="font-family: 'Courier New', monospace;">Sección Empleados</span>
            </i>
                </button>
            </a>
              <a href="{{ route('logincustomer') }}" class="btn btn-primary btn-lg">
    <button class="btn btn-primary btn-lg">
        <i class="fas fa-user">
            <span style="font-family: 'Courier New', monospace;">Sección Clientes</span>
        </i>
    </button>
</a>

            </div>
        @if (Route::has('login'))
            <div class="links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    @if (Route::has('register'))
                        {{-- <a href="{{ route('register') }}">Registrar</a> --}}
                    @endif
                @endauth
            </div>
        @endif
    </div>
    <!-- AdminLTE JS -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
</html>
