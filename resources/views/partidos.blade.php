@extends('layout')

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background-color: #333333; color: #ffffff;">
        <div class="container-fluid">
            <div class="display-4 font-weight-bold text-center">
                <img src="{{ asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoLocal->nombre))) . '.png') }}" alt="{{ $partido->equipoLocal->nombre }}" style="width: 100px; height: auto;" class="me-2">
                <strong style="font-size: 30px;">{{ $partido->equipoLocal->nombre }}</strong>

                <span class="mx-3" style="font-size: 24px;">{{ $partido->resultado }}</span>

                <strong style="font-size: 24px;">{{ $partido->equipoVisitante->nombre }}</strong>
                <img src="{{ asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoVisitante->nombre))) . '.png') }}" alt="{{ $partido->equipoVisitante->nombre }}" style="width: 100px; height: auto;" class="ms-2">

                <p style="font-size: 18px;">{{ $partido->fecha_nueva }} {{ $partido->hora_nueva }}</p>
                <p style="font-size: 18px;"> {{ $partido->estadio }}</p>
                @if ($partido->resultado == '-')
                    <p style="font-size: 18px;">Estado: Sin Empezar</p>
                @else
                    <p style="font-size: 18px;">Estado: Finalizado</p>
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="{{ asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoLocal->nombre))) . '.png') }}" alt="{{ $partido->equipoLocal->nombre }}" style="width: 50px; height: auto;" class="me-2">
                        <strong>{{ $partido->equipoLocal->nombre }}</strong>
                    </div>
                    <div class="card-body">
                        <p>Goles: {{ $estPartido->goles_local }}</p>
                        <p>Amarillas: {{ $estPartido->amarillas }}</p>
                        <p>Rojas: {{ $estPartido->rojas }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="{{ asset('images/equipos/' . strtolower(str_replace(' ', '', Str::ascii($partido->equipoVisitante->nombre))) . '.png') }}" alt="{{ $partido->equipoVisitante->nombre }}" style="width: 50px; height: auto;" class="me-2">
                        <strong>{{ $partido->equipoVisitante->nombre }}</strong>
                    </div>
                    <div class="card-body">
                        <p>Goles: {{ $estPartido->goles_visitante }}</p>
                        <p>Amarillas: {{ $estPartido->amarillas }}</p>
                        <p>Rojas: {{ $estPartido->rojas }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection