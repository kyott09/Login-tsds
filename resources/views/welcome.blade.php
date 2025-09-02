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
        .logo { height:320px; max-width:90vw; display:block; margin-bottom:10px; }
        .links { margin-top:54px; display:flex; gap:32px; }
        a { font-size:1.25rem; color:#fff; text-decoration:underline; }
        .links a { color:#000 !important; }
    </style>
</head>
<body class="login-page">
    <div class="center">
        <img src="{{ asset('dist/img/plugin logo.png') }}" alt="Logo de Plugin SRL" class="logo">
        <div class="card" style="max-width:1500px; width:100%; margin-bottom:32px;">
            <div class="card-body">
                <h3 class="text-center mb-3 font-weight-bold">Bienvenidos a Plugin</h3>
                <p class="text-center mb-2" style="font-size:1.1rem;">Conectando el futuro, optimizando el presente</p>
                <p style="text-align:justify;">
                    En Plugin ofrecemos servicios de internet por cable para hogares y empresas, con un compromiso firme hacia la eficiencia, la calidad y la innovación. Nuestra empresa está dando un paso adelante en la transformación digital: dejamos atrás la gestión en papel para implementar un sistema inteligente e integral que mejora cada etapa de nuestro trabajo.
                </p>
                <p style="text-align:justify;">
                    Ahora, cada pedido se gestiona online, desde que lo solicitás hasta que se completa. Planificamos tareas según las habilidades de nuestros técnicos, organizamos equipos dinámicos de trabajo, controlamos en tiempo real el stock de materiales y el estado de nuestros vehículos. Todo esto, centralizado en una plataforma que nos permite actuar rápido, con precisión y trazabilidad.
                </p>
                <p style="text-align:justify;">
                    Nuestro nuevo sistema nos permite ofrecer un servicio más ágil, seguro y transparente, con reportes detallados, comunicación interna efectiva y atención prioritaria para clientes críticos. Así, cada decisión se basa en datos, cada acción es más eficiente, y cada cliente recibe un mejor servicio.
                </p>
                <p style="text-align:justify;">
                    Plugin evoluciona para brindarte una experiencia de conectividad más confiable, organizada y profesional.
                </p>
            </div>
        </div>
        @if (Route::has('login'))
            <div class="links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Iniciar Sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registrar</a>
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
