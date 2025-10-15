@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Empleados</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <div class="btn-group" role="group" aria-label="Acciones">
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Crear Empleado</a>
            <a href="{{ route('employees.busqueda') }}" class="btn btn-secondary">Buscar Empleados</a>
            <a href="{{ route('employees.pdf') }}" class="btn btn-danger">Exportar PDF</a>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
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
                <td>
                    @if($e->user)
                        {{ $e->user->id }} - {{ $e->user->name }} ({{ $e->user->email }})
                    @else
                        -
                    @endif
                </td>
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
