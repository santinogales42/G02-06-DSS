
@extends('layout')

@section('content')
<div class="container">
    <h1>Administración de Noticias</h1>
    <input type="text" id="search" placeholder="Buscar noticias..." onkeyup="fetchData()" class="form-control mb-3">

    <div id="noticias-list" class="row">
        <!-- Las noticias se llenarán dinámicamente -->
    </div>

    <div id="pagination-links" class="d-flex justify-content-center">
        <!-- Los enlaces de paginación se cargarán aquí -->
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        fetchData(); // Carga inicial de datos
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
                                <div class="card">
                                    <img src="..." class="card-img-top" alt="Imagen de la noticia">
                                    <div class="card-body">
                                        <h3><a href="${noticia.link_de_la_web}">${noticia.titulo}</a></h2>
                                        <p class="card-text">${noticia.fecha}</p>
                                        <p class="card-text">${noticia.autor}</p>
                                        <p class="card-text">${equipo.nombre}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                        noticiasList.innerHTML += noticiaHTML;
                    });
            });

            var paginationDiv = document.getElementById('pagination-links');
            paginationDiv.innerHTML = data.links;
        })
        .catch(error => console.error('Error:', error));
    }

        // Esta función se encarga de manejar el evento de clic en los enlaces de paginación
        function attachClickEventToPaginationLinks() {
            document.querySelectorAll('#pagination-links a').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault(); // Evitar la navegación directa
                    const page = this.getAttribute('href').split('page=')[1];
                    fetchNoticias(page); // Llamar a la función para obtener las noticias de la página seleccionada
                });
            });
        }

        // Llamar a la función fetchNoticias al cargar la página para mostrar las primeras noticias
        document.addEventListener('DOMContentLoaded', function() {
            fetchNoticias();
            attachClickEventToPaginationLinks();
        });
</script>

@endsection