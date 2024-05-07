<div style="margin-left: {{ 20 * $level }}px; padding-top: 10px; border-left: 2px solid #ccc;">
    <p>{{ $response->content }}</p>
    <small>Respondido por {{ $response->user->name }} el {{ $response->created_at->format('d/m/Y H:i') }}</small>

    {{-- Verificar si el usuario actual es el autor de la respuesta para mostrar el botón de eliminar --}}
    @if (auth()->user() && auth()->user()->id == $response->user_id)
        <form method="POST" action="{{ route('responses.destroy', $response->id) }}" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('¿Estás seguro de querer eliminar esta respuesta?');">Eliminar</button>
        </form>
    @endif

    {{-- Formulario para responder a este mensaje específico --}}
    <form method="POST" action="{{ route('responses.store', $thread->id) }}">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $response->id }}">
        <textarea name="content" placeholder="Responder a este mensaje"></textarea>
        <button type="submit">Responder</button>
    </form>

    {{-- Recursivamente incluir sub-respuestas --}}
    @foreach ($response->children as $child)
        @include('threads.show_responses', ['response' => $child, 'level' => $level + 1])
    @endforeach
</div>
