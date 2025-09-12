@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Modelos de Vehículos</span>
                    <a href="{{ route('vehicle-models.create') }}" class="btn btn-primary btn-sm">Agregar Modelo</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modelos as $modelo)
                                <tr>
                                    <td>{{ $modelo->id }}</td>
                                    <td>{{ $modelo->nombre }}</td>
                                    <td>
                                        <a href="{{ route('vehicle-models.edit', $modelo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('vehicle-models.destroy', $modelo->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar modelo?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
