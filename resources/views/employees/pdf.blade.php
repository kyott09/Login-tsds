<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Listado de Empleados</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            margin: 30px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 6px;
        }

        .header-info {
            text-align: right;
            font-size: 11px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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

    <h2>Listado de Empleados</h2>

    @if(isset($employees) && count($employees) > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Empleado</th>
                    <th>Vehículo</th>
                    <th>Fecha Ingreso</th>
                    <th>Estado Laboral</th>
                    <th>Skills</th>
                    <th>Inicio Licencia</th>
                    <th>Fin Licencia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td style="text-align:center;">{{ $employee->id }}</td>
                        <td>
                            @if($employee->user)
                                <strong>{{ $employee->user->name }}</strong><br>
                                <small>{{ $employee->user->email }}</small>
                            @else
                                <em>Sin usuario</em>
                            @endif
                        </td>
                        <td style="text-align:center;">
                            {{ $employee->vehicle ? $employee->vehicle->patente : '—' }}
                        </td>
                        <td style="text-align:center;">
                            {{ optional($employee->fecha_ingreso)->format('d/m/Y') ?: '—' }}
                        </td>
                        <td style="text-align:center;">
                            {{ ucfirst($employee->estado_laboral) ?: '—' }}
                        </td>
                        <td style="text-align:center;">
                            {{ $employee->skills ?: 'N/A' }}
                        </td>
                        <td style="text-align:center;">
                            {{ optional($employee->fecha_inicio_licencia)->format('d/m/Y') ?: '—' }}
                        </td>
                        <td style="text-align:center;">
                            {{ optional($employee->fecha_fin_licencia)->format('d/m/Y') ?: '—' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-data">No se encontraron empleados.</p>
    @endif

    <div class="footer">
        Plugin SRL — Sistema de Gestión de Empleados | © {{ date('Y') }}
    </div>
</body>
</html>
