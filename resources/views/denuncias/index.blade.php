@extends('layouts.app') {{-- Usa tu layout principal si tienes uno --}}

@section('content')
<div class="container">
    <h2>Lista de Denuncias</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th> {{-- Aquí va la columna que mencionábamos --}}
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($denuncias as $denuncia)
            <tr>
                <td>{{ $denuncia->id }}</td>
                <td>{{ $denuncia->titulo }}</td>
                <td>{{ $denuncia->descripcion }}</td>
                <td>{{ $denuncia->estado }}</td> {{-- Mostramos el estado --}}
                <td><a href="{{ route('denuncias.show', $denuncia->id) }}" class="btn btn-primary">Ver</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
