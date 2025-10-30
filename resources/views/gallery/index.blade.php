@extends('layouts.admin') 
@section('title', 'Galería de Fotos')

@section('content_header')
    <h1 class="text-center mb-4">📸 Galería de Fotos</h1>
@stop

@section('content')
<div class="container">

    <div class="mb-3 text-right">
        @can ('crear foto')
        <a href="{{ route('gallery.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Agregar Foto
        </a>
        @endcan
    </div>

    @if($photos->isEmpty())
        <div class="alert alert-info text-center">
            No hay fotos cargadas todavía.
        </div>
    @else
        <div id="photoCarousel" class="carousel slide" data-ride="carousel" data-interval="4000">
            <ol class="carousel-indicators">
                @foreach($photos as $index => $photo)
                    <li data-target="#photoCarousel" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>

            <div class="carousel-inner rounded-lg shadow-lg">
                @foreach($photos as $index => $photo)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('public/img/users_profile/gallery'.$photo->image_path) }}" 
                             class="d-block w-100" 
                             alt="{{ $photo->title }}" 
                             style="height: 500px; object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column justify-content-center align-items-center bg-dark bg-opacity-50 rounded p-3">
                            <h4>{{ $photo->title }}</h4>
                            <div class="mt-2">

                                <form action="{{ route('gallery.destroy', $photo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que querés eliminar esta foto?');">
                                    @csrf
                                    @method('DELETE')
                                    @can('borrar foto')
                                    <button type="submit" class="btn btn-danger btn-sm mx-1">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                    @endcan
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Controles -->
            <a class="carousel-control-prev" href="#photoCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#photoCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    @endif
</div>
@stop

@section('css')
<style>
.carousel-item img {
    border-radius: 10px;
}
.carousel-caption {
    background: rgba(0, 0, 0, 0.6);
}
.carousel-caption h4 {
    color: #fff;
    text-shadow: 1px 1px 3px #000;
}
.carousel-caption .btn {
    box-shadow: 0 2px 4px rgba(0,0,0,0.3);
}
</style>
@stop
