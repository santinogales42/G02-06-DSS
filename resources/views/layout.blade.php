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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px; /* Initially hidden */
            background-color: #ff3d36;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            z-index: 2;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: black;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

        .openbtn {
            font-size: 20px;
            width: 25px;
            cursor: pointer;
            background-color: transparent;
            color: white;
            padding: 10px 15px;
            border: none;
            position: absolute;
            top: 10px; /* Ajuste para mantener el botón en la parte superior */
            left: 6px; /* Ajuste para mantener el botón en la parte izquierda */
        }

        .openbtn:hover {
            background-color: transparent;
        }

        .openbtn span {
            display: block;
            width: 25px;
            height: 3px;
            margin: 5px auto;
            background-color: #fff;
        }

        .map-area {
            cursor: pointer;
        }

        .map-container {
            position: relative;
        }

        .map-area {
            position: absolute;
            display: block;
        }

        .navbar {
            background-color: #ff3d36;
            transition: all 0.3s ease;
            align-items: center;
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 1rem;
        }

        .navbar-brand {
            margin-left: 0px;
            margin-top: 7px;
            transition: all 0.3s ease;
            padding: 0.5em 3em;
        }

        .navbar-brand img {
            transition: all 0.3s ease;
            margin-left: 0px;
            display: block;
            max-width: 100px;
            height: auto;
        }

        .common-btn-style {
            font-size: 15px;
            letter-spacing: 2px;
            text-transform: uppercase;
            display: inline-block;
            text-align: center;
            font-weight: bold;
            padding: 0.8em 1.3em;
            border: 3px solid black;
            border-radius: 2px;
            position: relative;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.1);
            color: black;
            text-decoration: none;
            transition: all 0.3s ease;
            z-index: 1;
            border-radius: 15px;
            height: 55px;
        }

        .common-btn-style:before {
            transition: 0.5s all ease;
            position: absolute;
            top: 0;
            left: 50%;
            right: 50%;
            bottom: 0;
            opacity: 0;
            content: '';
            background-color: white;
            z-index: -1;
        }

        .common-btn-style:hover, .common-btn-style:focus {
            color: #ff3823;
        }

        .common-btn-style:hover:before, .common-btn-style:focus:before {
            transition: 0.5s all ease;
            left: 0;
            right: 0;
            opacity: 1;
            border-radius: 12px;
        }

        .common-btn-style:active {
            transform: scale(0.9);
        }

        .dropdown-menu {
            min-width: 10rem;
            padding: 0.5rem 0;
        }

        .dropdown-admin .dropdown-toggle:after {
            display: none;
        }

        .dropdown-menu-right {
            right: 0;
            left: auto;
        }

        #userDropdown {
            margin-left: 15px;
        }

        .user-icon {
            transition: filter 0.3s ease;
        }

        .title-container h1,
        .title-logo {
            display: inline-block;
            vertical-align: middle;
        }

        .title-logo {
            border: 2px solid red;
            margin-left: 0px; /* Distancia fija del menú de la hamburguesa */
            margin-right: 20px;
            max-width: 100px; /* Tamaño máximo para logo */
            flex-shrink: 0;
        }

        /* Overlay effect */
        .overlay {
            height: 100%;
            width: 0;
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgba(0,0,0,0.5);
            overflow-x: hidden;
            transition: 0.5s;
            z-index: 1;
        }

        @media (min-width: 769px) {
            .sidebar {
                left: 0;
                width: 250px;
            }

            #main {
                margin-left: 250px;
            }

            .overlay {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                height: auto;
            }

            .navbar-brand {
                margin-left: 0px; /* Fixed distance from the hamburger menu */
                padding: 0.5em 2em;
            }

            .navbar-brand img {
                width: 90px;
                height: auto;
            }

            .common-btn-style {
                font-size: 12px;
                padding: 0.5em 1em;
                height: auto;
            }

            .dropdown-admin .dropdown-toggle {
                font-size: 12px;
                padding: 0.5em 1em;
                height: auto;
            }
        }

        @media (max-width: 576px) {
            .navbar {
                height: auto;
            }

            .navbar-brand {
                margin-left: 0px; /* Fixed distance from the hamburger menu */
                padding: 0.5em 2em;
            }

            .navbar-brand img {
                width: 70px;
                height: auto;
            }

            .common-btn-style {
                font-size: 10px;
                padding: 0.4em 0.8em;
                height: auto;
            }

            .dropdown-admin .dropdown-toggle {
                font-size: 10px;
                padding: 0.4em 0.8em;
                height: auto;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                height: auto;
            }

            .navbar-brand {
                margin-left: 10px; /* Fixed distance from the hamburger menu */
            }

            .navbar-brand img {
                width: 50px;
                height: auto;
            }

            .common-btn-style {
                font-size: 8px;
                padding: 0.3em 0.6em;
                height: auto;
            }

            .dropdown-admin .dropdown-toggle {
                font-size: 8px;
                padding: 0.3em 0.6em;
                height: auto;
            }
        }
    </style>
