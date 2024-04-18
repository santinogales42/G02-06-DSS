@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 position-relative">
            <!-- Formulario de búsqueda -->
            <form action="{{ route('admin.usuarios.index') }}" method="GET" class="mb-3 d-flex justify-content-end">
                <input type="text" name="salida" class="buscador" placeholder="Buscar por nombre o correo" value="{{ request('salida') }}">
                <button type="submit" class="btn boton-buscar">Buscar</button>
            </form>

            <!-- Tarjeta de agregar usuarios -->
            <div class="tarjeta-agregar-usuarios mb-3">
                <a href="{{ route('admin.usuarios.create') }}" class="btn boton-agregar">Agregar Usuario</a>
            </div>

            <!-- Tarjeta de usuarios -->
            <div class="tarjeta mb-3">
                <div class="encabezado-tarjeta-usuarios">Lista de Usuarios</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr style="margin-bottom: auto;">
                                <th>
                                    <button id="ordenarNombre" class="btn boton-nombre">Nombre</button>
                                </th>
                                <th>Correo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="btn boton-editar">
                                        <i class="fas fa-pencil-alt"></i> <!-- Ícono de lápiz -->
                                    </a>
                                    <form action="{{ route('admin.usuarios.destroy', ['id' => $usuario->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger btn-eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                            <i class="fas fa-trash-alt"></i> <!-- Ícono de la papelera -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if(Session::has('success'))
<script>
    window.onload = function() {
        alert("{{ Session::get('success') }}");
    };
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const botonOrdenarNombre = document.getElementById('ordenarNombre');
        let ordenAscendenteNombre = true;

        botonOrdenarNombre.addEventListener('click', function () {
            // Cambia la dirección del orden para el nombre
            ordenAscendenteNombre = !ordenAscendenteNombre;

            // Redirige con el nuevo parámetro de orden solo para el nombre y el estado actual para el correo electrónico
            window.location.href = '{{ route("admin.usuarios.index") }}' + '?ordenNombre=' + (ordenAscendenteNombre ? 'asc' : 'desc');
        });

        // Verificar si hay parámetros de orden en la URL y establecer el estado del ordenAscendente en consecuencia solo para el nombre
        const urlParams = new URLSearchParams(window.location.search);
        const ordenNombreParam = urlParams.get('ordenNombre');
        if (ordenNombreParam === 'desc') {
            ordenAscendenteNombre = false;
        }
    });
</script>

@endsection