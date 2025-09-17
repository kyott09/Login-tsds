@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar Vehículo</div>
                <div class="card-body">

                    {{-- Mensajes de error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('vehiculos.store') }}" method="POST">
                        @csrf

                        {{-- Patente --}}
                        <div class="mb-3">
                            <label for="patente" class="form-label">Patente</label>
                            <input type="text" name="patente" id="patente" class="form-control" value="{{ old('patente') }}" required>
                        </div>

                        {{-- Modelo --}}
                        <div class="mb-3">
                            <label for="modelo_id" class="form-label">Modelo</label>
                            <select name="modelo_id" id="modelo_id" class="form-select" required>
                                <option value="">Seleccione un modelo</option>
                                @foreach($modelos as $modelo)
                                    <option value="{{ $modelo->id }}" {{ old('modelo_id') == $modelo->id ? 'selected' : '' }}>
                                        {{ $modelo->descripcion }} @if($modelo->brand) ({{ $modelo->brand->descripcion }}) @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Color --}}
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" name="color" id="color" class="form-control" value="{{ old('color') }}">
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                        </div>

                        {{-- Estado --}}
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select" required>
                                <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        {{-- Botones --}}
                        <button type="submit" class="btn btn-primary">Registrar Vehículo</button>
                        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
