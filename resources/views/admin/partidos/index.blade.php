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
            <!-- Botón "Crear Partido" -->
            <a href="{{ route('admin.partidos.create') }}" class="btn btn-primary">Crear Partido</a>

            <!-- Formulario de filtrado por Jornada -->
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
            <table class="table table-striped">
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