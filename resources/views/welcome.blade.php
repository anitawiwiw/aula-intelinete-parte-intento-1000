<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Bienvenida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .welcome-container {
            text-align: center;
            background: white;
            padding: 2rem 3rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgb(0 0 0 / 0.1);
            width: 320px;
        }
        .welcome-container h1 {
            margin-bottom: 1.5rem;
        }
        .welcome-container a {
            display: block;
            margin: 0.75rem 0;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
        }
        .welcome-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Bienvenido</h1>
        <a href="{{ route('login.form') }}">Iniciar Sesión</a>
        <a href="{{ route('register.form') }}">Registrarse</a>
    </div>
</body>
</html>
