<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body style="background-color:blue; color:white; text-align:center; margin-top:50px;">
    <h1>Bienvenido, {{ Auth::user()->username }}</h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>
