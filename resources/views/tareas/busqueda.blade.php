@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buscar Tareas</h1>
    <form action="{{ route('tareas.busqueda') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Buscar tarea por nombre o descripción" value="{{ request('query') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    @if(isset($tareas) && count($tareas) > 0)
    <table class="table table-bordered" id="tablaTareas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>
            </tr>
            <tr>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar ID"></th>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Nombre"></th>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Descripción"></th>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Fecha"></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
            <tr>
                <td>{{ $tarea->id }}</td>
                <td>{{ $tarea->nombre }}</td>
                <td>{{ $tarea->descripcion }}</td>
                <td>{{ $tarea->created_at }}</td>
                <td>
                    <a href="{{ route('tareas.show', $tarea->id) }}" class="btn btn-info btn-sm">Ver</a>
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
    // Inicializa DataTable con filtros por columna
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

    // Filtros individuales
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
