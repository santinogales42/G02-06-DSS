@extends('layout')

@section('title', 'Home')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Sección de Noticias -->
        <div class="col-md-8">
            <h2>Noticias</h2>
            <div class="news-section">
<!--                @foreach ($news as $newsItem)
                    <article>
                        <h3>{{ $newsItem->title }}</h3>
                        <p>{{ $newsItem->content }}</p>
                    </article>
                @endforeach-->
                <h3>¿POR QUÉ LA SUPERLIGA GENERA TANTA INCERTIDUMBRE EN EL MODELO EUROPEO DEL FÚTBOL?</h3>
                <p>La Superliga ha quedado vista para sentencia. Todo lo que no sea un modelo totalmente abierto, 
                    con acceso a todas las competiciones europeas, temporada a temporada, es un formato cerrado, 
                    contrario a los valores europeos del deporte. LALIGA pide a la Comisión Europea medidas legislativas 
                    para proteger la estabilidad y futuro del fútbol europeo.</p>
                    <h3>¿POR QUÉ LA SUPERLIGA GENERA TANTA INCERTIDUMBRE EN EL MODELO EUROPEO DEL FÚTBOL?</h3>
                <p>La Superliga ha quedado vista para sentencia. Todo lo que no sea un modelo totalmente abierto, 
                    con acceso a todas las competiciones europeas, temporada a temporada, es un formato cerrado, 
                    contrario a los valores europeos del deporte. LALIGA pide a la Comisión Europea medidas legislativas 
                    para proteger la estabilidad y futuro del fútbol europeo.</p>
            </div>
        </div>
        
        <!-- Sección de Clasificación -->
        <div class="col-md-4">
            <h2>Clasificación</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Equipo</th>
                        <th>Puntos</th>
                    </tr>
                </thead>
                <tbody>

                    <!--@foreach ($classification as $index => $team)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $team->foto }}</td>
                            <td>{{ $team->nombre }}</td>
                            <td>{{ $team->puntos }}</td>
                        </tr>
                    @endforeach-->
                    <tr>
                    <td>1</td>
                        <td><div class="row align-items-center">
                            <div class="col-auto">
                                <img src="{{ asset('images/ligaicono.png') }}" alt="Logo La Liga" style="width: 30px; height: auto;">
                            </div>
                            <div class="col">
                                Villareal
                            </div>
                        </div>
                        </td>
                        <td>70</td>
                    </tr>
                    <tr>
                    <td>2</td>
                        <td><div class="row align-items-center">
                            <div class="col-auto">
                                <img src="{{ asset('images/ligaicono.png') }}" alt="Logo La Liga" style="width: 30px; height: auto;">
                            </div>
                            <div class="col">
                                Osasuna
                            </div>
                        </div>
                        </td>
                        <td>67</td>
                    </tr>
                    <tr>
                    <td>1</td>
                        <td><div class="row align-items-center">
                            <div class="col-auto">
                                <img src="{{ asset('images/ligaicono.png') }}" alt="Logo La Liga" style="width: 30px; height: auto;">
                            </div>
                            <div class="col">
                                Real Sociedad
                            </div>
                        </div>
                        </td>
                        <td>50</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
