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
                                class="rounded-circle border mb-3" 
                                style="width:120px; height:120px; object-fit:cover;">


                            {{-- Botón personalizado para subir imagen --}}
                            <div class="custom-file-upload mx-auto" style="max-width: 320px;">
                                <label for="profile_image" class="btn btn-primary w-100">
                                    <i class="bi bi-upload"></i> Subir imagen
                                </label>
                                <input 
                                    type="file" 
                                    id="profile_image" 
                                    name="profile_image" 
                                    class="form-control form-control-sm d-none">
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
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" 
                                   value="{{ auth()->user()->email }}" required>
                        </div>

                        {{-- Teléfono --}}
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                   value="{{ auth()->user()->phone ?? '' }}">
                        </div>

                        {{-- Fecha de nacimiento --}}
                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Fecha de nacimiento</label>
                            <input type="date" id="birthdate" name="birthdate" class="form-control"
                                value="{{ $user->birthdate ? $user->birthdate->format('Y-m-d') : '' }}">
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

{{-- Estilos personalizados --}}
<style>
    /* Centrar y mejorar visual del input file */
    .custom-file-upload label {
        cursor: pointer;
        padding: 8px 12px;
        font-weight: 500;
    }

    /* Oculta el input original */
    .custom-file-upload input[type="file"] {
        display: none;
    }

    /* Efecto hover */
    .custom-file-upload label:hover {
        background-color: #0b5ed7;
    }

    /* Ícono de Bootstrap opcional */
    .bi-upload {
        margin-right: 6px;
    }
</style>
@endsection
