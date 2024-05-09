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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <!-- Incluir Bootstrap JS (asegúrate de que coincida con la versión de Bootstrap CSS) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
<div class="banner">
    <img src="{{ asset('images/tims.png') }}" alt="Banner" usemap="#equiposMap" style="width:100%;">
    <map name="equiposMap">
    <area shape="rect" href="https://www.athletic-club.eus/" alt="AthleticClub" target="_blank">
    <area shape="rect" href="https://www.atleticodemadrid.com/" alt="AtleticoMadrid" target="_blank">
    <area shape="rect" href="https://www.osasuna.es/" alt="Osasuna" target="_blank">
    <area shape="rect" href="https://www.cadizcf.com/" alt="Cadiz" target="_blank">
    <area shape="rect" href="https://www.deportivoalaves.com/es/" alt="Alaves" target="_blank">
    <area shape="rect" href="https://www.fcbarcelona.es/es/" alt="Bcn" target="_blank">
    <area shape="rect" href="https://www.getafecf.com/" alt="Getafe" target="_blank">
    <area shape="rect" href="https://www.gironafc.cat/es" alt="Girona" target="_blank">
    <area shape="rect" href="https://www.granadacf.es/" alt="Granada" target="_blank">
    <area shape="rect" href="https://www.rayovallecano.es" alt="Rayo" target="_blank">
    <area shape="rect" href="https://rccelta.es/" alt="Celta" target="_blank">
    <area shape="rect" href="https://www.rcdmallorca.es/" alt="Mallorca" target="_blank">
    <area shape="rect" href="https://www.realbetisbalompie.es/" alt="Betis" target="_blank">
    <area shape="rect" href="https://www.realmadrid.com/es-ES" alt="Madrid" target="_blank">
    <area shape="rect" href="https://www.realsociedad.eus/" alt="RealSociedad" target="_blank">
    <area shape="rect" href="https://sevillafc.es/" alt="Sevilla" target="_blank">
    <area shape="rect" href="https://www.udalmeriasad.com/" alt="Almeria" target="_blank">
    <area shape="rect" href="https://www.udlaspalmas.es/" alt="LasPalmas" target="_blank">
    <area shape="rect" href="https://www.valenciacf.com/" alt="Valencia" target="_blank">
    <area shape="rect" href="https://villarrealcf.es/" alt="Villarreal" target="_blank">
</map>

    </div>

    <div class="w3-sidebar w3-card w3-animate-left" style="display:none" id="mySidebar">
    <div class="SidebarSection">
        <button class="w3-bar-item w3-button w3-large" style="text-decoration: none; margin-left: 20px; margin-right: 20px; margin-bottom: 40px;" onclick="w3_close()">Close &times;</button>
        
        <a href="{{ route('home') }}" class="w3-bar-item w3-button icon-link" style="text-decoration: none; margin-left: 20px; margin-right: 20px;">
            <i class="fa-solid fa-house"></i> Inicio
        </a>
        <a href="{{ route('noticias') }}" class="w3-bar-item w3-button icon-link" style="text-decoration: none; margin-left: 20px; margin-right: 20px;">
            <i class="fa-solid fa-newspaper"></i> Noticias
        </a>
        <a href="{{ route('equipos.index') }}" class="w3-bar-item w3-button icon-link" style="text-decoration: none; margin-left: 20px; margin-right: 20px;">
            <i class="fa-solid fa-users"></i> Equipos
        </a>
        <a href="{{ route('jugadores') }}" class="w3-bar-item w3-button icon-link" style="text-decoration: none; margin-left: 20px; margin-right: 20px;">
            <i class="fa-solid fa-user"></i> Jugadores
        </a>
        <a href="{{ route('calendario.index') }}" class="w3-bar-item w3-button icon-link" style="text-decoration: none; margin-left: 20px; margin-right: 20px;">
            <i class="fa-regular fa-calendar fa-lg"></i> Calendario
        </a>
        <a href="{{ route('threads.index') }}" class="w3-bar-item w3-button icon-link" style="text-decoration: none; margin-left: 20px; margin-right: 20px;">
            <i class="fa-solid fa-hashtag"></i> Foro
        </a>
        
        <a href="{{ route('clasificacion') }}" class="w3-bar-item w3-button icon-link"  style="text-decoration: none; margin-left: 20px; margin-right: 20px;">
            <i class="fa-solid fa-chart-line"></i> Clasificación
        </a> @auth
            @if(Auth::user()->isAdmin)
            <div class="w3-dropdown-hover w3-bar-item w3-hover-white" style="text-decoration: none; margin-left: 20px; margin-right: 20px;">
                <button class="w3-button icon-link  " ><i class="fa-solid fa-wrench"></i>Admin  <i class="fas fa-chevron-down"></i> </button>
                <div class="w3-dropdown-content w3-bar-block w3-card " >
                    <a href="{{ route('admin.adminjugador') }}" class="w3-bar-item w3-button  icon-link">Jugadores</a>
                    <a href="{{ route('admin.usuarios.index') }}" class="w3-bar-item w3-button icon-link">Usuarios</a>
                    <a href="{{ route('admin.noticias.index') }}" class="w3-bar-item w3-button icon-link">Noticias</a>
                    <a href="{{ route('admin.partidos.index') }}" class="w3-bar-item w3-button icon-link">Partidos</a>
                    <a href="{{ route('admin.equipos.index') }}" class="w3-bar-item w3-button icon-link">Equipos</a>
                    <a href="{{ route('mostrarMensajes') }}" class="w3-bar-item w3-button icon-link">Mensajes</a>
                
                </div>
            </div>
            @endif
