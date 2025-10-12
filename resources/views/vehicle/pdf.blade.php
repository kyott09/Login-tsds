<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Vehículos</title>
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
        <h1>Listado de Vehículos</h1>
        <p class="subtitulo">Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </header>

    {{-- Filtros aplicados --}}
    @if(request('desde') || request('hasta') || request('modelo_id'))
        <div class="info-filtros">
            <strong>Filtros aplicados:</strong>
            <ul style="margin: 5px 0 0 15px;">
                @if(request('desde'))
                    <li><strong>Desde:</strong> {{ \Carbon\Carbon::parse(request('desde'))->format('d/m/Y') }}</li>
                @endif
                @if(request('hasta'))
                    <li><strong>Hasta:</strong> {{ \Carbon\Carbon::parse(request('hasta'))->format('d/m/Y') }}</li>
                @endif
                @if(request('modelo_id'))
                    <li><strong>Modelo:</strong>
                        {{ optional($vehiculos->firstWhere('modelo_id', request('modelo_id'))?->modelo)->descripcion ?? 'N/A' }}
                    </li>
                @endif
            </ul>
        </div>
    @endif

    {{-- Tabla principal --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Patente</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Estado</th>
                <th>Fecha de Registro</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehiculos as $index => $vehiculo)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $vehiculo->patente }}</td>
                    <td>{{ $vehiculo->modelo->brand->descripcion ?? 'Sin marca' }}</td>
                    <td>{{ $vehiculo->modelo->descripcion ?? 'Sin modelo' }}</td>
                    <td>{{ $vehiculo->color ?? '-' }}</td>
                    <td>{{ ucfirst($vehiculo->estado) ?? '-' }}</td>
                    <td>{{ $vehiculo->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">No se encontraron vehículos para los filtros seleccionados.</td>
                </tr>
            @endforelse
        </tbody>

        @if($vehiculos->count() > 0)
        <tfoot>
            <tr>
                <td colspan="6" class="total">Total de vehículos:</td>
                <td class="total">{{ $vehiculos->count() }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <footer>
        Informe generado automáticamente — {{ config('app.name', 'Sistema de Vehículos') }}
    </footer>
</body>
</html>
