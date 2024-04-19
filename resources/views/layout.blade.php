<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LALIGA EA SPORTS 2023-24</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hurricane&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluir Bootstrap JS (asegúrate de que coincida con la versión de Bootstrap CSS) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="banner">
        <img src="{{ asset('images/tims.png') }}" alt="Banner" usemap="#equiposMap" style="width:100%;">
        <map name="equiposMap">
            <area shape="rect" coords="0,0,92,47" href="https://www.athletic-club.eus/" alt="AthleticClub" target="_blank">
            <area shape="rect" coords="92,0,184,47" href="https://www.atleticodemadrid.com/" alt="AtleticoMadrid" target="_blank">
            <area shape="rect" coords="184,0,276,47" href="https://www.osasuna.es/" alt="Osasuna" target="_blank">
            <area shape="rect" coords="276,0,368,47" href="https://www.cadizcf.com/" alt="Cadiz" target="_blank">
            <area shape="rect" coords="368,0,460,47" href="https://www.deportivoalaves.com/es/" alt="Alaves" target="_blank">
            <area shape="rect" coords="460,0,552,47" href="https://www.fcbarcelona.es/es/" alt="Bcn" target="_blank">
            <area shape="rect" coords="552,0,644,47" href="https://www.getafecf.com/" alt="Getafe" target="_blank">
            <area shape="rect" coords="644,0,736,47" href="https://www.gironafc.cat/es" alt="Girona" target="_blank">
            <area shape="rect" coords="736,0,828,47" href="https://www.granadacf.es/" alt="Granada" target="_blank">
            <area shape="rect" coords="828,0,920,47" href="https://www.rayovallecano.es" alt="Rayo" target="_blank">
            <area shape="rect" coords="920,0,1012,47" href="https://rccelta.es/" alt="Celta" target="_blank">
            <area shape="rect" coords="1012,0,1104,47" href="https://www.rcdmallorca.es/" alt="Mallorca" target="_blank">
            <area shape="rect" coords="1380,0,1472,47" href="https://sevillafc.es/" alt="Sevilla" target="_blank">
            <area shape="rect" coords="1104,0,1196,47" href="https://www.realbetisbalompie.es/" alt="Betis" target="_blank">
            <area shape="rect" coords="1196,0,1288,47" href="https://www.realmadrid.com/es-ES" alt="Madrid" target="_blank">
            <area shape="rect" coords="1288,0,1380,47" href="https://www.realsociedad.eus/" alt="RealSociedad" target="_blank">
            <area shape="rect" coords="1472,0,1564,47" href="https://www.udalmeriasad.com/" alt="Almeria" target="_blank">
            <area shape="rect" coords="1564,0,1656,47" href="https://www.udlaspalmas.es/" alt="LasPalmas" target="_blank">
            <area shape="rect" coords="1656,0,1748,47" href="https://www.valenciacf.com/" alt="Valencia" target="_blank">
            <area shape="rect" coords="1748,0,1840,47" href="https://villarrealcf.es/" alt="Villareal" target="_blank">
            <area shape="rect" coords="1840,0,1847,47" href="https://villarrealcf.es/" alt="Villareal" target="_blank">
        </map>
    </div>

    <div class="w3-sidebar w3-card w3-animate-left" style="display:none" id="mySidebar">
        <!-- Botón de flecha para cerrar la barra lateral -->
        <div class="SidebarSection">
            <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
            <a href="{{ route('home') }}" class="w3-bar-item w3-button" style="text-decoration: none;">Inicio</a>
            <a href="{{ route('noticias') }}" class="w3-bar-item w3-button" style="text-decoration: none;">Noticias</a>
            <a href="{{ route('equipos.index') }}" class="w3-bar-item w3-button" style="text-decoration: none;">Equipos</a>
            <a href="{{ route('jugadores') }}" class="w3-bar-item w3-button" style="text-decoration: none;">Jugadores</a>
            <a href="{{ route('calendario.index') }}" class="w3-bar-item w3-button" style="text-decoration: none;">Calendario</a>
            <a href="{{ route('clasificacion') }}" class="w3-bar-item w3-button" style="text-decoration: none;">Clasificación</a>
            <a href="{{ route('favoritos.index') }}" class="w3-bar-item w3-button" style="text-decoration: none;">Favoritos</a>
            <div class="w3-dropdown-hover w3-bar-item">
                <button class="w3-button w3-bar-item">Admin <i class="fas fa-chevron-down"></i></button>
                <div class="w3-dropdown-content w3-bar-block w3-card">
                    <a href="{{ route('admin.adminjugador') }}" class="w3-bar-item w3-button dropdownButton">Jugadores</a>
                    <a href="{{ route('admin.usuarios.index') }}" class="w3-bar-item w3-button dropdownButton">Usuarios</a>
                    <a href="{{ route('admin.partidos.index') }}" class="w3-bar-item w3-button dropdownButton">Partidos</a>
                </div>
            </div>
            <!-- Enlaces en la parte inferior de la barra lateral -->
            <div class="SidebarDownSection">
                <div class="horizontal-line-1"></div>
                <div class="contenedor-imagenes">
                    <img src="{{ asset('images/insta.png') }}" alt="Imagen 1">
                    <img src="{{ asset('images/face.png') }}" alt="Imagen 2">
                    <img src="{{ asset('images/twit.png') }}" alt="Imagen 3">
                </div>
                <div class="horizontal-line-1"></div>
                <a href="#" class="w3-bar-item w3-button" style="text-decoration: none;">Contáctanos</a>
            </div>
        </div>
    </div>


    <div id="main">
        <div class="w3-teal" style="display: flex; align-items: center; padding: 0 15px;">
            <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
            <img src="{{ asset('images/ligaicono.png') }}" alt="Logo La Liga" class="title-logo" style="border: 2px solid red; margin-right: 20px;">
            <h1 class="roboto-flex-title" style="margin: 0 auto;">LALIGA EA SPORTS 2023-24</h1>
            @if($isUserLoggedIn)
            <div class="navbar-text" style="display: flex; align-items: center;">
                <div class="w3-dropdown-hover" id="userDropdown">
                    <button class="w3-button w3-bar-item" id="userButton">
                        <span>{{ Session::get('userName') }}</span>
                        <img src="{{ asset('images/usuario_r.png') }}" alt="Perfil" class="user-icon">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="w3-dropdown-content w3-bar-block w3-card" id="dropdownContent-cerrarSesion">
                        <a href="{{ route('confirmar.cerrar.sesion') }}" class="w3-bar-item w3-button" id="logoutButton">Cerrar sesión</a>
                    </div>
                </div>
            </div>
            @else
            <div class="navbar-text" style="display: flex; align-items: center;">
                <a type="button" class="btn btn-outline-light ml-auto" href="{{ route('register') }}">Registrarse</a>
                <a type="button" class="btn btn-light ml-2" href="{{ route('login') }}">Iniciar Sesión</a>
            </div>
            @endif

        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script>
        function w3_open() {
            document.getElementById("main").style.marginLeft = "15%";
            document.getElementById("mySidebar").style.width = "15%";
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("openNav").style.display = 'none';
        }

        function w3_close() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("openNav").style.display = "inline-block";
        }
    </script>