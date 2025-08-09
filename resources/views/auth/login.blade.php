<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Iniciar Sesión</title>
<style>
  /* Fondo degradado */
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

  /* Contenedor del login animado */
  .auth-container {
    background: #fff;
    padding: 3rem 4rem;
    border-radius: 12px;
    box-shadow: 0 25px 40px rgba(0,0,0,0.25);
    width: 420px;
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

  /* Título */
  h2 {
    font-weight: 700;
    font-size: 2.2rem;
    margin-bottom: 2rem;
    color: #4b4b4b;
  }

  /* Grupos de inputs */
  .input-group {
    position: relative;
    margin-bottom: 1.8rem;
    text-align: left;
  }

  label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #555;
    font-size: 1rem;
  }

  input[type="email"],
  input[type="password"] {
    width: 100%;
    padding: 0.9rem 3.2rem 0.9rem 1rem;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 1.1rem;
    transition: border-color 0.3s ease;
  }

  input[type="email"]:focus,
  input[type="password"]:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 8px rgba(102,126,234,0.4);
  }

  /* Icono ojo */
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

  /* Botón grande y redondeado */
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

  /* Mensajes de error */
  .error-message {
    background: #ffeded;
    color: #cc0033;
    padding: 0.9rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    margin-bottom: 1.5rem;
    font-size: 1rem;
  }
</style>
</head>
<body>
  <div class="auth-container">
    <h2>Iniciar Sesión</h2>

    @if($errors->any())
      <div class="error-message">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
      @csrf

      <div class="input-group">
        <label for="email">Correo Electrónico</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          required 
          autocomplete="username" 
          value="{{ old('email') }}"
        >
      </div>

      <div class="input-group">
        <label for="password">Contraseña</label>
        <input 
          type="password" 
          id="password" 
          name="password" 
          required 
          autocomplete="current-password" 
        >
        <span 
          class="password-toggle" 
          id="togglePassword" 
          title="Mostrar/Ocultar Contraseña"
          onmousedown="showPassword()" 
          onmouseup="hidePassword()" 
          onmouseleave="hidePassword()"
        >👁️</span>
      </div>

      <button type="submit" class="submit-btn" id="submitBtn" disabled>Iniciar Sesión</button>
    </form>
  </div>

  <script>
    // Mostrar y ocultar contraseña mientras se presiona el ojo
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    function showPassword() {
      passwordInput.type = 'text';
    }
    function hidePassword() {
      passwordInput.type = 'password';
    }

    // Validar que inputs tengan contenido para habilitar botón
    const form = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const submitBtn = document.getElementById('submitBtn');

    function validateInputs() {
      if(emailInput.value.trim() !== '' && passwordInput.value.trim() !== '') {
        submitBtn.disabled = false;
      } else {
        submitBtn.disabled = true;
      }
    }

    emailInput.addEventListener('input', validateInputs);
    passwordInput.addEventListener('input', validateInputs);

    // Validar al cargar la página (por si hay autofill)
    window.addEventListener('load', validateInputs);
  </script>
</body>
</html>

