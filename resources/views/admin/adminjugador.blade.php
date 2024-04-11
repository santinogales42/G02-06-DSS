@extends('layout')

@section('content')
<div class="container">
    <h1>Administración de Jugadores</h1>
    
    <input type="text" id="search" placeholder="Buscar jugadores..." onkeyup="fetchData()" class="form-control mb-3">
    <button id="bulk-delete" class="btn btn-danger" onclick="deleteSelectedJugadores()">Eliminar Seleccionados</button>
    <button id="delete-all" class="btn btn-danger" onclick="deleteAllJugadores()">Eliminar Todos los Jugadores</button>
    <button class="btn btn-primary" onclick="insertarJugadores()">Insertar Jugadores Aleatorios (Para pruebas)</button>

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
                    Crear Nuevo Jugador
                </div>
                <div class="card-body">
<form id="crearJugadorForm">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>

    <div class="mb-3">
        <label for="posicion" class="form-label">Posición:</label>
        <input type="text" class="form-control" id="posicion" name="posicion">
    </div>
    <div class="mb-3">
        <label for="nacionalidad" class="form-label">Nacionalidad:</label>
        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad">
    </div>
    <div class="mb-3">
        <label for="edad" class="form-label">Edad:</label>
        <input type="number" class="form-control" id="edad" name="edad">
    </div>
    <div class="mb-3">
        <label for="equipo_id" class="form-label">ID del Equipo:</label>
        <input type="number" class="form-control" id="equipo_id" name="equipo_id">
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Foto (URL):</label>
        <input type="text" class="form-control" id="foto" name="foto">
    </div>
    <div class="mb-3">
        <label for="biografia" class="form-label">Biografía:</label>
        <textarea class="form-control" id="biografia" name="biografia"></textarea>
    </div>

                        <!-- Añade más campos según necesites -->
                        <button type="submit" class="btn btn-primary">Crear Jugador</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchData(); // Carga inicial de datos
});
function openEditModal(jugadorId) {
    fetch(`/adminjugadores/datos/${jugadorId}`)
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP status ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        document.getElementById('edit_jugador_id').value = data.id;
        document.getElementById('edit_nombre').value = data.nombre || '';
        document.getElementById('edit_posicion').value = data.posicion || '';
        document.getElementById('edit_nacionalidad').value = data.nacionalidad || '';
        document.getElementById('edit_edad').value = data.edad || 0;
        document.getElementById('edit_equipo_id').value = data.equipo_id || '';
        document.getElementById('edit_foto').value = data.foto || '';
        document.getElementById('edit_biografia').value = data.biografia || '';
        $('#editJugadorModal').modal('show');
    })
    .catch(error => console.error('Error:', error));
}

document.getElementById('editarJugadorForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const jugadorId = document.getElementById('edit_jugador_id').value;
    const formData = new FormData(this);
    fetch(`/adminjugadores/actualizar/${jugadorId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        $('#editJugadorModal').modal('hide');
        fetchData(); // Asegúrate de que esta función ya esté definida para recargar los datos
    })
    .catch(error => console.error('Error:', error));
});
function fetchData(page = 1) {
    console.log("fetchData called for page: " + page); // Agrega esta línea para el diagnóstico
    var search = document.getElementById('search').value;
    var url = `/adminjugadores?search=${search}&page=${page}`;
    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.links); // Para ver qué está enviando el servidor
        var tableBody = document.getElementById('jugadores-list');
        tableBody.innerHTML = '';
        data.data.forEach(jugador => {
    var row = `<tr>
                <td><input type="checkbox" class="jugador-checkbox" value="${jugador.id}"></td>
                <td>${jugador.id}</td>
                <td>${jugador.nombre}</td>
                <td>
                    <button onclick="openEditModal(${jugador.id})" class="btn btn-primary">Editar</button>
                    <button class="btn btn-danger" onclick="deleteJugador(${jugador.id})">Eliminar</button>
                </td>
            </tr>`;
    tableBody.innerHTML += row;
});
attachCheckboxEvents(); // Adjuntar eventos a los nuevos checkboxes
    checkSelectedCheckboxes();
        var paginationDiv = document.getElementById('pagination-links');
        paginationDiv.innerHTML = ''; // Limpiar antes de añadir los nuevos enlaces
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
function deleteJugador(jugadorId) {
    // Mostrar un mensaje de confirmación antes de eliminar
    if (confirm('¿Seguro que quieres eliminar al jugador?')) {
        // Si el usuario confirma, proceder con la eliminación
        eliminarJugador(jugadorId);
    }
}

function eliminarJugador(jugadorId) {
    fetch(`/adminjugadores/eliminar/${jugadorId}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Asegúrate de tener este meta tag en tu layout para el CSRF token
        },
    })
    .then(response => {
    if (response.ok) {
        fetchData(); // Recargar los datos para actualizar la lista
        alert('Jugador eliminado con éxito');
    } else {
        response.json().then(data => alert(data.message));
    }
})

    .catch(error => {
        console.error('Error:', error);
    });
}
function deleteSelectedJugadores() {
    // Obtener IDs seleccionados del almacenamiento local
    const selectedIds = JSON.parse(localStorage.getItem('selectedJugadores')) || [];

    if (selectedIds.length === 0) {
        alert('Por favor, selecciona al menos un jugador para eliminar.');
        return;
    }

    if (!confirm('¿Seguro que quieres eliminar a los jugadores seleccionados?')) return;

    // Continúa con la eliminación como antes, usando `selectedIds`
    fetch('/adminjugadores/eliminar-masa', {
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
        localStorage.setItem('selectedJugadores', JSON.stringify([])); // Limpiar las selecciones después de la eliminación
    })
    .catch(error => console.error('Error:', error));
}

function attachCheckboxEvents() {
    document.querySelectorAll('.jugador-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            let selectedIds = JSON.parse(localStorage.getItem('selectedJugadores')) || [];
            if (this.checked) {
                selectedIds.push(this.value);
            } else {
                selectedIds = selectedIds.filter(id => id !== this.value);
            }
            localStorage.setItem('selectedJugadores', JSON.stringify(selectedIds));
        });
    });
}
function checkSelectedCheckboxes() {
    const selectedIds = JSON.parse(localStorage.getItem('selectedJugadores')) || [];
    document.querySelectorAll('.jugador-checkbox').forEach(checkbox => {
        checkbox.checked = selectedIds.includes(checkbox.value);
    });
}

document.getElementById('crearJugadorForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    fetch('/adminjugadores/crear', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        fetchData(); // Recargar la lista de jugadores para incluir el nuevo jugador
    })
    .catch(error => console.error('Error:', error));
});
function deleteAllJugadores() {
    if (confirm('¿Estás seguro de querer eliminar TODOS los jugadores y sus estadísticas? Esta acción es irreversible.')) {
        fetch('/adminjugadores/eliminar-todos', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            fetchData(); // Recargar los datos después de eliminar
        })
        .catch(error => console.error('Error:', error));
    }
}
function insertarJugadores() {
    fetch('/admin/insertar-jugadores', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => alert(data.message))
    
    .catch(error => console.error('Error:', error));
    fetchData();
}
</script>

@endsection