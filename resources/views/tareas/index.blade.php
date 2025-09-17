@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Tareas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tareas.create') }}" class="btn btn-primary mb-3">Nueva Tarea</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->id }}</td>
                    <td>{{ $tarea->nombre_cliente }} {{ $tarea->apellido_cliente }}</td>
                    <td>{{ $tarea->dni_cliente }}</td>
                    <td>{{ $tarea->telefono_cliente }}</td>
                    <td>{{ ucfirst($tarea->estado) }}</td>
                    <td>
                        <a href="{{ route('tareas.edit', $tarea) }}" class="btn btn-sm btn-warning">Editar</a>
                        <!-- Aquí puedes agregar botón de eliminar si lo deseas -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
