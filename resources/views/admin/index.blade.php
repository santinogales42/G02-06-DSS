@extends('layout')

@section('title', 'Panel de Administrador')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
        <h1 class="display-4 font-weight-bold" style="font-size: 2.5rem; color:white; text-align: center">Panel de Administrador</h1>
    </div>
</div>
<div class="circle-container">
    @auth
    @if(Auth::check() && (Auth::user()->role->name === 'noticiero' || Auth::user()->role->name === 'admin'))
    <a href="{{ route('admin.noticias.index') }}"  class="circle"><strong>Noticias</strong></a>
    @endif
    @endauth
    
    @auth
    @if(Auth::check() && (Auth::user()->role->name === 'analista' || Auth::user()->role->name === 'admin'))
    <a href="{{ route('admin.adminjugador') }}"  class="circle"><strong>Jugadores</strong></a>
    <a href="{{ route('admin.equipos.index') }}"  class="circle"><strong>Equipos</strong></a>
    <a href="{{ route('admin.partidos.index') }}" class="circle"><strong>Partidos</strong></a>
    @endif
    @endauth
    
    @auth
    @if(Auth::check() && Auth::user()->role->name === 'admin')
    <a href="{{ route('mostrarMensajes') }}" class="circle"><strong>Mensajes</strong></a>
    <a href="{{ route('admin.usuarios.index') }}" class="circle"><strong>Usuarios</strong></a>
    @endif
    @endauth
</div>
@endsection
