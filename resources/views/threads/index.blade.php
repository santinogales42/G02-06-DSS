@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('threads.create') }}" class="btn btn-primary mb-3">Crear un Hilo</a>
            <button id="toggleMyThreads" class="btn btn-secondary mb-3" data-mine="false">Ver Mis Hilos</button>
            @auth
                @if (auth()->user()->isAdmin)
                    <button id="showThreadsByUser" class="btn btn-info mb-3">Mostrar Hilos por Usuario</button>
                @endif
            @endauth

            <div id="threadsContainer">
                @include('threads.thread_list', ['threads' => $threads])
            </div>
        </div>
    </div>
</div>





<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleMyThreads');
    const showThreadsByUserBtn = document.getElementById('showThreadsByUser');
    let showMyThreads = toggleBtn.getAttribute('data-mine') === 'true'; // Estado inicial del toggle de "Mis Hilos"

    // Función para cargar los hilos según el estado del botón "Mis Hilos"
    function fetchThreads() {
        fetch(`{{ url('/toggleThreads') }}?showMy=${showMyThreads}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('threadsContainer').innerHTML = html;
            attachDeleteHandlers(); // Reasignar manejadores para los botones de eliminar
        })
        .catch(error => console.error('Error loading the threads:', error));
    }

    // Función para manejar la eliminación de hilos usando AJAX
    function attachDeleteHandlers() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.removeEventListener('click', handleDelete); // Remover el listener para evitar duplicados
            button.addEventListener('click', handleDelete); // Agregar el listener
        });
    }

    // Manejador del evento de clic para eliminar un hilo
    function handleDelete() {
        if (confirm('¿Estás seguro de querer eliminar este hilo?')) {
            const threadId = this.getAttribute('data-thread-id');
            fetch(`{{ route('threads.destroy', '') }}/${threadId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ _method: 'DELETE' })
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById('thread-' + threadId).remove();
                    if(showMyThreads) {
                        fetchThreads(); // Recargar los hilos si se está en modo "Mis Hilos"
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    // Evento de clic para el botón "Ver Mis Hilos"
    toggleBtn.addEventListener('click', () => {
        showMyThreads = !showMyThreads;
        toggleBtn.setAttribute('data-mine', showMyThreads ? 'true' : 'false');
        toggleBtn.textContent = showMyThreads ? 'Ver Todos los Hilos' : 'Ver Mis Hilos';
        fetchThreads();
    });

    // Evento de clic para "Mostrar Hilos por Usuario"
    if (showThreadsByUserBtn) {
        showThreadsByUserBtn.addEventListener('click', () => {
            fetch(`{{ url('/threadsByUser') }}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('threadsContainer').innerHTML = html;
                // Aquí podrías necesitar agregar manejadores si la nueva vista lo requiere
            })
            .catch(error => console.error('Error loading user threads:', error));
        });
    }

    // Cargar los hilos inicialmente
    fetchThreads();
});
</script>


@endsection


