{{-- Modal Editar Tarea --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Editar Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="editCliente">Cliente</label>
                        <select name="user_id" id="editCliente" class="form-control">
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }} ({{ $usuario->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editServicio">Servicio</label>
                        <input type="text" name="servicio" id="editServicio" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="editPrioridad">Prioridad</label>
                        <select name="prioridad" id="editPrioridad" class="form-control">
                            <option value="baja">Baja</option>
                            <option value="media">Media</option>
                            <option value="alta">Alta</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editFecha">Fecha</label>
                        <input type="date" name="fecha_creacion" id="editFecha" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="editEstado">Estado</label>
                        <select name="estado" id="editEstado" class="form-control">
                            <option value="pendiente">Pendiente</option>
                            <option value="en_progreso">En progreso</option>
                            <option value="completada">Completada</option>
                            <option value="cancelada">Cancelada</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Eliminar Tarea --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro que deseas eliminar la tarea <strong id="deleteServicio"></strong> asignada a <strong id="deleteCliente"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Ver Tarea --}}
<div class="modal fade" id="verModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detalles de la Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="verId"></span></p>
                <p><strong>Cliente:</strong> <span id="verCliente"></span></p>
                <p><strong>Servicio:</strong> <span id="verServicio"></span></p>
                <p><strong>Prioridad:</strong> <span id="verPrioridad"></span></p>
                <p><strong>Fecha:</strong> <span id="verFecha"></span></p>
                <p><strong>Estado:</strong> <span id="verEstado"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>