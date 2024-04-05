@extends('welcome')

@section('content')
<div class="container">
    <h2>Jugadores</h2>
    <input type="text" id="searchBox" class="form-control" placeholder="Buscar jugadores...">
    <ul id="playersList" class="list-group mt-3">
        @foreach($jugadores as $jugador)
            <li class="list-group-item">{{ $jugador->nombre }}</li>
        @endforeach
    </ul>
    {{-- Paginación --}}
    {{ $jugadores->links() }}
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#searchBox').on('keyup', function() {
        var value = $(this).val();

        $.ajax({
            url: '{{ url("/jugadores") }}',
            type: 'GET',
            data: { term: value },
            success: function(data) {
                $('#playersList').empty();
                $.each(data, function(key, jugador) {
                    $('#playersList').append('<li class="list-group-item">' + jugador.nombre + '</li>');
                });
            }
        });
    });
});
</script>
@endsection

