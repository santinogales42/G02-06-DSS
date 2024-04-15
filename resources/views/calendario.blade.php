@extends('layout')

@section('title', 'Calendario de Partidos')

@section('content')
    <div class="jumbotron jumbotron-fluid" style="background-color: #333333; color: #ffffff;">
        <div class="container-fluid">
            <h1 class="display-4 font-weight-bold text-center" style="font-size: 2.5rem;">Calendario de La Liga 2023/24</h1>
        </div>
    </div>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('calendario', ['jornada' => $jornada_actual - 1]) }}" class="jornada-anterior">
                <i class="fas fa-arrow-left"></i>
            </a>
            <select onchange="location = this.value;" class="jornada-actual">
                @foreach($jornadas as $jornada)
                    <option value="{{ route('calendario', ['jornada' => $jornada]) }}" @if($jornada == $jornada_actual) selected @endif>
                        Jornada {{ $jornada }}
                    </option>
                @endforeach
            </select>
            <a href="{{ route('calendario', ['jornada' => $jornada_actual + 1]) }}" class="jornada-siguiente">
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Fecha</th>
                        <th scope="col" class="text-center">Hora</th>
                        <th scope="col" class="text-center">Estadio</th>
                        <th scope="col" class="text-center">Partido</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($partidos as $index => $partido)
                        @php
                            $claseFila = $index % 2 == 0 ? 'fila-par' : 'fila-impar';
                        @endphp
                        <tr class="{{ $claseFila }}">
                            <td class="text-center">
                                {{ $partido->fecha_nueva }}
                            </td>
                            <td class="text-center">{{ $partido->hora_nueva }}</td>
                            <td class="text-center">{{ $partido->estadio }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col text-end me-2">
                                        @php
                                            $nombreLimpioLocal = Str::ascii($partido->equipoLocal->nombre);
                                            $nombreArchivoLocal = strtolower(str_replace(' ', '', $nombreLimpioLocal)) . '.png';
                                        @endphp
                                        <img src="{{ asset('images/equipos/' . $nombreArchivoLocal) }}" alt="{{ $partido->equipoLocal->nombre }}" style="width: 30px; height: auto;" class="me-2">
                                        <strong>{{ $partido->equipoLocal->nombre }}</strong>
                                    </div>
                                    <div class="col-auto text-center">
                                        <span>{{ $partido->resultado }}</span>
                                    </div>
                                    <div class="col text-start ms-2">
                                        <strong>{{ $partido->equipoVisitante->nombre }}</strong>
                                        @php
                                            $nombreLimpioVisitante = Str::ascii($partido->equipoVisitante->nombre);
                                            $nombreArchivoVisitante = strtolower(str_replace(' ', '', $nombreLimpioVisitante)) . '.png';
                                        @endphp
                                        <img src="{{ asset('images/equipos/' . $nombreArchivoVisitante) }}" alt="{{ $partido->equipoVisitante->nombre }}" style="width: 30px; height: auto;" class="me-2">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
