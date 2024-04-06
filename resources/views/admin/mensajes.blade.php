@extends('layout')

@section('title', 'Mensajes recibidos')

@section('content')
<h1>Mensajes recibidos</h1>
<ul>
    @foreach ($mensajes as $mensaje)
    <li>{{ $mensaje }}</li>
    @endforeach
</ul>

<form action="{{ route('limpiarMensajes') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Limpiar mensajes</button>
</form>
@endsection
