@extends('layout')

@section('content')
    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <h2>Modificar o Eliminar Partido</h2>

        <!-- Formulario para buscar partido por equipos -->
        <form action="{{ route('admin.partidos.search') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="equipo_local" class="form-label">Equipo Local</label>
                <select class="form-control" id="equipo_local" name="equipo_local" required>
                    <option value="">Selecciona un equipo local</option>
                    @foreach ($equipos as $equipo)
                        <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="equipo_visitante" class="form-label">Equipo Visitante</label>
                <select class="form-control" id="equipo_visitante" name="equipo_visitante" required>
                    <option value="">Selecciona un equipo visitante</option>
                    @foreach ($equipos as $equipo)
                        <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Buscar Partido</button>
            <a href="{{ route('admin.partidos.index') }}" class="btn btn-secondary">Volver</a>
        </form>


        <hr>

        <!-- Mostrar detalles del partido si existe -->
        @if(isset($partido))
            <h3>Detalles del Partido</h3>
            <form action="{{ route('admin.partidos.update', ['id' => $partido->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $partido->fecha }}">
                </div>
                <div class="form-group">
                    <label for="hora">Hora:</label>
                    <input type="time" name="hora" id="hora" class="form-control" value="{{ $partido->hora }}">
                </div>
                <div class="form-group">
                    <label for="estadio">Estadio:</label>
                    <input type="text" name="estadio" id="estadio" class="form-control" value="{{ $partido->estadio }}">
                </div>
                <div class="form-group">
                    <label for="resultado">Resultado:</label>
                    <input type="text" name="resultado" id="resultado" class="form-control" value="{{ old('resultado', $partido->resultado) }}">
                    @error('resultado')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jornada">Jornada:</label>
                    <select name="jornada" id="jornada" class="form-control">
                        @for ($i = 1; $i <= 38; $i++)
                            <option value="{{ $i }}" {{ $partido->jornada == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="equipo_local">Equipo Local:</label>
                    <select name="equipo_local" id="equipo_local" class="form-control">
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}" {{ $partido->equipo_local_id == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="equipo_visitante">Equipo Visitante:</label>
                    <select name="equipo_visitante" id="equipo_visitante" class="form-control">
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}" {{ $partido->equipo_visitante_id == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
            
            <br>
            
            <!-- Formulario para eliminar partido -->
            <form action="{{ route('admin.partidos.delete', ['id' => $partido->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este partido?')">Eliminar</button>
            </form>
        @else
            @if(session('error'))
                <div class="alert alert-danger">
                    <p>No se encontró ningún partido con los equipos seleccionados.</p>
                </div>
            @endif
        @endif
    </div>
@endsection
