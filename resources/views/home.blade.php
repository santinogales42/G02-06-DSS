@extends('layout')

@section('title', 'Home')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h2 class="mt-4">Noticias</h2>
            <div class="news-section">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title">¿Por qué la Superliga genera tanta incertidumbre en el modelo europeo del fútbol?</h3>
                        <p class="card-text">La Superliga ha quedado vista para sentencia. Todo lo que no sea un modelo totalmente abierto, con acceso a todas las competiciones europeas, temporada a temporada, es un formato cerrado, contrario a los valores europeos del deporte. La Liga pide a la Comisión Europea medidas legislativas para proteger la estabilidad y futuro del fútbol europeo.</p>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title">¿Por qué la Superliga genera tanta incertidumbre en el modelo europeo del fútbol?</h3>
                        <p class="card-text">La Superliga ha quedado vista para sentencia. Todo lo que no sea un modelo totalmente abierto, con acceso a todas las competiciones europeas, temporada a temporada, es un formato cerrado, contrario a los valores europeos del deporte. La Liga pide a la Comisión Europea medidas legislativas para proteger la estabilidad y futuro del fútbol europeo.</p>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="col-md-4">
    <h2 class="mt-4">Clasificación</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">Posición</th>
                    <th>Equipo</th>
                    <th class="text-center">Puntos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipos as $index => $equipo)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                @php
                                    $nombreLimpio = Str::ascii($equipo->nombre);
                                    $nombreArchivo = strtolower(str_replace(' ', '', $nombreLimpio)) . '.png';
                                @endphp
                                <img src="{{ asset('images/equipos/' . $nombreArchivo) }}" alt="{{ $equipo->nombre }}" style="width: 30px; height: auto;" class="me-2">
                                {{ $equipo->nombre }}
                            </div>
                        </td>
                        <td class="text-center">{{ $equipo->puntos }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>


@endsection
