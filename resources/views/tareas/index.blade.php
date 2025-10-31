@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Tareas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @error('fecha_fin')
    <div class="text-danger">{{ $message }}</div>
    @enderror


    <div class="mb-3">
        <div class="btn-group" role="group" aria-label="Acciones">
            <a href="{{ route('tareas.pdf') }}" class="btn btn-danger">Exportar PDF</a>
            @can ('crear tarea')
            <a href="{{ route('tareas.create') }}" class="btn btn-primary">Nueva Tarea</a>
            @endcan
        </div>
    </div>

    <table class="table table-bordered" id="tablaDetalle">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Prioridad</th>
                <th>Fecha de creacion</th>
                <th>Fecha de Finalizacion</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <tr>
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
                        @foreach($tareas->pluck('fecha_fin')->unique() as $fecha_fin)
                            <option value="{{ $fecha_fin ? \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') : '—' }}">
                                {{ $fecha_fin ? \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') : '—' }}
                            </option>
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
                    {{-- Cliente --}}
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

                    {{-- Fecha --}}
                    <td>{{ \Carbon\Carbon::parse($tarea->fecha_creacion)->format('d/m/Y') }}</td>
                    
                    {{-- Fecha de Finalizacion --}}
                    <td>{{ $tarea->fecha_fin ? \Carbon\Carbon::parse($tarea->fecha_fin)->format('d/m/Y') : '—' }}</td>

                    {{-- Estado --}}
                    <td>{{ ucfirst($tarea->estado) }}</td>

                    {{-- Acciones --}}
                    <td class="text-center">
                        <div class="btn-group" role="group">

                            {{-- Botón Ver --}}
                            <button type="button"
                                class="btn btn-info btn-sm verBtn"
                                data-id="{{ $tarea->id }}"
                                data-cliente="{{ $tarea->user->name ?? 'Sin cliente' }}"
                                data-servicio="{{ ucfirst(str_replace('_',' ',$tarea->servicio)) }}"
                                data-prioridad="{{ ucfirst($tarea->prioridad) }}"
                                data-fecha="{{ \Carbon\Carbon::parse($tarea->fecha_creacion)->format('d/m/Y') }}"
                                data-fecha="{{ $tarea->fecha_fin ? \Carbon\Carbon::parse($tarea->fecha_fin)->format('d/m/Y') : '—' }}"
                                data-estado="{{ ucfirst($tarea->estado) }}">
                                Ver
                            </button>

                            {{-- Botón Editar --}}
                            @can('editar tarea')
                            <button class="btn btn-warning editBtn"
                                data-id="{{ $tarea->id }}"
                                data-cliente_id="{{ $tarea->user_id }}"
                                data-servicio="{{ $tarea->servicio }}"
                                data-prioridad="{{ $tarea->prioridad }}"
                                data-fecha_raw="{{ $tarea->fecha_creacion }}"
                                data-fecha_fin="{{ $tarea->fecha_fin }}"
                                data-estado="{{ $tarea->estado }}"
                                data-descripcion="{{ $tarea->descripcion }}">
                                Editar
                            </button>
                            @endcan

                            {{-- Botón Eliminar --}}
                            @can('eliminar tarea')
                            <button type="button"
                                class="btn btn-danger btn-sm deleteBtn"
                                data-id="{{ $tarea->id }}"
                                data-servicio="{{ ucfirst(str_replace('_',' ',$tarea->servicio)) }}"
                                data-cliente="{{ $tarea->user->name ?? 'Sin cliente' }}">
                                Eliminar
                            </button>
                            @endcan

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@include('tareas.modals')
@push('scripts')
<script>
$(document).ready(function() {

    // Modal Ver
    $('.verBtn').on('click', function() {
        $('#verId').text($(this).data('id'));
        $('#verCliente').text($(this).data('cliente'));
        $('#verServicio').text($(this).data('servicio'));
        $('#verPrioridad').text($(this).data('prioridad'));
        $('#verFecha').text($(this).data('fecha'));
        $('#verFechaFin').text($(this).data('fecha_fin'));
        $('#verEstado').text($(this).data('estado'));
        $('#verModal').modal('show');
    });

    // Modal Editar
    $('.editBtn').on('click', function() {
        let id = $(this).data('id');

        $('#editForm').attr('action', '/tareas/' + id);
        $('#editCliente').val($(this).data('cliente_id'));
        $('#editServicio').val($(this).data('servicio'));
        $('#editPrioridad').val($(this).data('prioridad'));
        $('#editFecha').val($(this).data('fecha_raw'));
        $('#editFechaFin').val($(this).data('fecha_fin') || '');
        $('#editEstado').val($(this).data('estado'));
        $('#editDescripcion').val($(this).data('descripcion'));
        
        $('#editModal').modal('show');
    });



    // Modal Eliminar
    $('.deleteBtn').on('click', function() {
        let id = $(this).data('id');
        $('#deleteServicio').text($(this).data('servicio'));
        $('#deleteCliente').text($(this).data('cliente'));
        $('#deleteForm').attr('action', '/tareas/' + id);
        $('#deleteModal').modal('show');
    });
});


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