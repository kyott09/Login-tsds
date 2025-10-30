<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Tareas</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            color: #333;
            margin: 25px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .subtitulo {
            font-size: 13px;
            color: #666;
        }

        .info-filtros {
            margin: 10px 0 20px 0;
            font-size: 12px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f8f8f8;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #eaeaea;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            font-size: 11px;
            color: #666;
            text-align: right;
            border-top: 1px solid #ccc;
            padding-top: 4px;
        }

        .total {
            text-align: right;
            font-weight: bold;
            background-color: #eaeaea;
        }
    </style>
</head>
<body>
    <header>
        <h1>Listado de Tareas</h1>
        <p class="subtitulo">Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </header>

    {{-- Filtros aplicados --}}
    @if(request()->hasAny(['cliente', 'servicio', 'prioridad']))
        <div class="info-filtros">
            <strong>Filtros aplicados:</strong>
            <ul style="margin: 5px 0 0 15px;">
                @if(request('cliente'))
                    <li><strong>Cliente:</strong> {{ request('cliente') }}</li>
                @endif
                @if(request('servicio'))
                    <li><strong>Servicio:</strong> {{ request('servicio') }}</li>
                @endif
                @if(request('prioridad'))
                    <li><strong>Prioridad:</strong> {{ request('prioridad') }}</li>
                @endif
            </ul>
        </div>
    @endif

    {{-- Tabla principal --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Prioridad</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareas as $tarea)
            <tr>
                <td>{{ $tarea->id }}</td>
                <td>{{ $tarea->nombre ?? '-' }}</td>
                <td>{{ $tarea->servicio ?? '-' }}</td>
                <td>{{ ucfirst($tarea->prioridad) ?? '-' }}</td>
                <td>{{ $tarea->created_at ? $tarea->created_at->format('d/m/Y H:i') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;">No se encontraron tareas para los filtros seleccionados.</td>
            </tr>
            @endforelse
        </tbody>

        @if($tareas->count() > 0)
        <tfoot>
            <tr>
                <td colspan="4" class="total">Total de tareas:</td>
                <td class="total">{{ $tareas->count() }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <footer>
        Informe generado automáticamente — {{ config('app.name', 'Sistema de Tareas') }}
    </footer>
</body>
</html>
