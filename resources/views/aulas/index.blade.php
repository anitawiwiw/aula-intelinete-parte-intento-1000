<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aulas - Panel de Administración</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&display=swap" rel="stylesheet">
  <style>
    :root {
      --color-primary: #6E3B7D;
      --color-secondary: #A97CB0;
      --color-background-main: #FDF9F2;
      --color-background-sidebar: #D8BCE5;
      --color-text-dark: #333;
      --color-text-light: #fff;
    }
    body {
      font-family: Arial, sans-serif;
      margin: 0; padding: 0;
      background-color: var(--color-background-main);
      display: flex; flex-direction: column;
      height: 100vh;
    }
    .top-bar {
      background-color: var(--color-secondary);
      height: 50px; display: flex;
      justify-content: flex-end; align-items: center;
      padding: 0 20px;
    }
    .top-bar a {
      color: var(--color-text-dark);
      text-decoration: none;
      font-weight: bold; margin-left: 15px;
    }
    .top-bar a:hover { text-decoration: underline; }
    .main-container { display: flex; flex-grow: 1; }
    .sidebar {
      background-color: var(--color-background-sidebar);
      width: 200px; padding: 40px 20px;
      display: flex; flex-direction: column; gap: 20px;
      align-items: center;
    }
    .sidebar-button {
      background-color: var(--color-primary);
      width: 100%; height: 40px;
      border: none; border-radius: 20px;
      cursor: pointer;
    }
    .content-area { flex-grow: 1; padding: 40px; }
    .header-section {
      display: flex; justify-content: space-between;
      align-items: center; margin-bottom: 20px;
    }
    .header-title {
      font-family: 'Cinzel', serif;
      font-size: 50px; color: var(--color-primary);
    }
    .create-button {
      background-color: var(--color-background-sidebar);
      color: var(--color-text-dark);
      border: none; padding: 10px 20px;
      border-radius: 20px; font-weight: bold;
      cursor: pointer;
    }
    .map-box {
      border: 2px solid var(--color-text-dark);
      border-radius: 20px; width: 300px; height: 200px;
      overflow: hidden; margin-left: 20px;
      display: flex; justify-content: center; align-items: center;
    }
    .map-box img { width: 100%; height: 100%; object-fit: contain; }
    .table-section { margin-top: 40px; width: 100%; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; text-align: left; }
    th { background-color: var(--color-background-sidebar); }
    tr:nth-child(even) { background-color: #f9f9f9; }
    .edit-button {
      background-color: #3490dc; color: white;
      padding: 5px 10px; border-radius: 5px;
      text-decoration: none;
    }
    .edit-button:hover { background-color: #2779bd; }
    .delete-button {
      background-color: #e3342f; color: white;
      padding: 5px 10px; border: none;
      border-radius: 5px; cursor: pointer;
    }
    .delete-button:hover { background-color: #cc1f1a; }
  </style>
</head>
<body>
  <!-- Top bar -->
  <div class="top-bar">

    <a href="{{ route('logout') }}">logout</a>
  </div>

  <div class="main-container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-button"></div>
      <div class="sidebar-button"></div>
      <div class="sidebar-button"></div>
      <div class="sidebar-button"></div>
      <div class="sidebar-button"></div>
    </div>

    <!-- Main content -->
    <div class="content-area">
      <div class="header-section">
        <h1 class="header-title">aulas</h1>
        <div class="flex items-center">
          <a href="{{ route('aulas.create') }}">
            <button class="create-button">crear aula</button>
          </a>
          <div class="map-box">
            <img src="{{ asset('images/aulas.jpeg') }}" alt="Mapa de Aulas">
          </div>
        </div>
      </div>

      <!-- Tabla -->
      <div class="table-section">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Ubicación</th>
              <th>Capacidad</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($aulas as $aula)
            <tr>
              <td>{{ $aula->id }}</td>
              <td>{{ $aula->nombre }}</td>
              <td>{{ $aula->ubicacion }}</td>
              <td>{{ $aula->capacidad }}</td>
              <td>
                <a href="{{ route('aulas.edit', $aula->id) }}" class="edit-button">Editar</a>
                <form action="{{ route('aulas.destroy', $aula->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que deseas eliminar esta aula?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="delete-button">Eliminar</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
