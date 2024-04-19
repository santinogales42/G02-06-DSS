@extends('layout')

@section('title', 'Mensajes recibidos')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Mensajes recibidos</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($mensajes as $mensaje)
                            <li class="list-group-item">{{ $mensaje }}</li>
                        @empty
                            <li class="list-group-item">No hay mensajes recibidos</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer">
                    <form action="{{ route('limpiarMensajes') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Limpiar mensajes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

