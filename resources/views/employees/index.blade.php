@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Empleados</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Crear Empleado</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Tipo</th>
                <th>Vehículo</th>
                <th>Ingreso</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($employees as $e)
            <tr>
                <td>{{ $e->id }}</td>
                <td>{{ $e->user ? $e->user->name : '-' }}</td>
                <td>{{ $e->typeEmployee ? $e->typeEmployee->descripcion : '-' }}</td>
                <td>{{ $e->vehicle ? $e->vehicle->patente : '-' }}</td>
                <td>{{ optional($e->fecha_ingreso)->format('Y-m-d') }}</td>
                <td>{{ $e->estado_laboral }}</td>
                <td>
                    <a href="{{ route('employees.show', $e) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('employees.edit', $e) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('employees.destroy', $e) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Eliminar este empleado?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $employees->links() }}
</div>
@endsection
