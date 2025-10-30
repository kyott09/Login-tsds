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
                <th>#</th>
                <th>Servicio</th>
                <th>Prioridad</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->id }}</td>
                    <td>{{ ucfirst($tarea->servicio) }}</td>
                    <td>{{ ucfirst($tarea->prioridad) }}</td>
                    <td>{{ $tarea->descripcion }}</td>
                    <td>{{ $tarea->estado }}</td>
                    <td>{{ \Carbon\Carbon::parse($tarea->fecha_creacion)->format('d/m/Y H:i') }}</td>
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