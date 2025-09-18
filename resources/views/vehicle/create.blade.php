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

                        {{-- Marca --}}
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Marca</label>
                            <select id="brand_id" class="form-select">
                                <option value="">Seleccione una marca</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Modelo --}}
                        <div class="mb-3">
                            <label for="modelo_id" class="form-label">Modelo</label>
                            <select name="modelo_id" id="modelo_id" class="form-select" required>
                                <option value="">Seleccione un modelo</option>
                                {{-- Se llena dinámicamente con JS --}}
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

{{-- Script para menú doble --}}
<script>
    // Pasamos las marcas con modelos a JS
    const brands = @json($brands);

    document.getElementById('brand_id').addEventListener('change', function () {
        const brandId = this.value;
        const modeloSelect = document.getElementById('modelo_id');
        modeloSelect.innerHTML = '<option value="">Seleccione un modelo</option>';

        if (brandId) {
            // Buscar la marca seleccionada
            const brand = brands.find(b => b.id == brandId);
            if (brand && brand.vehicle_models.length) {
                brand.vehicle_models.forEach(modelo => {
                    modeloSelect.innerHTML += `<option value="${modelo.id}">${modelo.descripcion}</option>`;
                });
            }
        }
    });
</script>
@endsection
