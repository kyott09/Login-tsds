@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="titulo">Lista de Tareas</h1>

    <form action="/tareas" method="POST" class="form-nueva-tarea">
        @csrf
        <input type="text" name="titulo" placeholder="Nueva tarea" class="input-tarea">
        <button type="submit" class="btn-agregar">Agregar</button>
    </form>

    <ul class="lista-tareas">
        @foreach($tareas as $tarea)
            <li class="tarea-item">
                <span class="tarea-id">{{ $tarea->id }}</spam>
                <span class="tarea-nombre">{{ $tarea->nombre }}</span>
                <a href="/tareas/{{ $tarea->id }}/edit" class="btn-editar">Editar</a>
                <form action="/tareas/{{ $tarea->id }}" method="POST" class="form-eliminar">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-eliminar">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>

@endsection
