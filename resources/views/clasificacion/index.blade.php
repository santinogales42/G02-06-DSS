@extends('layout')

@section('title', 'Clasificación')

@section('content')
    <h2 class="text-center display-4">Clasificación</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="width: 60%; margin: auto;">
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
                    <th>Dif</th>
                    <th>Pts</th>
                    <th class = 'text-center'>Estado</th> <!-- Nueva columna para el estado -->
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
                        <td>{{ $equipo->goles_favor - $equipo->goles_contra }}</td>
                        <td>{{ $equipo->puntos }}</td>
                        <td class = 'text-center'>
                            @if($index < 4)
                                <span class="badge badge-primary">Champions</span>
                            @elseif($index == 4)
                                <span class="badge badge-warning">Europa League</span>
                            @elseif($index == 5)
                                <span class="badge badge-success">Conference League</span>
                            @elseif($index >= count($equipos) - 3)
                                <span class="badge badge-danger">Descendido</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
