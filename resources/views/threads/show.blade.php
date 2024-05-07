@extends('layout')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <h4>{{ $thread->topic }}</h4>
        </div>
        <div class="card-body">
            <p>{{ $thread->content }}</p>
            <small>Publicado por {{ $thread->user->name }} el {{ $thread->created_at->format('d/m/Y H:i') }}</small>
        </div>

        {{-- Formulario para responder al hilo principal --}}
        <form method="POST" action="{{ route('responses.store', $thread->id) }}">
            @csrf
            <textarea name="content"></textarea>
            <button type="submit">Responder</button>
        </form>

        <hr>

        {{-- Mostrar respuestas y manejar respuestas anidadas aquí directamente --}}
        @foreach ($thread->responses->whereNull('parent_id') as $response)
            <div class="card mt-3">
                @include('threads.show_responses', ['response' => $response, 'level' => 0])
            </div>
        @endforeach
    </div>
</div>
@endsection
