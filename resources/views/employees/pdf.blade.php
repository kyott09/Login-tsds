<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de Empleados</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Listado de Empleados</h2>
    @if(isset($employees) && count($employees) > 0)
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Vehículo</th>
                <th>Fecha Ingreso</th>
                <th>Estado Laboral</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>
                    @if($employee->user)
                        {{ $employee->user->name }} ({{ $employee->user->email }})
                    @else
                        <em>Sin usuario</em>
                    @endif
                </td>
                <td>
                    @if($employee->vehicle)
                        {{ $employee->vehicle->patente }}
                    @else
                        <em>Sin vehículo</em>
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($employee->fecha_ingreso)->format('d/m/Y') }}</td>
                <td>{{ ucfirst($employee->estado_laboral) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>No se encontraron empleados.</p>
    @endif
</body>
</html>