@endauth
            <!-- Enlaces en la parte inferior de la barra lateral -->
            <div class="SidebarDownSection">
                
                <div class="contenedor-imagenes">
                    <img src="{{ asset('images/insta.png') }}" alt="Imagen 1">
                    <img src="{{ asset('images/face.png') }}" alt="Imagen 2">
                    <img src="{{ asset('images/twit.png') }}" alt="Imagen 3">
                </div>
                

               </div>
      <a href="{{ route('contacto') }}" class="w3-bar-item w3-button icon-link" style="text-decoration: none; margin-left: 20px; margin-right: 20px;">Contáctanos</a>
            </div>

        </div>
    </div>


    <div id="main">
    <header class="w3-teal" style="display: flex; align-items: center; padding: 0 15px;">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <img src="{{ asset('images/ligaicono.png') }}" alt="Logo La Liga" class="title-logo" style="border: 2px solid red; margin-right: 20px; flex-shrink: 0;">
        <h1 class="roboto-flex-title" style="flex-grow: 1; text-align: center;">LALIGA EA SPORTS 2023-24</h1>
        <a href="{{ route('contacto') }}" class=" w3-bar-item w3-button icon-link " style="text-decoration: none;">Contáctanos</a>
            
        @if($isUserLoggedIn)
        <div class="navbar-text" style="display: flex; align-items: center;">
            <div class="w3-dropdown-hover" id="userDropdown">
                <button class="w3-button w3-bar-item" id="userButton">
                    <span>{{ Session::get('userName') }}</span>
                    <img src="{{ asset('images/usuario_r.png') }}" alt="Perfil" class="user-icon">
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="w3-dropdown-content w3-bar-block w3-card" id="dropdownContent-cerrarSesion">

                    <a href="{{ route('favoritos.index') }}" class="w3-bar-item w3-button icon-link">Favoritos</a>
                    <a href="{{ route('confirmar.cerrar.sesion') }}" class="w3-bar-item w3-button icon-link" id="logoutButton">Cerrar sesión</a>

                        <a href="{{ route('perfilUsuario.index') }}" class="w3-bar-item w3-button" style="text-decoration: none;">Mi Perfil</a>
                    <a href="{{ route('favoritos.index') }}" class="w3-bar-item w3-button">Favoritos</a>
                    <a href="{{ route('confirmar.cerrar.sesion') }}" class="w3-bar-item w3-button" id="logoutButton">Cerrar sesión</a>

                </div>
            </div>
        </div>
        @else
        
        <div class="navbar-text" style="display: flex; align-items: center;">
            <a class="btn btn-outline-light ml-auto" href="{{ route('register') }}">Registrarse</a>
            <a class="btn btn-light ml-2" href="{{ route('login') }}">Iniciar Sesión</a>
        </div>
        @endif
    </header>
    <div class="content">
        @yield('content')
    </div>
</div>


    <script>
        
window.onload = function() {
    var image = document.querySelector('.banner img');
    var areas = document.querySelectorAll('map[name="equiposMap"] area');
    var numLinks = areas.length;
    var width = image.clientWidth;

    areas.forEach(function(area, index) {
        var x1 = Math.round(width * index / numLinks);
        var x2 = Math.round(width * (index + 1) / numLinks);
        area.coords = `${x1},0,${x2},47`;  // Ajusta la coordenada Y según sea necesario
    });
};

window.onresize = function() {
    // Repite el código de ajuste cuando la ventana cambie de tamaño
    var image = document.querySelector('.banner img');
    var areas = document.querySelectorAll('map[name="equiposMap"] area');
    var numLinks = areas.length;
    var width = image.clientWidth;

    areas.forEach(function(area, index) {
        var x1 = Math.round(width * index / numLinks);
        var x2 = Math.round(width * (index + 1) / numLinks);
        area.coords = `${x1},0,${x2},47`;
    });
};

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
