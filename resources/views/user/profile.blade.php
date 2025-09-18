@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Perfil de Usuario</h3>
                </div>
                <div class="card-body p-4">

                    {{-- Mensaje de éxito --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Mensaje de error --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Imagen de perfil --}}
                        <div class="mb-4 text-center">
                            <img src="{{ auth()->user()->profile_image ? asset('img/users_profile/' . auth()->user()->profile_image) : asset('default-avatar.png') }}" 
                                alt="Imagen de Perfil" 
                                class="rounded-circle border" 
                                style="width:120px; height:120px; object-fit:cover;">

                            <div class="mt-2">
                                <label for="profile_image" class="form-label">Cambiar Imagen</label>
                                <input type="file" id="profile_image" name="profile_image" class="form-control form-control-sm">
                            </div>
                        </div>

                        {{-- Nombre --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" 
                                   value="{{ auth()->user()->name }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" 
                                   value="{{ auth()->user()->email }}" required>
                        </div>

                        {{-- Teléfono --}}
                        <div class="mb-3">
                            <label for="phone" class="form-label">Número de Teléfono</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                   value="{{ auth()->user()->phone ?? '' }}">
                        </div>

                        {{-- Fecha de nacimiento --}}
                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" id="birthdate" name="birthdate" class="form-control"
                                   value="{{ auth()->user()->birthdate ?? '' }}">
                        </div>

                        {{-- Dirección --}}
                        <div class="mb-3">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" id="address" name="address" class="form-control"
                                   value="{{ auth()->user()->address ?? '' }}">
                        </div>

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
