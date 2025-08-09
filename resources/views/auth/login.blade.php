<!-- resources/views/layouts/app.blade.php -->
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<script src="{{ asset('js/auth.js') }}" defer></script>
<form action="{{ route('login') }}" method="POST">
   <div class="auth-container">
    <div class="auth-card">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
                <span class="password-toggle" onclick="togglePassword('password')">👁️</span>
            </div>
            <button type="submit" class="submit-btn">Iniciar Sesión</button>
        </form>
    </div>
</div>
</form>
