@extends('layout')

@section('content')
        <h1 style="text-align: center; margin-top: 50px;">
            Administración de Partidos
        </h1>
        <div class="text-center mt-5">
            <div class="d-inline-block mr-5">
                <a href="{{ route('admin.partidos.create') }}" class="btn btn-lg btn-primary px-5 py-3">
                    Crear Partido
                </a>
            </div>
            <div class="d-inline-block">
                <a href="{{ route('admin.partidos.edit') }}" class="btn btn-lg btn-secondary px-5 py-3">
                    Modificar o Eliminar Partido
                </a>
            </div>
        </div>
@endsection
