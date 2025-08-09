<!DOCTYPE html>
<html>
<head>
    <title>Página Principal</title>
</head>
<body style="text-align:center; margin-top:50px;">
    <h1>Bienvenido</h1>
    <a href="{{ route('register.form') }}">
        <button>Registrarse</button>
    </a>
    <a href="{{ route('login.form') }}">
        <button>Iniciar sesión</button>
    </a>
</body>
</html>
