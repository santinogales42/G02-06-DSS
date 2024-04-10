@extends('layout')

@section('title', 'Calendario de Partidos')

@section('content')
    <h1 style="text-align: center; margin-top: 10px;">Calendario de Partidos</h1>

    <div class="jornada-navegacion">
    <a href="{{ route('calendario', ['jornada' => $jornada_actual - 1]) }}" class="jornada-anterior">Jornada Anterior</a>
        <select onchange="location = this.value;" class="jornada-actual">
            @foreach($jornadas as $jornada)
                <option value="{{ route('calendario', ['jornada' => $jornada]) }}" @if($jornada == $jornada_actual) selected @endif>
                    Jornada {{ $jornada }}
                </option>
            @endforeach
        </select>
        <a href="{{ route('calendario', ['jornada' => $jornada_actual + 1]) }}" class="jornada-siguiente">Jornada Siguiente</a>
    </div>

    <div class="tabla-calendario">
        <div class="fila-partidos-head">
            <div class="columna-fecha">
                Fecha
            </div>
            <div class="columna-hora">
                Hora
            </div>
            <div class="columna-resultado">
                Partido
            </div>
        </div>

        @foreach($partidos as $index => $partido)
            @php
                $claseFila = $index % 2 == 0 ? 'fila-par' : 'fila-impar';
            @endphp
            <div class="fila-partido {{ $claseFila }}">
                <div class="columna-fecha">
                    {{ $partido->fecha }}
                </div>
                <div class="columna-hora">
                    {{ $partido->hora }}
                </div>
                <div class="columna-resultado">
                    <strong>{{ $partido->equipoLocal->nombre }}</strong>
                    <span class="resultado">{{ $partido->resultado }}</span>
                    <strong>{{ $partido->equipoVisitante->nombre }}</strong>
                </div>
            </div>
        @endforeach
    </div>
@endsection
