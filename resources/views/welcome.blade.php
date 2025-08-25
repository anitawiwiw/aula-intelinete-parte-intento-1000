<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Aula Inteligente</title>
<style>
  /* Reset básico */
  * {
    box-sizing: border-box;
    margin: 0; padding: 0;
  }
:root {
  --color-primary: #6d3a7c;
  --color-secondary: #a87cb0;
  --color-background-main: #FDF9F5;
  --color-background-sidebar: #d8d3dd;
  --color-text-dark: #491c57;
  --color-text-light: #FDF9F5;
}
  html, body {
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: white;
    background: url('/images/burbujas.jpg') no-repeat center center/cover;
  }

  /* Barra superior */
  header {
     position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 50px;
  background-color: var(--color-secondary);
  display: flex;
  justify-content: flex-end;
  align-items: center;
  padding: 0 20px;
  z-index: 1000;
  }

  /* Logo a la izquierda */
  .logo img {
    position: absolute;
  left: 55px;
  top: 50%;
  transform: translateY(-50%);
  height: 250%;
  }

  /* Menú derecha */
  nav {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-weight: 600;
    font-size: 1.1rem;
  }
  nav a {
    color: white;
    text-decoration: none;
    cursor: pointer;
    transition: color 0.3s ease;
  }
  nav a:hover {
    color: var( --color-text-light);
  }

  /* Separador barra */
  nav span.separator {
     color: var( --color-text-light);
    user-select: none;
    font-weight: 400;
  }

  /* Contenido central */
  main {
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 0 1rem;
  }

  main h1 {
    font-size: clamp(2.8rem, 5vw, 4.5rem);
    font-weight: 900;
    text-shadow: 0 3px 10px rgba(0,0,0,0.6);
    margin-bottom: 0.5rem;
    max-width: 900px;
  }

  main p {
    font-size: clamp(1.2rem, 2.5vw, 1.8rem);
    font-weight: 500;
    opacity: 0.85;
    max-width: 650px;
    text-shadow: 0 2px 6px rgba(0,0,0,0.5);
  }

  /* Para que el contenido no quede tapado por la barra fija */
  body::before {
    content: "";
    display: block;
    height: 60px;
  }

  /* Responsive para móviles */
  @media (max-width: 480px) {
    main h1 {
      font-size: 2.2rem;
    }
    main p {
      font-size: 1rem;
      max-width: 90vw;
    }
  }
</style>
</head>
<body>

<header>
  <div class="logo">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
  </div>
  <nav>
    <a href="{{ route('register.form') }}">Registrarse</a>
    <span class="separator">|</span>
    <a href="{{ route('login.form') }}">Iniciar Sesión</a>
  </nav>
</header>

<main>
  <h1>Bienvenido a tu Aula Inteligente y Automatizada</h1>
  <p>Gestiona horarios, reservas y recursos con la máxima eficiencia. Simplifica tu día a día con tecnología pensada para vos.</p>
</main>

</body></html>