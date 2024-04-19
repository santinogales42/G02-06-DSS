<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Administración de Noticias</h1>
    
    <button id="bulk-delete" class="btn btn-danger" onclick="deleteSelectedJugadores()">Eliminar Noticias Seleccionadas</button>
    <button id="delete-all" class="btn btn-danger" onclick="deleteAllNoticias()">Eliminar todos las Noticias</button>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título noticia</th>
                    <th>Fecha y hora</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="noticias-list">
                <?php $__currentLoopData = $noticias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noticia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($noticia->id); ?></td>
                    <td><?php echo e($noticia->titulo); ?></td>
                    <td><?php echo e($noticia->fecha); ?></td>
                    <td><?php echo e($noticia->autor); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div id="pagination-links" class="d-flex justify-content-center">
            <?php echo e($noticias->links()); ?> <!-- Muestra los enlaces de paginación -->
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
                <form id="crearNoticiaForm" action="<?php echo e(route('admin.noticias.crear')); ?>" method="POST">
                    
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
        alert(data.message);
        fetchData();
        this.reset();
    })
    .catch(error => console.error('Error:', error));
});



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

function attachClickEventToPaginationLinks() {
    document.querySelectorAll('#pagination-links a').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault(); // Evita la navegación directa
            const page = this.getAttribute('href').split('page=')[1];
            fetchData(page);
        });
    });
}

// Mostrar noticias en tabla

function fetchData(page = 1) {
    console.log("fetchData called for page: " + page); // Agrega esta línea para el diagnóstico
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
        console.log(data.links); // Para ver qué está enviando el servidor
        var tableBody = document.getElementById('noticias-list');
        tableBody.innerHTML = '';
        data.data.forEach(jugador => {
    var row = `<tr>
                <td><input type="checkbox" class="noticia-checkbox" value="${noticia.id}"></td>
                <td>${noticia.id}</td>
                <td>${noticia.titulo}</td>
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

function insertarNoticia() {
    const formData = new FormData(document.getElementById('crearNoticiaForm')); // Obtener los datos del formulario
    fetch('<?php echo e(route('admin.noticias.crear')); ?>', {
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




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/admin/adminnoticias.blade.php ENDPATH**/ ?>