</head>

<body>
    <div class="overlay" id="overlay" onclick="closeNav()"></div>
    <div class="banner container-fluid p-0 map-container">
        <img src="{{ asset('images/tims.png') }}" alt="Banner" class="img-fluid" usemap="#equiposMap" style="width:100%;">
        <map name="equiposMap">
            <area shape="rect" coords="50,50,150,150" href="https://www.athletic-club.eus/" alt="AthleticClub" target="_blank">
            <area shape="rect" coords="160,50,260,150" href="https://www.atleticodemadrid.com/" alt="AtleticoMadrid" target="_blank">
            <area shape="rect" coords="270,50,370,150" href="https://www.osasuna.es/" alt="Osasuna" target="_blank">
            <area shape="rect" coords="380,50,480,150" href="https://www.cadizcf.com/" alt="Cadiz" target="_blank">
            <area shape="rect" coords="490,50,590,150" href="https://www.deportivoalaves.com/es/" alt="Alaves" target="_blank">
            <area shape="rect" coords="600,50,700,150" href="https://www.fcbarcelona.es/es/" alt="Bcn" target="_blank">
            <area shape="rect" coords="710,50,810,150" href="https://www.getafecf.com/" alt="Getafe" target="_blank">
            <area shape="rect" coords="820,50,920,150" href="https://www.gironafc.cat/es" alt="Girona" target="_blank">
            <area shape="rect" coords="930,50,1030,150" href="https://www.granadacf.es/" alt="Granada" target="_blank">
            <area shape="rect" coords="1040,50,1140,150" href="https://www.rayovallecano.es" target="_blank">
            <area shape="rect" coords="1150,50,1250,150" href="https://rccelta.es/" alt="Celta" target="_blank">
            <area shape="rect" coords="1260,50,1360,150" href="https://www.rcdmallorca.es/" alt="Mallorca" target="_blank">
            <area shape="rect" coords="1370,50,1470,150" href="https://www.realbetisbalompie.es/" alt="Betis" target="_blank">
            <area shape="rect" coords="1480,50,1580,150" href="https://www.realmadrid.com/es-ES" alt="Madrid" target="_blank">
            <area shape="rect" coords="1590,50,1690,150" href="https://www.realsociedad.eus/" alt="RealSociedad" target="_blank">
            <area shape="rect" coords="1700,50,1800,150" href="https://sevillafc.es/" alt="Sevilla" target="_blank">
            <area shape="rect" coords="1810,50,1910,150" href="https://www.udalmeriasad.com/" alt="Almeria" target="_blank">
            <area shape="rect" coords="1920,50,2020,150" href="https://www.udlaspalmas.es/" alt="LasPalmas" target="_blank">
            <area shape="rect" coords="2030,50,2130,150" href="https://www.valenciacf.com/" alt="Valencia" target="_blank">
            <area shape="rect" coords="2140,50,2240,150" href="https://villarrealcf.es/" alt="Villarreal" target="_blank">
        </map>
    </div>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Inicio</a>
        <a href="{{ route('noticias') }}"><i class="fa-solid fa-newspaper"></i> Noticias</a>
        <a href="{{ route('equipos.index') }}"><i class="fa-solid fa-users"></i> Equipos</a>
        <a href="{{ route('jugadores') }}"><i class="fa-solid fa-user"></i> Jugadores</a>
        <a href="{{ route('calendario.index') }}"><i class="fa-regular fa-calendar fa-lg"></i> Calendario</a>
        <a href="{{ route('threads.index') }}"><i class="fa-solid fa-hashtag"></i> Foro</a>
        <a href="{{ route('clasificacion') }}"><i class="fa-solid fa-chart-line"></i> Clasificación</a>
        @auth
        @if(Auth::user()->isAdmin)
        <a href="{{ route('admin.index') }}"><i class="fa-solid fa-wrench"></i> Admin</a>
        @endif
        @endauth
        <div class="contenedor-imagenes">
            <img src="{{ asset('images/insta.png') }}" alt="Imagen 1" class="img-fluid">
            <img src="{{ asset('images/face.png') }}" alt="Imagen 2" class="img-fluid">
            <img src="{{ asset('images/twit.png') }}" alt="Imagen 3" class="img-fluid">
        </div>
    </div>

    <div id="main">
        
        <nav class="navbar navbar-light">
            <div style="width:27.5%">
                <button class="openbtn" onclick="openNav()">&#9776;</button>
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/ligaicono.png') }}" alt="Logo La Liga" class="title-logo img-fluid">
                </a>
            </div>
            <h1 class="roboto-flex-title flex-grow-1 text-center d-none d-md-block">LALIGA EA SPORTS 2023-24</h1>
            <a href="{{ route('contacto') }}" style="padding: 1em;" class="btn common-btn-style ml-3">Contáctanos</a>
            @if($isUserLoggedIn)
            <div class="navbar-text d-flex align-items-center dropdown-admin">
                <div class="dropdown" id="userDropdown">
                    <button class="btn common-btn-style dropdown-toggle" id="userButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span>{{ Session::get('userName') }}</span>
                        <img src="{{ asset('images/usuario_r.png') }}" alt="Perfil" class="user-icon img-fluid" style="margin-left: 5px; filter: invert(100%);">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userButton">
                        <a href="{{ route('perfilUsuario.index') }}" class="dropdown-item">Mi Perfil</a>
                        <a href="{{ route('favoritos.index') }}" class="dropdown-item">Favoritos</a>
                        <a href="{{ route('confirmar.cerrar.sesion') }}" class="dropdown-item" id="logoutButton">Cerrar sesión</a>
                    </div>
                </div>
            </div>
            @else
            <div class="navbar-text d-flex align-items-center">
                <a class="btn common-btn-style ml-auto" href="{{ route('register') }}" style="padding: 1em;">Registrarse</a>
                <a class="btn common-btn-style ml-2" href="{{ route('login') }}" style="padding: 1em;">Iniciar Sesión</a>
            </div>
            @endif
        </nav>

        <div class="content container mt-4">
            @yield('content')
        </div>
    </div>

    <script>
        function openNav() {
            if (window.innerWidth <= 768) {
                document.getElementById("mySidebar").style.left = "0";
                document.getElementById("overlay").style.width = "100%";
            } else {
                document.getElementById("mySidebar").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
                document.getElementById("overlay").style.width = "0";
            }
        }

        function closeNav() {
            if (window.innerWidth <= 768) {
                document.getElementById("mySidebar").style.left = "-250px";
                document.getElementById("overlay").style.width = "0";
            } else {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
            }
        }

        window.addEventListener("resize", function() {
            if (window.innerWidth > 768) {
                document.getElementById("mySidebar").style.left = "0";
                document.getElementById("mySidebar").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
                document.getElementById("overlay").style.width = "0";
            } else {
                document.getElementById("mySidebar").style.left = "-250px";
                document.getElementById("mySidebar").style.width = "250px";
                document.getElementById("main").style.marginLeft = "0";
            }
        });
    </script>
</body>

</html>
