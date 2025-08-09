<!-- resources/views/auth/register.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Registro</title>
<style>
  body {
    margin: 0;
    height: 100vh;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    overflow: hidden;
  }

  .auth-container {
    background: #fff;
    padding: 3rem 4rem;
    border-radius: 12px;
    box-shadow: 0 25px 40px rgba(0,0,0,0.25);
    width: 460px;
    max-width: 90vw;
    text-align: center;
    opacity: 0;
    transform: translateY(-50px);
    animation: fadeSlideIn 0.8s forwards ease-out;
  }

  @keyframes fadeSlideIn {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  h2 {
    font-weight: 700;
    font-size: 2.2rem;
    margin-bottom: 2rem;
    color: #4b4b4b;
  }

  .input-group {
    position: relative;
    margin-bottom: 1.6rem;
    text-align: left;
  }

  label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #555;
    font-size: 1rem;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"] {
    width: 100%;
    padding: 0.9rem 3.2rem 0.9rem 1rem;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 1.1rem;
    transition: border-color 0.3s ease;
  }

  input[type="text"]:focus,
  input[type="email"]:focus,
  input[type="password"]:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 8px rgba(102,126,234,0.4);
  }

  .password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.6rem;
    color: #888;
    cursor: pointer;
    user-select: none;
    transition: color 0.3s ease;
  }
  .password-toggle:active {
    color: #667eea;
  }

  select {
    width: 100%;
    padding: 0.9rem 1rem;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 1.1rem;
    color: #444;
    cursor: pointer;
  }
  select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 8px rgba(102,126,234,0.4);
  }

  button.submit-btn {
    width: 100%;
    padding: 1.2rem 0;
    background: #667eea;
    border: none;
    border-radius: 10px;
    font-size: 1.3rem;
    font-weight: 700;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  button.submit-btn:hover {
    background: #5563d6;
  }
  button.submit-btn:disabled {
    background: #aaa;
    cursor: default;
  }

  .error-message {
    background: #ffeded;
    color: #cc0033;
    padding: 0.9rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    margin-bottom: 1.5rem;
    font-size: 1rem;
  }

  .password-hint {
    font-size: 0.9rem;
    color: #888;
    margin-bottom: 1.4rem;
    user-select: none;
  }
</style>
</head>
<body>
  <div class="auth-container">
    <h2>Registro</h2>

    @if($errors->any())
      <div class="error-message">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
      @csrf

      <div class="input-group">
        <label for="name">Nombre Completo</label>
        <input 
          type="text" 
          id="name" 
          name="name" 
          required 
          value="{{ old('name') }}"
          autocomplete="name"
        >
      </div>

      <div class="input-group">
        <label for="username">Nombre de Usuario</label>
        <input 
          type="text" 
          id="username" 
          name="username" 
          required 
          value="{{ old('username') }}"
          autocomplete="username"
        >
      </div>

      <div class="input-group">
        <label for="email">Correo Electrónico</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          required 
          value="{{ old('email') }}"
          autocomplete="email"
        >
      </div>

      <div class="input-group">
        <label for="password">Contraseña</label>
        <input 
          type="password" 
          id="password" 
          name="password" 
          required 
          autocomplete="new-password"
        >
        <span 
          class="password-toggle" 
          id="togglePassword" 
          title="Mostrar/Ocultar Contraseña"
          onmousedown="showPassword('password')" 
          onmouseup="hidePassword('password')" 
          onmouseleave="hidePassword('password')"
        >👁️</span>
      </div>

      <div class="password-hint">
        La contraseña debe tener al menos 8 caracteres.
      </div>

      <div class="input-group">
        <label for="password_confirmation">Confirmar Contraseña</label>
        <input 
          type="password" 
          id="password_confirmation" 
          name="password_confirmation" 
          required 
          autocomplete="new-password"
        >
        <span 
          class="password-toggle" 
          id="togglePasswordConfirm" 
          title="Mostrar/Ocultar Contraseña"
          onmousedown="showPassword('password_confirmation')" 
          onmouseup="hidePassword('password_confirmation')" 
          onmouseleave="hidePassword('password_confirmation')"
        >👁️</span>
      </div>

      <div class="input-group">
        <label for="role">Rol</label>
        <select id="role" name="role" required>
          <option value="" disabled selected>Seleccioná un rol</option>
          <option value="profesor" {{ old('role') == 'profesor' ? 'selected' : '' }}>Profesor</option>
          <option value="administrador" {{ old('role') == 'administrador' ? 'selected' : '' }}>Administrador</option>
        </select>
      </div>

      <button type="submit" class="submit-btn" id="submitBtn" disabled>Registrarse</button>
    </form>
  </div>

  <script>
    function showPassword(id) {
      document.getElementById(id).type = 'text';
    }
    function hidePassword(id) {
      document.getElementById(id).type = 'password';
    }

    // Validar inputs para activar botón
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');

    const inputs = [
      document.getElementById('name'),
      document.getElementById('username'),
      document.getElementById('email'),
      document.getElementById('password'),
      document.getElementById('password_confirmation'),
      document.getElementById('role'),
    ];

    function validateInputs() {
      const allFilled = inputs.every(input => {
        if(input.tagName === 'SELECT') {
          return input.value !== '';
        }
        return input.value.trim() !== '';
      });

      // Validar que contraseña tenga al menos 8 caracteres
      const password = document.getElementById('password').value;
      const passConfirm = document.getElementById('password_confirmation').value;
      const passwordsMatch = password === passConfirm;

      submitBtn.disabled = !(allFilled && password.length >= 8 && passwordsMatch);
    }

    inputs.forEach(input => {
      input.addEventListener('input', validateInputs);
      if(input.tagName === 'SELECT') {
        input.addEventListener('change', validateInputs);
      }
    });

    window.addEventListener('load', validateInputs);
  </script>
</body>
</html>
