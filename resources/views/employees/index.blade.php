@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Empleados</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @can('ABM_EMPLEADOS')
    <div class="mb-3">
        <div class="btn-group" role="group" aria-label="Acciones">
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Crear Empleado</a>
            <a href="{{ route('employees.busqueda') }}" class="btn btn-secondary">Buscar Empleados</a>
            <a href="{{ route('employees.pdf') }}" class="btn btn-danger">Exportar PDF</a>
        </div>
    </div>
    @endcan
    <table class="table table-bordered" id="tablaEmpleados">
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
                <td>{{ $e->user ? $e->user->id . ' - ' . $e->user->name . ' (' . $e->user->email . ')' : '-' }}</td>
                <td>{{ $e->vehicle ? $e->vehicle->patente : '-' }}</td>
                <td>{{ optional($e->fecha_ingreso)->format('Y-m-d') }}</td>
                <td>{{ $e->estado_laboral }}</td>
                <td>
                    @can('ver empleado')
                    <button class="btn btn-info btn-sm verBtn"
                        data-usuario="{{ $e->user ? $e->user->name : '-' }}"
                        data-email="{{ $e->user ? $e->user->email : '-' }}"
                        data-vehicle="{{ $e->vehicle ? $e->vehicle->patente : '-' }}"
                        data-fecha="{{ optional($e->fecha_ingreso)->format('Y-m-d') }}"
                        data-estado="{{ $e->estado_laboral }}">
                        Ver
                    </button>
                    @endcan
                    @can('editar empleado')
                    <button class="btn btn-warning btn-sm editBtn"
                        data-id="{{ $e->id }}"
                        data-usuario="{{ $e->user_id }}"
                        data-vehicle="{{ $e->vehicle_id }}"
                        data-fecha="{{ optional($e->fecha_ingreso)->format('Y-m-d') }}"
                        data-estado="{{ $e->estado_laboral }}">
                        Editar
                    </button>
                    @endcan
                    @can('borrar empleado')
                    <button class="btn btn-danger btn-sm deleteBtn"
                        data-id="{{ $e->id }}"
                        data-usuario="{{ $e->user ? $e->user->name : '-' }}">
                        Eliminar
                    </button>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $employees->links() }}
</div>

@include('employees.modals')

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Modal Ver
    $('.verBtn').on('click', function() {
        $('#verUsuario').text($(this).data('usuario'));
        $('#verEmail').text($(this).data('email'));
        $('#verVehicle').text($(this).data('vehicle'));
        $('#verFecha').text($(this).data('fecha'));
        $('#verEstado').text($(this).data('estado'));
        $('#verModal').modal('show');
    });

    // Modal Editar
    $('.editBtn').on('click', function() {
        let id = $(this).data('id');
        $('#editForm').attr('action', '/employees/' + id);
        $('#editUsuario').val($(this).data('usuario'));
        $('#editVehicle').val($(this).data('vehicle'));
        $('#editFecha').val($(this).data('fecha'));
        $('#editEstado').val($(this).data('estado'));
        $('#editModal').modal('show');
    });

    // Modal Eliminar
    $('.deleteBtn').on('click', function() {
        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        $('#deleteUsuario').text(usuario);
        $('#deleteForm').attr('action', '/employees/' + id);
        $('#deleteModal').modal('show');
    });
});
</script>
@endpush
