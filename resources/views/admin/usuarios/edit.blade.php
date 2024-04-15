@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="tarjeta">
                <div class="encabezado-tarjeta-usuarios">Actualizar información</div>

                <div class="card-body">
                    <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nombre">Nuevo nombre:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $usuario->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Nuevo email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}">
                        </div>
                        <!-- <div class="form-group">
                            <label for="password">Nueva Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{ $usuario->password }}">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Nueva Contraseña:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div> -->
                        <div class="form-group">
                        <button type="submit" class="btn boton-actualizar-usuarios btn-outline-light ml-auto">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection