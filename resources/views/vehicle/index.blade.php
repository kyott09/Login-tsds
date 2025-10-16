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
                                            <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        @endcan
                                        @can('borrar vehiculos')
                                            <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?')">Eliminar</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                                @include('vehicle.modal_delete')
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#tablaDetalle').DataTable({
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar <select>" +
                '<option value="5">5</option>' +
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
});
</script>
@endpush
