<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de Tareas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Listado de Tareas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
            <tr>
                <td>{{ $tarea->id }}</td>
                <td>{{ $tarea->nombre }}</td>
                <td>{{ $tarea->descripcion }}</td>
                <td>{{ $tarea->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
