@extends('layout')

@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<!-- Popper.js (Necesario para los dropdowns, tooltips, y popovers en Bootstrap 4) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
<div class="container">
    <h1>Listado de Jugadores</h1>

    <!-- Botones desplegables para ordenar -->
    
    <div class="dropdown mb-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ordenar por
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" onclick="orderBy('goles', 'desc')">Goles (Mayor a Menor)</a>
            <a class="dropdown-item" href="#" onclick="orderBy('goles', 'asc')">Goles (Menor a Mayor)</a>
            <a class="dropdown-item" href="#" onclick="orderBy('asistencias', 'desc')">Asistencias (Mayor a Menor)</a>
            <a class="dropdown-item" href="#" onclick="orderBy('asistencias', 'asc')">Asistencias (Menor a Mayor)</a>
            <a class="dropdown-item" href="#" onclick="orderBy('amarillas', 'desc')">Amarillas (Mayor a Menor)</a>
            <a class="dropdown-item" href="#" onclick="orderBy('amarillas', 'asc')">Amarillas (Menor a Mayor)</a>
            <a class="dropdown-item" href="#" onclick="orderBy('rojas', 'desc')">Rojas (Mayor a Menor)</a>
            <a class="dropdown-item" href="#" onclick="orderBy('rojas', 'asc')">Rojas (Menor a Mayor)</a>
        </div>
    </div>
    
<input type="text" id="search" placeholder="Buscar jugadores..." onkeyup="fetchData()" class="form-control mb-3">
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 80%; margin: auto;">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Posición</th>
                    <th>Edad</th>
                    <th>Goles</th>
                    <th>Asistencias</th>
                    <th>Amarillas</th>
                    <th>Rojas</th>
                    <th>Equipo</th>
                </tr>
            </thead>
            <tbody id="jugadores-list">
                <!-- Asumiendo que vas a llenar esto dinámicamente con fetchData() -->
            </tbody>
        </table>
    </div>
</div>


<script>
var orderField = 'nombre'; // Ordenar por nombre por defecto
var orderDirection = 'asc'; // Dirección ascendente por defecto

document.addEventListener('DOMContentLoaded', function() {
    fetchData(); // Cargar todos los jugadores inicialmente
});

function orderBy(field, direction) {
    orderField = field;
    orderDirection = direction;
    fetchData();
}
var selectedTeamId = ''; // Mantener el equipo seleccionado

function filterByTeam(teamId) {
    selectedTeamId = teamId;
    fetchData();
}
function fetchData() {
    var search = document.getElementById('search').value;
    var url = `/jugadores?search=${search}&orderField=${orderField}&orderDirection=${orderDirection}&teamId=${selectedTeamId}`;
    console.log("URL:", url); // Agregar esta línea para imprimir la URL en la consola
    console.log("orderField:", orderField); // Agregar esta línea para imprimir orderField en la consola
    console.log("orderDirection:", orderDirection); // Agregar esta línea para imprimir orderDirection en la consola
    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => updateTable(data))
    .catch(error => console.error('Error:', error));
}


function updateTable(data) {
    var tableBody = document.getElementById('jugadores-list');
    tableBody.innerHTML = ''; // Limpiar la tabla antes de añadir nuevos resultados

    data.forEach(jugador => {
        var row = `<tr>
                    <td><a href="/jugadores/${jugador.id}">${jugador.nombre}</a></td>
                    <td>${jugador.posicion}</td>
                    <td>${jugador.edad}</td>
                    <td>${jugador.estadisticas ? jugador.estadisticas.goles : '0'}</td>
                    <td>${jugador.estadisticas ? jugador.estadisticas.asistencias : '0'}</td>
                    <td>${jugador.estadisticas ? jugador.estadisticas.amarillas : '0'}</td>
                    <td>${jugador.estadisticas ? jugador.estadisticas.rojas : '0'}</td>
                    <td>${jugador.equipo ? jugador.equipo.nombre : 'Sin equipo'}</td>
                   </tr>`;
        tableBody.innerHTML += row;
    });
}


</script>

@endsection

