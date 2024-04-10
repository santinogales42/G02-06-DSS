<!-- resources/views/jugadores.blade.php -->
@extends('layout')

@section('title', 'La Liga')

@section('content')
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias - Liga de Fútbol</title>
    <link rel="stylesheet" href="{asset('css/app.css')}"> <!-- Asegúrate de que el enlace al archivo CSS sea correcto -->
</head>
<body>
    <div class="contenedor-noticias">
        <div class="container">
            <h1>Noticias</h1>
            <div class="noticia">
                <h2><a href="https://www.google.com/url?sa=t&source=web&rct=j&opi=89978449&url=https://www.marca.com/futbol/mallorca/2024/04/10/66163cc546163f16608b4581.html&ved=2ahUKEwib0cHIlLeFAxWaV6QEHa5iCBkQxfQBegQIABAE&usg=AOvVaw2SmO6ueSUAXoA0jAUbuZou">El Mallorca activa el modo liga: en busca de una permanencia tranquila</a></h2>
                <img src="https://s1.elespanol.com/2023/05/25/deportes/futbol/766434171_233445124_1706x960.jpg">
                <p class="descripcion">Al equipo de Aguirre le vienen cuatro encuentros complicados que determinarán si conseguirá una permanencia tranquila o sufrida.</p>
                <div class="noticia-info-extra">
                        <p class="noticia-autor">Marca.com</p>
                        <p class="noticia-fecha">10 de abril de 2024</p>
                </div>
            </div>

            <div class="noticia">
                <h2><a href="https://www.vamosmisevillafc.com/pape-gueye-regresara-a-laliga/">Pape Gueye regresará a LaLiga</a></h2>
                <img src="https://www.vamosmisevillafc.com/wp-content/uploads/2023/01/las-claves-para-el-fichaje-de-pa.jpg" alt="Imagen de la Noticia 2">
                <p class="descripcion">Tras pasar los 4 meses de sanción por romper un contrato firmado, está cuajando una buena temporada en el Olympique de Marsella, con opciones de entrar en competición europea.</p>
                <div class="noticia-info-extra">
                        <p class="noticia-autor">Vamos Mi Sevilla</p>
                        <p class="noticia-fecha">9 de abril de 2024</p>
                </div>
             </div>

            <div class="noticia">
                <h2><a href="https://www.vamosmisevillafc.com/pape-gueye-regresara-a-laliga/">Estos son los jugadores de LaLiga que acaban contrato este verano</a></h2>
                <img src="https://estaticos-cdn.prensaiberica.es/clip/ae0cda80-7e86-452f-a1ba-323e83359c0d_16-9-discover-aspect-ratio_default_0.jpg">
                <p class="descripcion">Muchos futbolistas quedarán libres a final de temporada y se convertirán en agentes libres para firmar por el equipo que deseen.</p>
                <div class="noticia-info-extra">
                        <p class="noticia-autor">Superdeporte</p>
                        <p class="noticia-fecha">9 de abril de 2024</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
