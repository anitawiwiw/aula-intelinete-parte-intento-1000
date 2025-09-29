<!DOCTYPE html>
<html>
<head>
    <title>Datos ESP32</title>
    <meta http-equiv="refresh" content="1">
</head>
<body>
    <h1>Datos recibidos del ESP32</h1>
    <ul>
        @foreach($datos as $dato)
            <li>{{ $dato->mensaje }} (Tipo: {{ $dato->tipo }}, Valor: {{ $dato->valor }})</li>
        @endforeach
    </ul>
</body>
</html>


