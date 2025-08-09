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

  html, body {
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: white;
    background: url('https://img.freepik.com/vector-gratis/fondo-abstracto-colores_23-2148811699.jpg?semt=ais_hybrid&w=740&q=80') no-repeat center center/cover;
  }

  /* Barra superior */
  header {
    position: fixed;
    top: 0; left: 0; right: 0;
    height: 60px;
    background: rgba(0,0,0,0.5); /* negro 50% opaco */
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    z-index: 1000;
  }

  /* Logo a la izquierda */
  .logo img {
    height: 40px;
    filter: brightness(1);
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
    color: #99ccff;
  }

  /* Separador barra */
  nav span.separator {
    color: white;
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
    <img src="https://esim.edu.ar/web/wp-content/uploads/2021/08/innovacion.png" alt="Logo Innovación" />
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

</body>
</html>
