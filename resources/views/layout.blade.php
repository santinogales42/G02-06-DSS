<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LALIGA EA SPORTS 2023-24</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hurricane&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">


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


</div>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
    <!-- Botón de flecha para cerrar la barra lateral -->
    <div class="row">
        <div class="col-12">
            <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
        </div>
    </div>
    <div class="row">
    <div class="col-12">
        <a href="#" class="w3-bar-item w3-button">Noticias</a>
    </div>
</div>
    <div class="row">
        <div class="col-12">
            <a href="#" class="w3-bar-item w3-button">Jugadores</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="#" class="w3-bar-item w3-button">Calendario</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="#" class="w3-bar-item w3-button">Clasificación</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="#" class="w3-bar-item w3-button">Favoritos</a>
        </div>
    </div>
    <div class="w3-dropdown-hover w3-hover-white">
    <button class="w3-button w3-bar-item w3-hover-white">Admin <i class="fa fa-caret-down w3-hover-white"></i></button>
    <div class="w3-dropdown-content w3-bar-block ">
      <a href="#" class="w3-bar-item w3-button w3-red">Jugadores</a>
      <a href="#" class="w3-bar-item w3-button w3-red">Usuarios</a>
    </div>
  </div>
    <!-- Enlaces en la parte inferior de la barra lateral -->
    
        
        <div class="bottom-links">
            <a href="#" class="w3-bar-item w3-button">Contáctanos</a>
             <a href="#" class="w3-bar-item w3-button">Cerrar sesión</a>
            </div>
       
    
        
        
    
</div>


<div id="main">
    <div class="w3-teal" style="display: flex; align-items: center; padding: 0 15px;">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <img src="{{ asset('images/ligaicono.png') }}" alt="Logo La Liga" class="title-logo" style="border: 2px solid red; margin-right: 20px;">
        <h1 class="roboto-flex-title" style="margin: 0 auto;">LALIGA EA SPORTS 2023-24</h1>
        @if($isUserLoggedIn)
        <div class="navbar-text" style="display: flex; align-items: center;">
            <span>{{ $userName }}</span>
            <img src="{{ asset('images/usuario_r.png') }}" alt="Perfil" style="width: 30px; height: 30px; margin-left: 10px;">
        </div>
        @else
        <div class="navbar-text" style="display: flex; align-items: center;">
            <button type="button" class="btn btn-outline-light ml-auto">Registrarse</button>
            <button type="button" class="btn btn-light ml-2">Iniciar Sesión</button>
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


