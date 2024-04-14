@extends('layout')

@section('content')
<div class="container">
    <h1>Administración de Noticias</h1>
    
    <button id="bulk-delete" class="btn btn-danger" onclick="deleteSelectedJugadores()">Eliminar Noticias Seleccionadas</button>
    <button id="delete-all" class="btn btn-danger" onclick="deleteAllJugadores()">Eliminar todos las Noticias</button>

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
            <tbody id="jugadores-list">
                <!-- Los jugadores se llenan dinámicamente -->
            </tbody>
        </table>
        <div id="pagination-links" class="d-flex justify-content-center">
            <!-- Los enlaces de paginación se cargarán aquí -->
        </div>
    </div>
</div>

<!-- Modal de Edición -->
<div class="modal fade" id="editJugadorModal" tabindex="-1" aria-labelledby="editJugadorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editJugadorModalLabel">Editar Jugador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición -->
                <form id="editarJugadorForm">
                    <input type="hidden" id="edit_jugador_id" name="jugador_id">
                    <div class="mb-3">
                        <label for="edit_nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="edit_nombre" name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="edit_posicion" class="form-label">Posición:</label>
                        <input type="text" class="form-control" id="edit_posicion" name="posicion">
                    </div>
                    <div class="mb-3">
                        <label for="edit_nacionalidad" class="form-label">Nacionalidad:</label>
                        <input type="text" class="form-control" id="edit_nacionalidad" name="nacionalidad">
                    </div>
                    <div class="mb-3">
                        <label for="edit_edad" class="form-label">Edad:</label>
                        <input type="number" class="form-control" id="edit_edad" name="edad">
                    </div>
                    <div class="mb-3">
                        <label for="edit_equipo_id" class="form-label">ID del Equipo:</label>
                        <input type="number" class="form-control" id="edit_equipo_id" name="equipo_id">
                    </div>
                    <div class="mb-3">
                        <label for="edit_foto" class="form-label">Foto (URL):</label>
                        <input type="text" class="form-control" id="edit_foto" name="foto">
                    </div>
                    <div class="mb-3">
                        <label for="edit_biografia" class="form-label">Biografía:</label>
                        <textarea class="form-control" id="edit_biografia" name="biografia"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Jugador</button>
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
                    Crear Nueva Noticia
                </div>
                <div class="card-body">
                <form id="crearNoticiaForm">
    
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenido" class="form-label">Contenido:</label>
                        <textarea class="form-control" id="contenido" name="contenido" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor:</label>
                        <input type="text" class="form-control" id="autor" name="autor">
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <input type="datetime-local" class="form-control" id="fecha" name="fecha">
                    </div>
                    <div class="mb-3">
                        <label for="link_de_la_web" class="form-label">Link de la web:</label>
                        <input type="text" class="form-control" id="link_de_la_web" name="link_de_la_web">
                    </div>
                    <div class="mb-3">
                        <label for="enlace_de_la_foto" class="form-label">Enlace de la foto:</label>
                        <input type="text" class="form-control" id="enlace_de_la_foto" name="enlace_de_la_foto">
                    </div>
                    <div class="mb-3">
                        <label for="equipo_id" class="form-label">Equipo:</label>
                        <select class="form-control" id="equipo_id" name="equipo_id">
                            <option value="">Seleccionar Equipo</option>
                            <!-- Aquí puedes cargar los equipos desde la base de datos si deseas -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Noticia</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection