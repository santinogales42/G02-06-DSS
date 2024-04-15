@extends('layout')

@section('content')
<div class="container">
    <h1>Administración de Noticias</h1>
    <input type="text" id="search" placeholder="Buscar noticias..." onkeyup="fetchData()" class="form-control mb-3">
    
    <button id="bulk-delete" class="btn btn-danger" onclick="deleteSelectedNoticias()">Eliminar Noticias Seleccionadas</button>
    <button id="delete-all" class="btn btn-danger" onclick="deleteAllNoticias()">Eliminar todas las Noticias</button>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="noticias-list">
                <!-- Las noticias se llenarán dinámicamente -->
            </tbody>
        </table>
        <div id="pagination-links" class="d-flex justify-content-center">
            <!-- Los enlaces de paginación se cargarán aquí -->
        </div>
    </div>
</div>

<!-- Modal de Edición -->
<div class="modal fade" id="editNoticiaModal" tabindex="-1" aria-labelledby="editNoticiaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNoticiaModalLabel">Editar Noticia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición -->
                <form id="editarNoticiaForm">
                    <input type="hidden" id="edit_noticia_id" name="noticia_id">
                    <div class="mb-3">
                        <label for="edit_titulo" class="form-label">Título:</label>
                        <input type="text" class="form-control" id="edit_titulo" name="titulo">
                    </div>
                    <div class="mb-3">
                        <label for="edit_contenido" class="form-label">Contenido:</label>
                        <textarea class="form-control" id="edit_contenido" name="contenido"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_fecha" class="form-label">Fecha:</label>
                        <input type="datetime-local" class="form-control" id="edit_fecha" name="fecha">
                    </div>
                    <div class="mb-3">
                        <label for="edit_autor" class="form-label">Autor:</label>
                        <input type="text" class="form-control" id="edit_autor" name="autor">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Noticia</button>
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
                <form id="crearNoticiaForm" action="{{ route('admin.noticias.crear') }}" method="POST">
                    
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
                        <label for="fecha" class="form-label">Fecha y hora:</label>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchData(); // Carga inicial de datos
});
document.getElementById('crearNoticiaForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

    const formData = new FormData(this);
    fetch('/adminnoticias/crear', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Mostrar un mensaje de éxito o error
        fetchData(); // Recargar la lista de noticias para incluir la nueva noticia
        this.reset(); // Restablecer el formulario después de la creación exitosa
    })
    .catch(error => console.error('Error:', error));
});

function fetchData(page = 1) {
    var search = document.getElementById('search').value;
    var url = `/adminnoticias?search=${search}&page=${page}`;
    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => response.json())
    .then(data => {
        var tableBody = document.getElementById('noticias-list');
        tableBody.innerHTML = '';
        data.data.forEach(noticia => {
            var row = `<tr>
                <td><input type="checkbox" class="noticia-checkbox" value="${noticia.id}"></td>
                <td>${noticia.id}</td>
                <td>${noticia.titulo}</td>
                <td>${noticia.fecha}</td>
                <td>${noticia.autor}</td>
                <td>
                    <button onclick="openEditModal(${noticia.id})" class="btn btn-primary">Editar</button>
                    <button class="btn btn-danger" onclick="deleteNoticia(${noticia.id})">Eliminar</button>
                </td>
            </tr>`;
            tableBody.innerHTML += row;
        });
        var paginationDiv = document.getElementById('pagination-links');
        paginationDiv.innerHTML = data.links;
    })
    .catch(error => console.error('Error:', error));
}

function openEditModal(noticiaId) {
    fetch(`/adminnoticias/datos/${noticiaId}`)
    .then(response => response.json())
    .then(data => {
        document.getElementById('edit_noticia_id').value = data.id;
        document.getElementById('edit_titulo').value = data.titulo || '';
        document.getElementById('edit_contenido').value = data.contenido || '';
        document.getElementById('edit_fecha').value = data.fecha || '';
        document.getElementById('edit_autor').value = data.autor || '';
        $('#editNoticiaModal').modal('show');
    })
    .catch(error => console.error('Error:', error));
}




// Eliminar noticias
function deleteAllNoticias() {
    if (confirm('¿Estás seguro de querer eliminar TODAS las noticias? Esta acción es irreversible.')) {
        fetch('/adminnoticias/eliminar-todas', {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.links); // Para ver qué está enviando el servidor
            var tableBody = document.getElementById('noticias-list');
            tableBody.innerHTML = '';
            data.data.forEach(noticia => {
                var row = `<tr>
                    <td>${noticia.id}</td> <!-- Mostrar el ID de la noticia -->
                    <td>${noticia.titulo}</td> <!-- Mostrar el título de la noticia -->
                    <td>${noticia.fecha}</td> <!-- Mostrar la fecha de la noticia -->
                    <td>${noticia.autor}</td> <!-- Mostrar el autor de la noticia -->
                </tr>`;
                tableBody.innerHTML += row;
            });
            var paginationDiv = document.getElementById('pagination-links');
            paginationDiv.innerHTML = ''; // Limpiar antes de añadir los nuevos enlaces
            paginationDiv.innerHTML = data.links; // Añadir los nuevos enlaces de paginación
            attachClickEventToPaginationLinks();
        })

        .catch(error => console.error('Error:', error));
    }
}



// Mostrar noticias en tabla



function insertarNoticia() {
    const formData = new FormData(document.getElementById('crearNoticiaForm')); // Obtener los datos del formulario
    fetch('{{ route('admin.noticias.crear') }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Hubo un problema al crear la noticia.');
        }
        return response.json();
    })
    .then(data => {
        alert(data.message); // Mostrar un mensaje de éxito
        fetchData();
    })
          
    .catch(error => console.error('Error:', error));
}

</script>




@endsection