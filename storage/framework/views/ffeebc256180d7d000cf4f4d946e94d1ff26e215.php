<?php $__env->startSection('title', 'La Liga'); ?>

<?php $__env->startSection('content'); ?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias - Liga de Fútbol</title>
    <link rel="stylesheet" href="{asset('css/app.css')}"> <!-- Asegúrate de que el enlace al archivo CSS sea correcto -->
</head>
<body>
    <div class="container">
        <h1>Noticias de actualidad</h1>
        <input type="text" id="search" placeholder="Buscar noticias por equipo o título de la noticia ..." onkeyup="fetchData()" class="form-control mb-3">

        <div id="noticias-list" class="row">
            <!-- Las noticias se llenarán dinámicamente -->
        </div>

        <div id="pagination-links" class="d-flex justify-content-center">
            <!-- Los enlaces de paginación se cargarán aquí -->
        </div>
    </div>
</body>
</html>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        fetchData(); // Carga inicial de datos
    });

    function fetchData(page = 1) {
        var search = document.getElementById('search').value;
        var url = `/noticias?search=${search}&page=${page}`;
        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
        .then(response => response.json())
        .then(data => {
            var noticiasList = document.getElementById('noticias-list');
            noticiasList.innerHTML = '';
            data.data.forEach(noticia => {
                // Realizar una segunda llamada para obtener el nombre del equipo
                fetch(`/adminnoticias/equipo/${noticia.equipo_id}`)
                    .then(response => response.json())
                    .then(equipo => {
                        // Ahora tienes el nombre del equipo
                        var noticiaHTML = `
                            <div class="col-md-12 mb-4">
                                <div class="noticia">
                                    <h3><a href="${noticia.link_de_la_web}">${noticia.titulo}</a></h2>
                                    <img src="${noticia.enlace_de_la_foto}">
                                    <p class="descripcion">${noticia.contenido}</p>
                                    <div class="noticia-info-extra">
                                            <p class="noticia-autor">${noticia.autor}</p>
                                            <p class="noticia-fecha">${noticia.fecha}</p>
                                    </div>
                                    <br>
                                </div>
                                
                            </div>
                        `;
                        noticiasList.innerHTML += noticiaHTML;
                    });
            });

            var paginationDiv = document.getElementById('pagination-links');
            paginationDiv.innerHTML = data.links;
            attachClickEventToPaginationLinks();
        })
        .catch(error => console.error('Error:', error));
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
    

        // Llamar a la función fetchNoticias al cargar la página para mostrar las primeras noticias
        document.addEventListener('DOMContentLoaded', function() {
            fetchNoticias();
            attachClickEventToPaginationLinks();
        });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/usuario/Escritorio/DSS/G02-06-DSS/resources/views/noticias.blade.php ENDPATH**/ ?>