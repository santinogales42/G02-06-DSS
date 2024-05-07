@foreach ($threads as $thread)
    <div class="card mb-3" id="thread-{{ $thread->id }}">
        <div class="card-header">
            <h4>{{ $thread->topic }}</h4>
        </div>
        <div class="card-body">
            <p>{{ $thread->content }}</p>
            <small>Publicado por {{ $thread->user->name }} el {{ $thread->created_at->format('d/m/Y H:i') }}</small>
        </div>
        <div class="card-footer">
            @auth
                <!-- Botón para ver detalles del hilo -->
                <a href="{{ route('threads.show', $thread->id) }}" class="btn btn-primary">Ver Hilo</a>

                <!-- Condicionales para mostrar el botón de eliminar -->
                @if (auth()->user()->id == $thread->user_id || (auth()->user()->isAdmin && auth()->user()->id != $thread->user_id))
                    <button type="button" class="btn btn-danger delete-btn" data-thread-id="{{ $thread->id }}">Eliminar</button>
                @endif
            @endauth
        </div>
    </div>
@endforeach
