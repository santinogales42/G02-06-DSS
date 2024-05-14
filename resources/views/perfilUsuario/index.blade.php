@extends('layout')

@section('content')
<div class="container">

    <div class="tarjeta-editar-perfil mb-3">
        <a href="{{ route('perfilUsuario.edit') }}" class="btn boton-editar-perfil">Editar Información</a>
    </div>

    <div class="tarjeta-perfil">
        <div class="encabezado-tarjeta-usuarios">Datos Usuario</div>
        <div class="card-body">
            <p class="card-text"><strong>Nombre:</strong> {{ $user->name }}</p>
            <p class="card-text"><strong>Correo:</strong> {{ $user->email }}</p>
            <!-- <p class="card-text"><strong>Fecha de Registro:</strong> {{ $user }}</p> -->
            
        </div>
    </div>
</div>
@endsection