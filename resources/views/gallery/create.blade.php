@extends('layouts.admin')

@section('title', 'Agregar Foto')

@section('content_header')
    <h1>Agregar Nueva Foto</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="image">Imagen</label>
                <input type="file" name="image" class="form-control-file" required>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
            <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</div>
@stop
