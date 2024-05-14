@extends('layout')

@section('title', 'Panel de Administrador')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
        <h1 class="display-4 font-weight-bold" style="font-size: 2.5rem; color:white; text-align: center">Panel de Administrador</h1>
    </div>
</div>
<div class="circle-container">
    <a href="{{ route('mostrarMensajes') }}" class="circle"><strong>Mensajes</strong></a>
    <a href="{{ route('admin.adminjugador') }}"  class="circle"><strong>Jugadores</strong></a>
    <a href="{{ route('admin.noticias.index') }}"  class="circle"><strong>Noticias</strong></a>
    <a href="{{ route('admin.equipos.index') }}"  class="circle"><strong>Equipos</strong></a>
    <a href="{{ route('admin.usuarios.index') }}" class="circle"><strong>Usuarios</strong></a>
    <a href="{{ route('admin.partidos.index') }}" class="circle"><strong>Partidos</strong></a>
</div>
@endsection
