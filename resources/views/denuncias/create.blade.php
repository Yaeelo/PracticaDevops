<!-- resources/views/denuncias/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nueva Denuncia</h2>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('denuncias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required></textarea><br>

        <textarea id="descripcion" name="descripcion"></textarea>
        <button type="button" onclick="grabarVoz()">🎤 Dictar</button>


        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" required><br>

        <label for="evidencia">Evidencia (opcional):</label>
        <input type="file" name="evidencia"><br>

        <!-- Botón para compartir ubicación -->
<button type="button" onclick="obtenerUbicacion()" class="btn btn-secondary mb-3">
    Compartir mi ubicación
</button>

<!-- Campo para mostrar la ubicación -->
<input type="text" id="ubicacion" name="ubicacion" class="form-control" readonly>



        <input type="file" name="evidencias[]" multiple accept="image/*,video/*,audio/*">


        <button id="botonPanico" class="btn btn-danger" type="button">🚨 Botón de Pánico</button>

        <button type="submit">Enviar Denuncia</button>

<script>
    document.getElementById('botonPanico').addEventListener('click', function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                fetch("{{ route('denuncias.panico') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        ubicacion: lat + "," + lng
                    })
                })
                .then(res => res.json())
                .then(data => {
                    alert("¡Botón de pánico activado!");
                    console.log(data);
                });
            });
        } else {
            alert("La geolocalización no está disponible.");
        }
    });
</script>
<script>
function obtenerUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            document.getElementById('ubicacion').value = `Lat: ${lat}, Lon: ${lon}`;
        }, function(error) {
            alert("No se pudo obtener la ubicación.");
        });
    } else {
        alert("Tu navegador no soporta geolocalización.");
    }
}
</script>

    </form>
</div>
@endsection
