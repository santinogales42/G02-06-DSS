@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('threads.create') }}" class="btn btn-primary mb-3">Crear un Hilo</a>
            <button id="toggleMyThreads" class="btn btn-secondary mb-3" data-mine="false">Ver Mis Hilos</button>

            <!-- Search bar -->
            <input type="text" id="search" placeholder="Buscar hilos o usuarios..." class="form-control mb-3">

            <div id="threadsContainer">
                @include('threads.thread_list', ['threads' => $threads])
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const toggleBtn = document.getElementById('toggleMyThreads');
    let showMyThreads = false; // Initialize as false

    toggleBtn.addEventListener('click', () => {
        showMyThreads = !showMyThreads; // Toggle the boolean value
        toggleBtn.setAttribute('data-mine', showMyThreads.toString()); // Update the attribute
        toggleBtn.textContent = showMyThreads ? 'Ver Todos los Hilos' : 'Ver Mis Hilos'; // Update the button text
        fetchMyThreads(); // Fetch threads based on the new filter
    });

    function fetchThreads() {
        const searchTerm = searchInput.value;
        fetch(`{{ url('/threads/search') }}?search=${searchTerm}&showMy=false`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('threadsContainer').innerHTML = html;
            attachDeleteHandlers();
        })
        .catch(error => console.error('Error loading the threads:', error));
    }

    function fetchMyThreads() {
        fetch(`{{ url('/toggleThreads') }}?showMy=${showMyThreads}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('threadsContainer').innerHTML = html;
            attachDeleteHandlers();
        })
        .catch(error => console.error('Error loading the threads:', error));
    }

    function attachDeleteHandlers() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.removeEventListener('click', handleDelete);
            button.addEventListener('click', handleDelete);
        });
    }

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
                    fetchMyThreads();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    searchInput.addEventListener('keyup', fetchThreads);

    fetchThreads(); // Initial fetch of threads
});

</script>

@endsection
