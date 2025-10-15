@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Buscar Empleados</h1>
    <form action="{{ route('employees.busqueda') }}" method="GET" class="mb-4">
    </form>

    @if(isset($employees) && count($employees) > 0)
    <table class="table table-bordered" id="tablaEmployees">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Vehículo</th>
                <th>Fecha Ingreso</th>
                <th>Estado Laboral</th>
                <th>Acciones</th>
            </tr>
            <tr>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar ID"></th>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Usuario"></th>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Vehículo"></th>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Fecha"></th>
                <th><input type="text" class="form-control form-control-sm" placeholder="Filtrar Estado"></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>
                    @if($employee->user)
                        {{ $employee->user->name }} ({{ $employee->user->email }})
                    @else
                        <em>Sin usuario</em>
                    @endif
                </td>
                <td>
                    @if($employee->vehicle)
                        {{ $employee->vehicle->patente }}
                    @else
                        <em>Sin vehículo</em>
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($employee->fecha_ingreso)->format('d/m/Y') }}</td>
                <td>{{ ucfirst($employee->estado_laboral) }}</td>
                <td>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este empleado?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>No se encontraron empleados.</p>
    @endif
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#tablaEmployees').DataTable({
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
    $('#tablaEmployees thead tr:eq(1) th').each(function (i) {
        $('input', this).on('keyup change', function () {
            if (table.column(i).search() !== this.value) {
                table.column(i).search(this.value).draw();
            }
        });
    });
});
</script>
@endpush
