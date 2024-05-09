@if ($level == 0)
<div class="card mt-3">
@endif
<style>
    .response-block {
    background-color: #f9f9f9; /* Color de fondo para destacar */
    margin-top: 10px;
    padding: 10px;
    border-radius: 5px; /* Bordes redondeados para sub-respuestas */
}

</style>
<div class="response-block" style="margin-left: {{ 20 * $level }}px; padding: 20px; border-left: 2px solid #ccc;">
    <p>{{ $response->content }}</p>
    <small>Respondido por {{ $response->user->name }} el {{ $response->created_at->format('d/m/Y H:i') }}</small>

    @if (auth()->user() && auth()->user()->id == $response->user_id)
        <form method="POST" action="{{ route('responses.destroy', $response->id) }}" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('¿Estás seguro de querer eliminar esta respuesta?');">Eliminar</button>
        </form>
    @endif

    <form method="POST" action="{{ route('responses.store', $thread->id) }}">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $response->id }}">
        <textarea name="content" placeholder="Responder a este mensaje..."></textarea>
        <button type="submit">Responder</button>
    </form>

    @foreach ($response->children as $child)
        @include('threads.show_responses', ['response' => $child, 'level' => $level + 1])
    @endforeach
</div>

@if ($level == 0)
</div>
@endif
