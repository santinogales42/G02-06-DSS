@extends('layout')

@section('title', 'La Liga')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Noticias de actualidad</h1>
            <input type="text" id="search" placeholder="Buscar noticias por equipo o título de la noticia ..." onkeyup="fetchData()" class="form-control mb-3">

            <div id="noticias-list" class="row">
                <!-- Las noticias se llenarán dinámicamente -->
            </div>

            <div id="pagination-links" class="d-flex justify-content-center">
                <!-- Los enlaces de paginación se cargarán aquí -->
            </div>
        </div>

        <div class="col-md-4">
            <h2 class="mt-4">Clasificación</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Pos</th>
                            <th>Equipo</th>
                            <th class="text-center">Pts</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipos as $index => $equipo)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $equipo->nombre }}</td>
                            <td class="text-center">{{ $equipo->puntos }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchData(); // Carga inicial de datos
    });

    function fetchData(page = 1) {
        const search = document.getElementById('search').value;
        const url = `/noticias?search=${search}&page=${page}`;
        fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
            .then(response => response.json())
            .then(data => {
                const noticiasList = document.getElementById('noticias-list');
                noticiasList.innerHTML = ''; // Limpiar la lista actual
                data.data.forEach(noticia => {
                    const noticiaHTML = `
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="links-noticias">
                                <a href="${noticia.link_de_la_web}">${noticia.titulo}</a>
                            </h3>
                            <p>${noticia.contenido}</p>
                            <p class="text-muted">${noticia.fecha}</p>
                        </div>
                        <div class="card-footer">
                            Autor: ${noticia.autor}
                        </div>
                    </div>
                </div>
            `;
                    noticiasList.innerHTML += noticiaHTML;
                });

                const paginationDiv = document.getElementById('pagination-links');
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
</script>

@endsection