
<!-- resources/views/clasificacion/index.blade.php -->

@extends('layout')

@section('title', 'Clasificación')

@extends('layout')

@section('title', 'La Liga')

@section('content')
    <h2>Clasificación</h2>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Pos</th>
                    <th>Equipo</th>
                    <th>PJ</th>
                    <th>PG</th>
                    <th>PE</th>
                    <th>PP</th>
                    <th>GF</th>
                    <th>GC</th>
                    <th>Pts</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipos as $index => $equipo)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $equipo->nombre }}</td>
                        <td>{{ $equipo->partidos_jugados }}</td>
                        <td>{{ $equipo->ganados }}</td>
                        <td>{{ $equipo->empatados }}</td>
                        <td>{{ $equipo->perdidos }}</td>
                        <td>{{ $equipo->goles_favor }}</td>
                        <td>{{ $equipo->goles_contra }}</td>
                        <td>{{ $equipo->puntos }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

