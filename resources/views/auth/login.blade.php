<form action="{{ route('login') }}" method="POST">
    @csrf
    <label>Correo electrónico:</label>
    <input type="email" name="email" required>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <button type="submit">Iniciar sesión</button>
</form>
