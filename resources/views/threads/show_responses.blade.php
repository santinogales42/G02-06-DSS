{{-- Componente show_responses.blade.php --}}
<div style="margin-left: {{ 20 * $level }}px; padding-top: 10px; border-left: 2px solid #ccc;">
    <p>{{ $response->content }}</p>
    <small>Respondido por {{ $response->user->name }} el {{ $response->created_at->format('d/m/Y H:i') }}</small>
    
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
