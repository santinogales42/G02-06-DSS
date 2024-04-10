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
            Seleccionar entidad
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" onclick="orderBy('goles', 'desc')">Jugadores</a>
            <a class="dropdown-item" href="#" onclick="orderBy('goles', 'asc')">Equipos</a>
            <a class="dropdown-item" href="#" onclick="orderBy('asistencias', 'desc')">Titulos</a>
            <a class="dropdown-item" href="#" onclick="orderBy('asistencias', 'asc')">Partidos</a>
            <a class="dropdown-item" href="#" onclick="orderBy('amarillas', 'desc')">Estadisticas de jugadores</a>
            <a class="dropdown-item" href="#" onclick="orderBy('amarillas', 'asc')">Estadisticas de equipos</a>
            <a class="dropdown-item" href="#" onclick="orderBy('rojas', 'desc')">Estadisticas de partidos</a>
            <a class="dropdown-item" href="#" onclick="orderBy('rojas', 'asc')">Usuarios</a>
        </div>
        @endsection
