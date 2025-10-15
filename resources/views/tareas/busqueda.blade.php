@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Buscar Tareas</h1>
    <div class="mb-3">
        <div class="btn-group" role="group" aria-label="Acciones">
            <a href="{{ route('tareas.create') }}" class="btn btn-primary">Nueva Tarea</a>
            <a href="{{ route('tareas.pdf') }}" class="btn btn-danger">Exportar PDF</a>
        </div>
    </div>
    <form action="{{ route('tareas.busqueda') }}" method="GET" class="mb-4">
        {{-- Puedes agregar aquí filtros adicionales si lo necesitas --}}
    </form>

    @if(isset($tareas) && count($tareas) > 0)
    <table class="table table-bordered" id="tablaTareas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Servicio</th>
                <th>Descripción</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>
            </tr>
            <tr>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar ID"></th>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Servicio"></th>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Descripción"></th>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Fecha"></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
            <tr>
                <td>{{ $tarea->id }}</td>
                <td>{{ ucfirst(str_replace('_',' ',$tarea->servicio)) }}</td>
                <td>{{ $tarea->descripcion }}</td>
                <td>{{ \Carbon\Carbon::parse($tarea->fecha_creacion ?? $tarea->created_at)->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta tarea?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>No se encontraron tareas.</p>
    @endif
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#tablaTareas').DataTable({
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

    // Filtros individuales por columna
    $('#tablaTareas thead tr:eq(1) th').each(function (i) {
        $('input', this).on('keyup change', function () {
            if (table.column(i).search() !== this.value) {
                table.column(i).search(this.value).draw();
            }
        });
    });
});
</script>
@endpush
