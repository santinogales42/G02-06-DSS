@extends('layout')

@section('content')
<div class="container">
    <h1>Administración de Jugadores</h1>

    <input type="text" id="search" placeholder="Buscar jugadores..." onkeyup="fetchData()" class="form-control mb-3">
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchData(); // Carga inicial de datos
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
                        <td>${jugador.id}</td>
                        <td>${jugador.nombre}</td>
                        <td>
                            <a href="/adminjugadores/editar/${jugador.id}" class="btn btn-primary">Editar</a>
                            <button class="btn btn-danger" onclick="deleteJugador(${jugador.id})">Eliminar</button>
                        </td>
                       </tr>`;
            tableBody.innerHTML += row;
        });

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
</script>

@endsection
