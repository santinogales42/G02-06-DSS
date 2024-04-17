@extends('layout')

@section('content')
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
                            <input type="number" class="form-control" id="ganados" name="ganados">
                        </div>
                        <div class="mb-3">
                            <label for="empatados" class="form-label">Empatados:</label>
                            <input type="number" class="form-control" id="empatados" name="empatados">
                        </div>
                        <div class="mb-3">
                            <label for="perdidos" class="form-label">Perdidos:</label>
                            <input type="number" class="form-control" id="perdidos" name="perdidos">
                        </div>
                        <div class="mb-3">
                            <label for="goles_favor" class="form-label">Goles a Favor:</label>
                            <input type="number" class="form-control" id="goles_favor" name="goles_favor">
                        </div>
                        <div class="mb-3">
                            <label for="goles_contra" class="form-label">Goles en Contra:</label>
                            <input type="number" class="form-control" id="goles_contra" name="goles_contra">
                        </div>
                        <div class="mb-3">
                            <label for="puntos" class="form-label">Puntos:</label>
                            <input type="number" class="form-control" id="puntos" name="puntos">
                        </div>
                        <div class="mb-3">
                            <label for="partidos_jugados" class="form-label">Partidos Jugados:</label>
                            <input type="number" class="form-control" id="partidos_jugados" name="partidos_jugados">
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
document.addEventListener('DOMContentLoaded', function() {
    fetchData(); // Carga inicial de datos al cargar la página
});

function openEditModal(equipoId) {
    fetch(`/adminequipos/datos/${equipoId}`)
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP status ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        document.getElementById('edit_equipo_id').value = data.id;
        document.getElementById('edit_nombre').value = data.nombre;
        document.getElementById('edit_liga_id').value = data.liga_id;
        document.getElementById('edit_ganados').value = data.ganados;
        document.getElementById('edit_empatados').value = data.empatados;
        document.getElementById('edit_perdidos').value = data.perdidos;
        document.getElementById('edit_goles_favor').value = data.goles_favor;
        document.getElementById('edit_goles_contra').value = data.goles_contra;
        document.getElementById('edit_puntos').value = data.puntos;
        document.getElementById('edit_partidos_jugados').value = data.partidos_jugados;
        $('#editEquipoModal').modal('show');
    })
    .catch(error => console.error('Error:', error));
}

document.getElementById('editarEquipoForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const equipoId = document.getElementById('edit_equipo_id').value;
    const formData = new FormData(this);
    fetch(`/adminequipos/actualizar/${equipoId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        $('#editEquipoModal').modal('hide');
        fetchData(); // Recargar los datos
    })
    .catch(error => console.error('Error:', error));
});

function fetchData(page = 1) {
    var search = document.getElementById('search').value;
    var url = `/adminequipos?search=${search}&page=${page}`;
    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => response.json())
    .then(data => {
        var tableBody = document.getElementById('equipos-list');
        tableBody.innerHTML = '';
        data.data.forEach(equipo => {
            var row = `<tr>
                        <td><input type="checkbox" class="equipo-checkbox" value="${equipo.id}"></td>
                        <td>${equipo.id}</td>
                        <td>${equipo.nombre}</td>
                        <td>
                            <button onclick="openEditModal(${equipo.id})" class="btn btn-primary">Editar</button>
                            <button class="btn btn-danger" onclick="deleteEquipo(${equipo.id})">Eliminar</button>
                        </td>
                       </tr>`;
            tableBody.innerHTML += row;
        });
        attachCheckboxEvents();
        checkSelectedCheckboxes();
        var paginationDiv = document.getElementById('pagination-links');
        paginationDiv.innerHTML = data.links; // Añadir los nuevos enlaces de paginación
        attachClickEventToPaginationLinks();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function attachClickEventToPaginationLinks() {
    document.querySelectorAll('#pagination-links a').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault(); // Evita la navegación directa
            const page = this.getAttribute('href').split('page=')[1];
            fetchData(page);
        });
    });
}

function deleteEquipo(equipoId) {
    if (confirm('¿Seguro que quieres eliminar el equipo?')) {
        eliminarEquipo(equipoId);
    }
}

function eliminarEquipo(equipoId) {
    fetch(`/adminequipos/eliminar/${equipoId}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => {
    if (response.ok) {
        alert('Equipo eliminado con éxito');
        fetchData(); // Recargar los datos para actualizar la lista
    } else {
        response.json().then(data => alert(data.message));
    }
    })
    .catch(error => console.error('Error:', error));
}

function deleteSelectedEquipos() {
    const selectedIds = JSON.parse(localStorage.getItem('selectedEquipos')) || [];
    if (selectedIds.length === 0) {
        alert('Por favor, selecciona al menos un equipo para eliminar.');
        return;
    }

    if (!confirm('¿Seguro que quieres eliminar los equipos seleccionados?')) return;

    fetch('/adminequipos/eliminar-masa', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ ids: selectedIds }),
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        fetchData(); // Recargar la lista para reflejar los cambios
        localStorage.setItem('selectedEquipos', JSON.stringify([])); // Limpiar las selecciones después de la eliminación
    })
    .catch(error => console.error('Error:', error));
}

function attachCheckboxEvents() {
    document.querySelectorAll('.equipo-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            let selectedIds = JSON.parse(localStorage.getItem('selectedEquipos')) || [];
            if (this.checked) {
                selectedIds.push(this.value);
            } else {
                selectedIds = selectedIds.filter(id => id !== this.value);
            }
            localStorage.setItem('selectedEquipos', JSON.stringify(selectedIds));
        });
    });
}
function checkSelectedCheckboxes() {
    const selectedIds = JSON.parse(localStorage.getItem('selectedEquipos')) || [];
    document.querySelectorAll('.equipo-checkbox').forEach(checkbox => {
        checkbox.checked = selectedIds.includes(checkbox.value);
    });
}

</script>


@endsection
