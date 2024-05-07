<ul>
@foreach ($users as $user)
    <li>
        <a href="#" onclick="fetchUserThreads({{ $user->id }}); return false;">
            {{ $user->name }} ({{ $user->threads_count }} hilos)
        </a>
    </li>
@endforeach
</ul>

<script>
function fetchUserThreads(userId) {
    fetch(`/filterThreads/${userId}`)
    .then(response => response.text())
    .then(html => {
        document.getElementById('threadsContainer').innerHTML = html;
        // Reattach any necessary handlers for the new content
    })
    .catch(error => console.error('Error:', error));
}
</script>
