@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Tareas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @can ('crear tarea')
    <a href="{{ route('tareas.create') }}" class="btn btn-primary mb-3">Nueva Tarea</a>
    @endcan
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
    console.log("jQuery listo!");
});

$(document).ready(function() {
    $('#tablaDetalle').DataTable({
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
});
</script>
@endpush
