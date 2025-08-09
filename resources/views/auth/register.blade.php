<form action="{{ route('register') }}" method="POST">
    @csrf
    <label>Nombre completo:</label>
    <input type="text" name="name" required>

    <label>Nombre de usuario:</label>
    <input type="text" name="username" required>

    <label>Correo electrónico:</label>
    <input type="email" name="email" required>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <label>Confirmar contraseña:</label>
    <input type="password" name="password_confirmation" required>

    <label>Rol:</label>
    <select name="role" required>
        <option value="">Selecciona un rol</option>
        <option value="profesor">Profesor</option>
        <option value="administrador">Administrador</option>
    </select>

    <button type="submit">Registrarse</button>
</form>
