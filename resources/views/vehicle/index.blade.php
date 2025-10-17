@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Listado de Vehículos</span>
                    @can('crear vehiculos')
                        <a href="{{ route('vehiculos.create') }}" class="btn btn-primary btn-sm">Registrar Vehículo</a>
                    @endcan
                </div>

                <div class="card-body">
                    {{-- Filtros de búsqueda --}}
                    <form action="{{ route('vehiculos.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            {{-- Incluye los campos del archivo de búsqueda --}}
                            @include('vehicle.busqueda')

                            {{-- Botones de acción --}}
                            <div class="form-group col-md-3 d-flex align-items-end">
                                <div class="btn-group" role="group" aria-label="Acciones">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>

                                    <a href="{{ route('vehiculos.exportPdf', [], false) .
                                        '?desde=' . request('desde') .
                                        '&hasta=' . request('hasta') .
                                        '&modelo_id=' . request('modelo_id') }}"
                                        class="btn btn-danger" target="_blank">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>

                                    <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-eraser"></i> Limpiar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Mensajes de éxito --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Tabla de vehículos --}}
                    <table class="table table-bordered" id="tablaDetalle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Patente</th>
                                <th>Modelo</th>
                                <th>Color</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                <th>Fecha Creación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{ $vehiculo->id }}</td>
                                    <td>{{ $vehiculo->patente }}</td>
                                    <td>
                                        {{ $vehiculo->modelo->descripcion ?? 'Sin modelo' }}
                                        @if($vehiculo->modelo && $vehiculo->modelo->brand)
                                            ({{ $vehiculo->modelo->brand->descripcion }})
                                        @endif
                                    </td>
                                    <td>{{ $vehiculo->color }}</td>
                                    <td>{{ ucfirst($vehiculo->estado) }}</td>
                                    <td>
                                        @can('editar vehiculos')
                                            <button type="button" class="btn btn-warning btn-sm editBtn"
                                                data-id="{{ $vehiculo->id }}"
                                                data-patente="{{ $vehiculo->patente }}"
                                                data-color="{{ $vehiculo->color }}"
                                                data-modelo_id="{{ $vehiculo->modelo_id }}"
                                                data-estado="{{ $vehiculo->estado }}">
                                                Editar
                                            </button>
                                        @endcan
                                        @can('borrar vehiculos')
                                            <button type="button" class="btn btn-danger btn-sm deleteBtn"
                                                data-id="{{ $vehiculo->id }}"
                                                data-patente="{{ $vehiculo->patente }}">
                                                Eliminar
                                            </button>
                                        @endcan
                                         @can('ver vehiculos')
                                            <button type="button" class="btn btn-info btn-sm verBtn"
                                                data-id="{{ $vehiculo->id }}"
                                                data-patente="{{ $vehiculo->patente }}"
                                                data-modelo="{{ $vehiculo->modelo->descripcion ?? 'Sin modelo' }}"
                                                data-marca="{{ $vehiculo->modelo && $vehiculo->modelo->brand ? $vehiculo->modelo->brand->descripcion : '-' }}"
                                                data-color="{{ $vehiculo->color }}"
                                                data-estado="{{ ucfirst($vehiculo->estado) }}"
                                                data-fecha="{{ $vehiculo->created_at ? $vehiculo->created_at->format('d/m/Y H:i') : 'Sin fecha' }}">
                                                Ver
                                            </button>
                                        @endcan

                                    </td>
                                    <td>{{ $vehiculo->created_at ? $vehiculo->created_at->format('d/m/Y H:i') : 'Sin fecha' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@include('vehicle.modals')
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inicializar DataTable
    $('#tablaDetalle').DataTable({
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar <select>" +
                '<option value="6">6</option>' +
                '<option value="10">10</option>' +
                "<select> registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmpty": "",
            "infoFiltered": ""
        }
    });

    // Botón Editar
    $('.editBtn').on('click', function() {
        let id = $(this).data('id');
        $('#editPatente').val($(this).data('patente'));
        $('#editColor').val($(this).data('color'));
        $('#editModelo').val($(this).data('modelo_id'));
        $('#editEstado').val($(this).data('estado'));
        $('#editForm').attr('action', '/vehiculos/' + id);
        $('#editModal').modal('show');
    });

    // Botón Eliminar
    $('.deleteBtn').on('click', function() {
        let id = $(this).data('id');
        let patente = $(this).data('patente');
        $('#deletePatente').text(patente);
        $('#deleteForm').attr('action', '/vehiculos/' + id);
        $('#deleteModal').modal('show');
    });
    // Botón Ver
    // Botón Ver
    $('.verBtn').on('click', function() {
        $('#verId').text($(this).data('id'));
        $('#verPatente').text($(this).data('patente'));
        $('#verModelo').text($(this).data('modelo'));
        $('#verMarca').text($(this).data('marca'));
        $('#verColor').text($(this).data('color'));
        $('#verEstado').text($(this).data('estado'));
        $('#verFecha').text($(this).data('fecha'));
        $('#verModal').modal('show');
    });

});
</script>
@endpush
