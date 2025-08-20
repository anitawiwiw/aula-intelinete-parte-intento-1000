<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administrador</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Font: Cinzel for headings -->
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&display=swap" rel="stylesheet">
  <!-- Google Font: Inter for body text -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --color-primary: #6e3b7d; /* Purpura */
      --color-secondary: #a97cb0; /* Lirio */
      --color-tertiary: #d8bce5; /* Malva */
      --color-background: #fefaf4; /* Crema */
      --color-text-dark: #333;
      --color-text-light: white;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--color-background);
    }
    
    .logo {
      font-family: 'Cinzel', serif;
    }

    /* Custom CSS for button effects */
    .sidebar button {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .sidebar button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .sidebar button:active {
      transform: translateY(0);
      box-shadow: none;
    }
  </style>
</head>
<body class="flex min-h-screen">

  <!-- Sidebar -->
  <div class="fixed top-0 left-0 bottom-0 w-64 bg-[--color-tertiary] text-[--color-text-dark] p-4 flex flex-col gap-4">
    <!-- Logo and top bar area -->
    <div class="flex items-center justify-center h-16 bg-[--color-secondary] -m-4 mb-4">
      <div class="logo font-bold text-2xl text-[--color-text-dark]">Panel</div>
    </div>
    
    <!-- Sidebar navigation -->
    <div class="flex flex-col gap-4 overflow-y-auto">
      <button class="bg-[--color-primary] text-[--color-text-light] border-none py-3 rounded-full text-lg font-semibold cursor-pointer shadow-md hover:bg-[--color-primary] focus:outline-none focus:ring-2 focus:ring-[--color-primary] focus:ring-offset-2">Dashboard</button>
<a href="{{ route('aulas.index') }}">
  <button class="bg-gray-200 text-gray-700 border-none py-3 rounded-full text-lg font-semibold cursor-pointer shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
    aula +
  </button>
</a>

      <button class="bg-gray-200 text-gray-700 border-none py-3 rounded-full text-lg font-semibold cursor-pointer shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">Ajustes</button>
      <button class="bg-gray-200 text-gray-700 border-none py-3 rounded-full text-lg font-semibold cursor-pointer shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">Estudiantes</button>
      <button class="bg-gray-200 text-gray-700 border-none py-3 rounded-full text-lg font-semibold cursor-pointer shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">Profesores</button>
    </div>
  </div>

  <!-- Main content area -->
  <div class="flex-1 ml-64 p-8 pt-20">
    <!-- Top Bar -->
    <div class="fixed top-0 left-64 right-0 h-16 bg-[--color-secondary] flex justify-between items-center px-8 z-10 shadow-md">
      <div></div>
      <div class="flex items-center gap-4">
        <span class="text-white text-base">Hola, <span id="name"></span></span>
        <button class="text-white text-base cursor-pointer hover:underline">Cerrar Sesión</button>
      </div>
    </div>
    
    <!-- Content Header -->
    <div class="mb-10">
      <h1 class="font-['Cinzel'] text-6xl text-[--color-primary] text-left mb-1">Bienvenido</h1>
      <p id="welcome-message" class="text-left text-[--color-secondary] text-lg tracking-widest mb-4"></p>
    </div>

    <!-- Main Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <!-- Photo Box with animation -->
      <div id="photo-container" class="relative bg-gray-300 rounded-2xl w-full h-96 overflow-hidden shadow-xl border-4 border-black transition-transform duration-300 ease-in-out hover:scale-105">
        <img id="dynamic-image" src="https://placehold.co/800x600/a97cb0/FFFFFF?text=Tu+Foto+Aquí" alt="foto" class="absolute inset-0 w-full h-full object-cover transition-opacity duration-500 ease-in-out opacity-100">
        <div class="absolute inset-0 flex justify-center items-center bg-black bg-opacity-30 opacity-0 hover:opacity-100 transition-opacity duration-300 cursor-pointer">
          <p class="text-white text-xl font-bold">Ver Detalles</p>
        </div>
      </div>
      
      <!-- Placeholder for dynamic content or statistics -->
      <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-200">
        <h2 class="text-2xl font-bold text-[--color-primary] mb-4">Resumen Semanal</h2>
        <p class="text-[--color-text-dark] text-justify">
          Esta sección podría mostrar estadísticas dinámicas como la cantidad de nuevos usuarios, el número de clases programadas, o un resumen de la actividad reciente. La idea es que este contenido cambie según el rol y las acciones del usuario.
        </p>
        <div class="mt-6">
          <button class="w-full bg-[--color-secondary] text-[--color-text-light] py-3 rounded-full font-semibold shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Ver Reporte Completo</button>
        </div>
      </div>
    </div>
  </div>

<script>
  // JavaScript para hacer la vista más dinámica
  const userNameEl = document.getElementById('user-name');
  const welcomeMessageEl = document.getElementById('welcome-message');
  const dynamicImageEl = document.getElementById('dynamic-image');

  // Datos de usuario (simulados)
  const userData = {
    nombre: "Administrador",
    rol: "Admin",
    foto: "https://placehold.co/800x600/a97cb0/FFFFFF?text=Panel+de+Admin",
    // Lista de fotos alternativas para el efecto dinámico
    fotosAlternativas: [
      "https://placehold.co/800x600/a97cb0/FFFFFF?text=Bienvenido",
      "https://placehold.co/800x600/a97cb0/FFFFFF?text=Gestión+de+Contenido",
      "https://placehold.co/800x600/a97cb0/FFFFFF?text=Actividad+Reciente"
    ]
  };

  // Función para actualizar el contenido de la página
  function updateView() {
    userNameEl.textContent = userData.nombre;
    welcomeMessageEl.textContent = `Panel de Administración - ${userData.rol}`;
    dynamicImageEl.src = userData.foto;
  }

  // Simular un cambio de imagen cada 5 segundos
  let currentImageIndex = 0;
  setInterval(() => {
    currentImageIndex = (currentImageIndex + 1) % userData.fotosAlternativas.length;
    dynamicImageEl.src = userData.fotosAlternativas[currentImageIndex];
  }, 5000);

  // Llamar a la función al cargar la página
  window.onload = updateView;
</script>

</body>
</html>
