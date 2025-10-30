@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Buscar Empleados</h1>

    <form action="{{ route('employees.busqueda') }}" method="GET" class="mb-4">
        {{-- Podés agregar filtros adicionales si querés --}}
    </form>

    @if(isset($employees) && $employees->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="tablaEmployees">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Vehículo</th>
                    <th>Fecha Ingreso</th>
                    <th>Estado Laboral</th>
                    <th>Skills</th>
                    <th>Inicio Licencia</th>
                    <th>Fin Licencia</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar ID"></th>
                    <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Usuario"></th>
                    <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Vehículo"></th>
                    <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Fecha"></th>
                    <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Estado"></th>
                    <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Skills"></th>
                    <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Inicio"></th>
                    <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Fin"></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td style="white-space: normal;">
                        {{ $employee->user ? $employee->user->name . ' (' . $employee->user->email . ')' : '-' }}
                    </td>
                    <td style="white-space: normal;">{{ $employee->vehicle ? $employee->vehicle->patente : '-' }}</td>
                    <td>{{ optional($employee->fecha_ingreso)->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($employee->estado_laboral) }}</td>
                    <td>{{ $employee->skills ?: 'N/A' }}</td>
                    <td>{{ optional($employee->fecha_inicio_licencia)->format('d/m/Y') ?: '-' }}</td>
                    <td>{{ optional($employee->fecha_fin_licencia)->format('d/m/Y') ?: '-' }}</td>
                    <td>
                        <div class="d-flex flex-column flex-md-row gap-1">
                            <button class="btn btn-info btn-sm verBtn"
                                data-usuario="{{ $employee->user ? $employee->user->name : '-' }}"
                                data-email="{{ $employee->user ? $employee->user->email : '-' }}"
                                data-vehicle="{{ $employee->vehicle ? $employee->vehicle->patente : '-' }}"
                                data-fecha="{{ optional($employee->fecha_ingreso)->format('Y-m-d') }}"
                                data-estado="{{ $employee->estado_laboral }}"
                                data-skills="{{ $employee->skills }}"
                                data-fecha-inicio-licencia="{{ optional($employee->fecha_inicio_licencia)->format('Y-m-d') }}"
                                data-fecha-fin-licencia="{{ optional($employee->fecha_fin_licencia)->format('Y-m-d') }}">
                                Ver
                            </button>

                            <button class="btn btn-warning btn-sm editBtn"
                                data-id="{{ $employee->id }}"
                                data-usuario="{{ $employee->user_id }}"
                                data-vehicle="{{ $employee->vehicle_id }}"
                                data-fecha="{{ optional($employee->fecha_ingreso)->format('Y-m-d') }}"
                                data-estado="{{ $employee->estado_laboral }}"
                                data-skills="{{ $employee->skills }}"
                                data-fecha-inicio-licencia="{{ optional($employee->fecha_inicio_licencia)->format('Y-m-d') }}"
                                data-fecha-fin-licencia="{{ optional($employee->fecha_fin_licencia)->format('Y-m-d') }}">
                                Editar
                            </button>

                            <button class="btn btn-danger btn-sm deleteBtn"
                                data-id="{{ $employee->id }}"
                                data-usuario="{{ $employee->user ? $employee->user->name : '-' }}">
                                Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No se encontraron empleados.</p>
    @endif
</div>

{{-- Estilos de la tabla --}}
<style>
    #tablaEmployees td, #tablaEmployees th {
        padding: 12px 10px;
        vertical-align: middle;
    }
    #tablaEmployees th {
        text-align: center;
    }
    #tablaEmployees td {
        text-align: left;
    }
    .table-responsive {
        overflow-x: auto;
    }
    .d-flex.flex-column.flex-md-row > button {
        min-width: 70px;
    }
</style>

@include('employees.modals')
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#tablaEmployees').DataTable({
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": { "next": "Siguiente", "previous": "Anterior" },
            "lengthMenu": "Mostrar <select>" +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                "<select> registros",
        }
    });

    // Filtros por columna
    $('#tablaEmployees thead tr:eq(1) th').each(function(i) {
        $('input', this).on('keyup change', function() {
            if (table.column(i).search() !== this.value) {
                table.column(i).search(this.value).draw();
            }
        });
    });

    // 🔹 Delegación de eventos para modals
    $(document).on('click', '.verBtn', function() {
        $('#verUsuario').text($(this).data('usuario'));
        $('#verEmail').text($(this).data('email'));
        $('#verVehicle').text($(this).data('vehicle'));
        $('#verFecha').text($(this).data('fecha'));
        $('#verEstado').text($(this).data('estado'));
        $('#verSkills').text($(this).data('skills') || 'N/A');
        $('#verFechaInicioLicencia').text($(this).data('fecha-inicio-licencia') || 'N/A');
        $('#verFechaFinLicencia').text($(this).data('fecha-fin-licencia') || 'N/A');
        $('#verModal').modal('show');
    });

    $(document).on('click', '.editBtn', function() {
        let id = $(this).data('id');
        $('#editForm').attr('action', '/employees/' + id);
        $('#editUsuario').val($(this).data('usuario'));
        $('#editVehicle').val($(this).data('vehicle'));
        $('#editFecha').val($(this).data('fecha'));
        $('#editEstado').val($(this).data('estado'));
        $('#editSkills').val($(this).data('skills') || '');
        $('#editFechaInicioLicencia').val($(this).data('fecha-inicio-licencia') || '');
        $('#editFechaFinLicencia').val($(this).data('fecha-fin-licencia') || '');
        $('#editModal').modal('show');
    });

    $(document).on('click', '.deleteBtn', function() {
        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        $('#deleteUsuario').text(usuario);
        $('#deleteForm').attr('action', '/employees/' + id);
        $('#deleteModal').modal('show');
    });
});
</script>
@endpush
