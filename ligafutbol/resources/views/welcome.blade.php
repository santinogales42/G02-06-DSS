<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Liga</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Incluir tu archivo CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
    <a href="#" class="w3-bar-item w3-button">Noticias</a>
    <a href="#" class="w3-bar-item w3-button">Jugadores</a>
    <a href="#" class="w3-bar-item w3-button">Calendario</a>
    <a href="#" class="w3-bar-item w3-button">Clasificación</a>
    <a href="#" class="w3-bar-item w3-button">Favoritos</a>
    <div class="bottom-links">
        <a href="#" class="w3-bar-item w3-button">Contáctanos</a>
        <a href="#" class="w3-bar-item w3-button">Cerrar sesión</a>
    </div>
</div>

<div id="main">
    <div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
        <div class="w3-container">
            <h1>La Liga</h1>
        </div>
    </div>
</div>

<script>
    function w3_open() {
        document.getElementById("main").style.marginLeft = "25%";
        document.getElementById("mySidebar").style.width = "25%";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("openNav").style.display = 'none';
    }

    function w3_close() {
        document.getElementById("main").style.marginLeft = "0%";
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
    }
</script>

</body>
</html>

