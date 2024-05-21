@extends('layout')

@section('content')
<div class="container">

    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('perfilUsuario.edit') }}" class="btn btn-danger btn-block">Editar Información</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-danger text-white">Datos Usuario</div>
                <div class="card-body">
                    <p class="card-text"><strong>Nombre:</strong> {{ $user->name }}</p>
                    <p class="card-text"><strong>Correo:</strong> {{ $user->email }}</p>
                    <!-- <p class="card-text"><strong>Fecha de Registro:</strong> {{ $user }}</p> -->
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

<style>
    .bg-danger {
        background-color: #ff9688 !important; 
    }
    
    .btn-danger {
        background-color: #ff9688 !important; 
        border-color: #ff9688 !important;
    }

    .btn-danger:hover {
        background-color: #d32f2f !important;
        border-color: #d32f2f !important; 
    }
</style>
