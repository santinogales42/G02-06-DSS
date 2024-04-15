@extends('layout')

@section('title', 'Calendario de Partidos')

@section('content')
    <h1 style="text-align: center; margin-top: 10px;">Calendario de Partidos</h1>
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
                            <td class="text-center">{{ $partido->fecha_nueva }}</td>
                            <td class="text-center">{{ $partido->hora_nueva }}</td>
                            <td class="text-center">{{ $partido->estadio }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-between">
                                    <div style="width: 45%; text-align: center;">
                                        <strong>{{ $partido->equipoLocal->nombre }}</strong>
                                    </div>
                                    <div style="width: 10%; text-align: center;">
                                        <span>{{ $partido->resultado }}</span>
                                    </div>
                                    <div style="width: 45%; text-align: center;">
                                        <strong>{{ $partido->equipoVisitante->nombre }}</strong>
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
