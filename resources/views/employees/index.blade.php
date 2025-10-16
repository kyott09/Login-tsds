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
                    <button class="btn btn-info btn-sm verBtn"
                        data-usuario="{{ $e->user ? $e->user->name : '-' }}"
                        data-email="{{ $e->user ? $e->user->email : '-' }}"
                        data-vehicle="{{ $e->vehicle ? $e->vehicle->patente : '-' }}"
                        data-fecha="{{ optional($e->fecha_ingreso)->format('Y-m-d') }}"
                        data-estado="{{ $e->estado_laboral }}">
                        Ver
                    </button>

                    <button class="btn btn-warning btn-sm editBtn"
                        data-id="{{ $e->id }}"
                        data-usuario="{{ $e->user_id }}"
                        data-vehicle="{{ $e->vehicle_id }}"
                        data-fecha="{{ optional($e->fecha_ingreso)->format('Y-m-d') }}"
                        data-estado="{{ $e->estado_laboral }}">
                        Editar
                    </button>

                    <button class="btn btn-danger btn-sm deleteBtn"
                        data-id="{{ $e->id }}"
                        data-usuario="{{ $e->user ? $e->user->name : '-' }}">
                        Eliminar
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $employees->links() }}
</div>

{{-- Modal Ver --}}
<div class="modal fade" id="verModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detalles del Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p><strong>Usuario:</strong> <span id="verUsuario"></span></p>
                <p><strong>Email:</strong> <span id="verEmail"></span></p>
                <p><strong>Vehículo:</strong> <span id="verVehicle"></span></p>
                <p><strong>Fecha Ingreso:</strong> <span id="verFecha"></span></p>
                <p><strong>Estado Laboral:</strong> <span id="verEstado"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Editar --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Editar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Usuario</label>
                        <select name="user_id" id="editUsuario" class="form-control">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Vehículo</label>
                        <select name="vehicle_id" id="editVehicle" class="form-control">
                            @foreach($vehicles as $v)
                                <option value="{{ $v->id }}">{{ $v->patente }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Fecha Ingreso</label>
                        <input type="date" name="fecha_ingreso" id="editFecha" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Estado Laboral</label>
                        <select name="estado_laboral" id="editEstado" class="form-control">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Eliminar --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Eliminar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que deseas eliminar al empleado <strong id="deleteUsuario"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>

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
