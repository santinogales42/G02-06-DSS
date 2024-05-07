
<!-- resources/views/clasificacion/index.blade.php -->

@extends('layout')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Hilos del Foro</h1>
        <a href="{{ route('threads.create') }}" class="btn btn-primary">Crear un Hilo</a>
    </div>

    {{-- Aquí podrías listar los hilos existentes --}}
    <div class="mt-3">
        <div class="list-group">
            @forelse($threads as $thread)
                <a href="{{ route('threads.show', $thread->id) }}" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">{{ $thread->topic }}</h5>
                    <p class="mb-1">{{ Str::limit($thread->content, 150) }}</p>
                    <small>Creado por: {{ $thread->user->name }}</small>
                </a>
            @empty
                <div class="alert alert-info" role="alert">
                    No hay hilos para mostrar.
                </div>
            @endforelse
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


@endsection

