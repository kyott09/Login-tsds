@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Registrar Nueva Tarea de Trabajo') }}</div>

                <div class="card-body">
                    <form action="{{ route('tareas.store') }}" method="POST">
                        @csrf

                        <!-- Número de Tarea -->
                        <div class="form-group mb-3">
                            <label for="numero_tarea">Número de Tarea</label>
                            <input type="text" class="form-control" id="numero_tarea" name="numero_tarea" 
                                   value="{{ old('numero_tarea', $numeroTarea ?? 'Auto') }}" readonly>
                        </div>

                        <!-- Seleccionar Usuario Registrado -->
                        <div class="form-group mb-3">
                            <label for="user_id">Cliente/Usuario</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">Seleccione un usuario</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" data-prioridad="{{ $user->prioridad }}">
                                        {{ $user->name }} - {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Teléfono y Dirección del Cliente (opcional si querés mostrar) -->
                        {{-- 
                        <div class="form-group mb-3">
                            <label for="telefono_cliente">Teléfono</label>
                            <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente">
                        </div>

                        <div class="form-group mb-3">
                            <label for="direccion_cliente">Dirección</label>
                            <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente">
                        </div>
                        --}}

                        <!-- Fecha de Creación -->
                        <div class="form-group mb-3">
                            <label for="fecha_creacion">Fecha de Creación</label>
                            <input type="date" class="form-control" id="fecha_creacion" name="fecha_creacion" 
                                   value="{{ old('fecha_creacion', date('Y-m-d')) }}" required>
                        </div>

                        <!-- Descripción de la tarea -->
                        <div class="form-group mb-3">
                            <label for="descripcion">Descripción de la Tarea</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                        </div>

                        <!-- Servicios -->
                        <div class="form-group mb-4">
                            <label for="servicio">Servicio</label>
                            <select class="form-control" id="servicio" name="servicio" required>
                                <option value="">Seleccione un servicio</option>
                                <option value="instalacion_wifi">Instalación de Wi-Fi</option>
                                <option value="mantenimiento_redes">Mantenimiento de Redes</option>
                                <option value="configuracion_router">Configuración de Router</option>
                                <option value="extension_cobertura">Extensión de Cobertura Wi-Fi</option>
                                <option value="diagnostico_problemas">Diagnóstico y Reparación</option>
                                <option value="instalacion_camaras">Instalación de Cámaras IP</option>
                            </select>
                        </div>

                        <!-- Prioridad (solo lectura) -->
                        <div class="form-group mb-4">
                            <label>Prioridad</label>
                            <p id="prioridad_text" class="form-control" style="background-color: #e9ecef; cursor: not-allowed;"></p>
                            <input type="hidden" id="prioridad" name="prioridad">
                        </div>

                        <!-- Estado -->
                        <div class="form-group mb-4">
                            <label for="estado">Estado de la Tarea</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="vista">Vista</option>
                                <option value="en proceso">En Proceso</option>
                                <option value="terminada">Terminada</option>
                                <option value="no terminada">No Terminada</option>
                            </select>
                        </div>

                        <!-- Botón -->
                        <button type="submit" class="btn btn-primary">Guardar Tarea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para mostrar la prioridad según usuario -->
<script>
    const userSelect = document.getElementById('user_id');
    const prioridadInput = document.getElementById('prioridad');
    const prioridadText = document.getElementById('prioridad_text');

    userSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const prioridad = selectedOption.dataset.prioridad || '';
        prioridadInput.value = prioridad;
        prioridadText.textContent = prioridad.charAt(0).toUpperCase() + prioridad.slice(1);
    });
</script>
@endsection