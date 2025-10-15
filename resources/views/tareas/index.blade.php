@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Tareas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <div class="btn-group" role="group" aria-label="Acciones">
            <a href="{{ route('tareas.busqueda') }}" class="btn btn-secondary">Buscar Tareas</a>
            <a href="{{ route('tareas.pdf') }}" class="btn btn-danger">Exportar PDF</a>
            @can ('crear tarea')
            <a href="{{ route('tareas.create') }}" class="btn btn-primary">Nueva Tarea</a>
            @endcan
        </div>
    </div>

    <table class="table table-bordered" id="tablaDetalle">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Prioridad</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <tr>
                <th>
                    <select class="form-control form-control-sm filtro-columna">
                        <option value="">Todos</option>
                        @foreach($tareas->pluck('id')->unique() as $id)
                            <option value="{{ $id }}">{{ $id }}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    <select class="form-control form-control-sm filtro-columna">
                        <option value="">Todos</option>
                        @foreach($tareas->pluck('user')->unique('id') as $user)
                            @if($user)
                                <option value="{{ $user->name }} ({{ $user->email }})">{{ $user->name }} ({{ $user->email }})</option>
                            @else
                                <option value="Sin cliente">Sin cliente</option>
                            @endif
                        @endforeach
                    </select>
                </th>
                <th>
                    <select class="form-control form-control-sm filtro-columna">
                        <option value="">Todos</option>
                        @foreach($tareas->pluck('servicio')->unique() as $servicio)
                            <option value="{{ ucfirst(str_replace('_',' ',$servicio)) }}">{{ ucfirst(str_replace('_',' ',$servicio)) }}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    <select class="form-control form-control-sm filtro-columna">
                        <option value="">Todos</option>
                        @foreach($tareas->pluck('prioridad')->unique() as $prioridad)
                            <option value="{{ ucfirst($prioridad) }}">{{ ucfirst($prioridad) }}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    <select class="form-control form-control-sm filtro-columna">
                        <option value="">Todos</option>
                        @foreach($tareas->pluck('fecha_creacion')->unique() as $fecha)
                            <option value="{{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}">{{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    <select class="form-control form-control-sm filtro-columna">
                        <option value="">Todos</option>
                        @foreach($tareas->pluck('estado')->unique() as $estado)
                            <option value="{{ ucfirst($estado) }}">{{ ucfirst($estado) }}</option>
                        @endforeach
                    </select>
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->id }}</td>
                    {{-- Nombre del cliente (User) --}}
                    <td>
                        @if($tarea->user)
                            {{ $tarea->user->name }} ({{ $tarea->user->email }})
                        @else
                            <em>Sin cliente</em>
                        @endif
                    </td>
                    {{-- Servicio --}}
                    <td>{{ ucfirst(str_replace('_',' ',$tarea->servicio)) }}</td>
                    {{-- Prioridad --}}
                    <td>{{ ucfirst($tarea->prioridad) }}</td>
                    {{-- Fecha de creación --}}
                    <td>{{ \Carbon\Carbon::parse($tarea->fecha_creacion)->format('d/m/Y') }}</td>
                    {{-- Estado --}}
                    <td>{{ ucfirst($tarea->estado) }}</td>
                    {{-- Acciones --}}
                    <td>
                        @can ('editar tarea')
                        <a href="{{ route('tareas.edit', $tarea) }}" class="btn btn-sm btn-warning">Editar</a>
                        <!-- Botón eliminar opcional -->
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#tablaDetalle').DataTable({
        "language":{
            "info":"_TOTAL_ registros",
            "search":"Buscar",
            "paginate": {
                "next":"Siguiente",
                "previous":"Anterior"
            },
            "lengthMenu":"Mostrar <select>"+
                '<option value="5">5</option>'+
                '<option value="10">10</option>'+
                "<select> registros",
            "loadingRecords":"Cargando...",
            "processing":"Procesando...",
            "emptyTable":"No hay datos",
            "zeroRecords":"No hay coincidencias",
            "infoEmpty":"",
            "infoFiltered":""
        }
    });

    // Filtros individuales por columna usando select
    $('#tablaDetalle thead tr:eq(1) th select.filtro-columna').each(function (i) {
        $(this).on('change', function () {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column(i).search(val ? '^' + val + '$' : '', true, false).draw();
        });
    });
});
</script>
@endpush
