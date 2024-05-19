@extends('layout')

@section('content')
<div class="container mt-4">
    <h1>Crear un Nuevo Hilo</h1>
    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('threads.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="topic" class="form-label">Tema</label>
                    <input type="text" class="form-control" id="topic" name="topic" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Crear Hilo</button>
            </form>
        </div>
    </div>
</div>
@endsection
