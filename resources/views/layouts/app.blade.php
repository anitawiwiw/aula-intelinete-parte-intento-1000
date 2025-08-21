<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <style>
  html, body {
    margin: 0;
    padding: 0;
    height: 100vh;
    overflow: hidden;
    font-family: Arial, sans-serif;
  }

  /* Fondo */
  .background {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    z-index: -1;
  }
  .background img {
    width: 100%; height: 100%;
    object-fit: cover;
    filter: blur(8px) brightness(0.9);
  }

  /* Wrapper */
  .form-wrapper {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }

  /* Contenedor */
  .form-container {
    background-color: rgba(255, 255, 255, 0.95);
    max-width: 600px;
    width: 100%;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(0,0,0,0.3);
    text-align: center;
  }

  .form-container h1 {
    font-family: 'Cinzel', serif;
    color: #6e3b7d;
    margin-bottom: 20px;
  }

  /* Imagen de aulas */
  .map-box {
    margin: 0 auto 20px auto;
    border: 2px solid #333;
    border-radius: 12px;
    width: 500px;
    max-width: 100%;
    height: 350px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .map-box img {
    width: 100%; height: 100%;
    object-fit: contain;
  }

  /* Inputs */
  .form-group {
    margin-bottom: 20px;
    text-align: left;
  }
  .form-group label {
    display: block;
    color: #6e3b7d;
    margin-bottom: 5px;
    font-weight: bold;
  }
  .form-group input,
  .form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #d8bce5;
    border-radius: 5px;
    font-size: 16px;
  }
/* Botón principal (guardar, enviar, etc.) */
.btn-primary {
  background: linear-gradient(135deg, #6e3b7d, #8a4f99);
  color: white;
  border: none;
  padding: 12px 20px;
  font-size: 16px;
  border-radius: 25px;
  cursor: pointer;
  font-weight: bold;
  transition: all 0.3s ease;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.btn-primary:hover {
  background: linear-gradient(135deg, #5a2e68, #732d87);
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(0,0,0,0.3);
}

/* Botón secundario (cancelar, volver, etc.) */
.btn-secondary {
  background: linear-gradient(135deg, #999, #aaa);
  color: white;
  border: none;
  padding: 12px 20px;
  font-size: 16px;
  border-radius: 25px;
  cursor: pointer;
  font-weight: bold;
  transition: all 0.3s ease;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.btn-secondary:hover {
  background: linear-gradient(135deg, #777, #888);
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(0,0,0,0.3);
}


</style>

    @stack('styles')
</head>
<body>
    <!-- Fondo general -->
    <div class="main-background"></div>
    <div class="overlay-background"></div>
    
    <!-- Contenido principal -->
    <div class="main-content">
        @yield('content')
    </div>
    
    @stack('scripts')
</body>
</html>