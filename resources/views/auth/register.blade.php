<!-- resources/views/layouts/app.blade.php -->
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<script src="{{ asset('js/auth.js') }}" defer></script>
<form action="{{ route('register') }}" method="POST">
<div class="auth-container">
    <div class="auth-card">
        <h2>Registrarse</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
                <span class="password-toggle" onclick="togglePassword('password')">👁️</span>
            </div>
            <div class="input-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                <span class="password-toggle" onclick="togglePassword('password_confirmation')">👁️</span>
            </div>
            <button type="submit" class="submit-btn">Registrarse</button>
        </form>
    </div>
</div>
</form>

