@extends('layout')

@section('content')
    @if(Session::has('success'))
        <script>
            window.onload = function() {
                alert("{{ Session::get('success') }}");
            };
        </script>
    @endif

    <div class="container mt-4" style="margin-bottom: 6rem;">
        <h2 class="text-center">Administración de Partidos</h2>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('admin.partidos.create') }}" class="btn btn-primary">Crear Partido</a>

            <div>
                <label class="mr-2">Seleccionar Jornada:</label>
                <select onchange="location = this.value;" class="jornada-actual">
                @foreach($jornadas as $jornada)
                    <option value="{{ route('admin.partidos.index', ['jornada' => $jornada]) }}" @if($jornada == $jornada_actual) selected @endif>
                        Jornada {{ $jornada }}
                    </option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Fecha</th>
                        <th scope="col" class="text-center">Hora</th>
                        <th scope="col" class="text-center">Partido</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($partidos as $index => $partido)
                        @php
                            $claseFila = $index % 2 == 0 ? 'fila-par' : 'fila-impar';
                        @endphp
                        <tr class="{{ $claseFila }}">
                            <td class="text-center">{{ $partido->fecha_nueva }}</td>
                            <td class="text-center">{{ $partido->hora_nueva }}</td>
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
                            <td class="text-center">
                                <a href="{{ route('admin.partidos.edit', ['id' => $partido->id]) }}" class="btn btn-primary" title="Editar">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('admin.partidos.delete', ['id' => $partido->id]) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este partido?')" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection