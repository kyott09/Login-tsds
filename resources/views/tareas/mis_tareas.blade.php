@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Mis Solicitudes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Servicio</th>
                <th>Prioridad</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <th>Fecha de Finalización</th> <!-- 👈 nuevo campo -->
            </tr>
        </thead>
        <tbody>
            @forelse($tareas as $tarea)
                <tr>
                    <td>{{ ucfirst($tarea->servicio) }}</td>
                    <td>{{ ucfirst($tarea->prioridad) }}</td>
                    <td>{{ $tarea->descripcion }}</td>
                    <td>{{ ucfirst($tarea->estado) }}</td>
                    <td>{{ \Carbon\Carbon::parse($tarea->fecha_creacion)->format('d/m/Y') }}</td>
                    <td>
                        {{ $tarea->fecha_fin ? \Carbon\Carbon::parse($tarea->fecha_fin)->format('d/m/Y') : '—' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No tenés tareas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
