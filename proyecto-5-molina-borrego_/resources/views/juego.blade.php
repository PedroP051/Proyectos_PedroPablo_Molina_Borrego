<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Detalle</title>
</head>

<body>
    <h1>Juego Detalle</h1>

    @if(isset($juego) && $juego)
    <h2>Juego ID: {{ $id }}</h2>
    <p>{{ $juego }}</p>
    @else
    <p>Juego con ID {{ $id ?? 'desconocido' }} no encontrado.</p>
    @endif
</body>

</html>