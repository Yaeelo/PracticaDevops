<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
    @yield('content')
            </main>
        </div>
        <script>
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
        alert("La geolocalización no es soportada por este navegador.");
    }
}
</script>

    }
</script>
<script>
    function enviarPanico() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (pos) {
                const latlon = pos.coords.latitude + ',' + pos.coords.longitude;
                document.getElementById('panic-ubicacion').value = latlon;
                document.getElementById('form-panic').submit();
            });
        }
    }
</script>
<script>
    function grabarVoz() {
        const reconocimiento = new(window.SpeechRecognition || window.webkitSpeechRecognition)();
        reconocimiento.lang = 'es-ES';
        reconocimiento.onresult = function(event) {
            document.getElementById('descripcion').value = event.results[0][0].transcript;
        };
        reconocimiento.start();
    }
</script>

    </body>
</html>
