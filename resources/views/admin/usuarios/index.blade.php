@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 position-relative">
            <div class="tarjeta-agregar-usuarios">
                <a href="{{ route('admin.usuarios.create') }}" class="btn boton-agregar">Agregar Usuario</a>
            </div>
            <div class="tarjeta">
                <div class="encabezado-tarjeta-usuarios">Lista de Usuarios</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
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
@endsection