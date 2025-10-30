<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Vehículos</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 30px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 6px;
            margin-bottom: 10px;
        }

        .header-info {
            text-align: right;
            font-size: 11px;
            color: #666;
        }

        .info-filtros {
            margin: 15px 0 25px 0;
            font-size: 12px;
            border: 1px solid #ccc;
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .info-filtros strong {
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #444;
            padding: 8px 6px;
            text-align: left;
        }

        th {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        .total {
            text-align: right;
            font-weight: bold;
            background-color: #eaeaea;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #999;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            color: #777;
            margin-top: 30px;
            border-top: 1px solid #aaa;
            padding-top: 8px;
        }
    </style>
</head>
<body>
    <div class="header-info">
        Fecha de generación: {{ now()->format('d/m/Y H:i') }}
    </div>

    <h2>Listado de Vehículos</h2>

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
    @if($vehiculos->count() > 0)
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
                @foreach($vehiculos as $index => $vehiculo)
                    <tr>
                        <td style="text-align:center;">{{ $index + 1 }}</td>
                        <td style="text-align:center;">{{ $vehiculo->patente }}</td>
                        <td>{{ $vehiculo->modelo->brand->descripcion ?? 'Sin marca' }}</td>
                        <td>{{ $vehiculo->modelo->descripcion ?? 'Sin modelo' }}</td>
                        <td style="text-align:center;">{{ $vehiculo->color ?? '-' }}</td>
                        <td style="text-align:center;">{{ ucfirst($vehiculo->estado) ?? '-' }}</td>
                        <td style="text-align:center;">{{ $vehiculo->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="total">Total de vehículos:</td>
                    <td class="total">{{ $vehiculos->count() }}</td>
                </tr>
            </tfoot>
        </table>
    @else
        <p class="no-data">No se encontraron vehículos para los filtros seleccionados.</p>
    @endif

    <div class="footer">
        Plugin SRL — Sistema de Gestión de Vehículos | © {{ date('Y') }}
    </div>
</body>
</html>
