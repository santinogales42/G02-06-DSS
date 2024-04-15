<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Administración de Equipos</h1>
    
    <input type="text" id="search" placeholder="Buscar equipos..." onkeyup="fetchData()" class="form-control mb-3">
    <button id="bulk-delete" class="btn btn-danger" onclick="deleteSelectedEquipos()">Eliminar Seleccionados</button>
    <button id="delete-all" class="btn btn-danger" onclick="deleteAllEquipos()">Eliminar Todos los Equipos</button>
    <button class="btn btn-primary" onclick="insertarEquipos()">Insertar Equipos Aleatorios (Para pruebas)</button>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="equipos-list">
                <!-- Los equipos se llenan dinámicamente -->
            </tbody>
        </table>
        <div id="pagination-links" class="d-flex justify-content-center">
            <!-- Los enlaces de paginación se cargarán aquí -->
        </div>
    </div>
</div>

<!-- Modal de Edición -->
<div class="modal fade" id="editEquipoModal" tabindex="-1" aria-labelledby="editEquipoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEquipoModalLabel">Editar Equipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición -->
                <form id="editarEquipoForm">
                    <input type="hidden" id="edit_equipo_id" name="equipo_id">
                    <div class="mb-3">
                        <label for="edit_nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_liga_id" class="form-label">ID de la Liga:</label>
                        <input type="number" class="form-control" id="edit_liga_id" name="liga_id">
                    </div>
                    <!-- Añade más campos si es necesario -->
                    <button type="submit" class="btn btn-primary">Actualizar Equipo</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Crear Nuevo Equipo
                </div>
                <div class="card-body">
                    <form id="crearEquipoForm">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="liga_id" class="form-label">ID de la Liga:</label>
                            <input type="number" class="form-control" id="liga_id" name="liga_id">
                        </div>
                        <div class="mb-3">
                            <label for="ganados" class="form-label">Ganados:</label>
                            <input type="number" class="form-control" id="ganados" name="ganados" required>
                        </div>
                        <div class="mb-3">
                            <label for="empatados" class="form-label">Empatados:</label>
                            <input type="number" class="form-control" id="empatados" name="empatados" required>
                        </div>
                        <div class="mb-3">
                            <label for="perdidos" class="form-label">Perdidos:</label>
                            <input type="number" class="form-control" id="perdidos" name="perdidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="goles_favor" class="form-label">Goles a Favor:</label>
                            <input type="number" class="form-control" id="goles_favor" name="goles_favor" required>
                        </div>
                        <div class="mb-3">
                            <label for="goles_contra" class="form-label">Goles en Contra:</label>
                            <input type="number" class="form-control" id="goles_contra" name="goles_contra" required>
                        </div>
                        <div class="mb-3">
                            <label for="puntos" class="form-label">Puntos:</label>
                            <input type="number" class="form-control" id="puntos" name="puntos" required>
                        </div>
                        <div class="mb-3">
                            <label for="partidos_jugados" class="form-label">Partidos Jugados:</label>
                            <input type="number" class="form-control" id="partidos_jugados" name="partidos_jugados" required>
                        </div>
                        <!-- Añade más campos según necesites -->
                        <button type="submit" class="btn btn-primary">Crear Equipo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Aquí iría el código JavaScript adaptado para gestionar equipos en lugar de jugadores. 
// Debes replicar las funcionalidades de búsqueda, paginación, creación, edición y eliminación.
// Deberías cambiar las referencias de jugadores a equipos y ajustar las URL de las peticiones AJAX.
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/admin/adminequipo.blade.php ENDPATH**/ ?>