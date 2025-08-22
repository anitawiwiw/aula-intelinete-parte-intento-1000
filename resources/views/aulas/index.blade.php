<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aulas - Panel</title>
  <style>
    :root {
      --color-primary: #6d3a7c;
      --color-secondary: #a87cb0;
      --color-background-main: #FDF9F5;
      --color-background-sidebar: #d8d3dd;
      --color-text-dark: #491c57;
      --color-text-light: #FDF9F5;
    }
    body {
      font-family: Arial, sans-serif;
      margin: 0; padding: 0;
      background-color: var(--color-background-main);
      display: flex; flex-direction: column;
      height: 100vh;
    }
    .top-bar {
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
.top-bar a {
  color: var(--color-text-light);
  text-decoration: none;
  font-weight: bold; margin-left: 15px;
}
.top-bar .logo {
  position: absolute;
  left: 55px;
  top: 50%;
  transform: translateY(-50%);
  height: 250%; /* ajusta según tu preferencia */
}
.main-container { display: flex; }
.sidebar {
  position: fixed;
  top: 50px; /* empieza debajo del top-bar */
  left: 0;
  width: 200px;
  height: calc(100vh - 50px); /* altura restante de la ventana */
  background-color: var(--color-background-sidebar);
  padding: 40px 20px;
  display: flex;
  flex-direction: column;
  gap: 20px;
  align-items: center;

}
.sidebar-button {
  background-color: var(--color-primary);
  width: 100%; height: 40px;
  border: none; border-radius: 20px;
  cursor: pointer;
}
.content-area {
  margin-left: 200px; /* mismo ancho de la sidebar */
  padding: 70px; /* padding-top suficiente para no tapar top-bar */
  flex-grow: 1; }
    
    .header-left {
      display: flex; flex-direction: column; gap: 15px;
    }
    .header-title {
      font-family: 'Cinzel', serif;
      font-size: 80px; color: var(--color-primary);
      margin: 0;
    }
    .create-button {
      background-color: var(--color-background-sidebar);
      color: var(--color-primary);
      border: none; padding: 12px 25px;
      border-radius: 25px; font-weight: bold;
      cursor: pointer; font-size: 16px;
    }
    .create-button:hover {
      background-color: var(--color-secondary);
    }
    .map-box {
      border: 2px solid var(--color-text-dark);
      border-radius: 20px; width: 500px; height: 350px;
      overflow: hidden;
      display: flex; justify-content: center; align-items: center;
    }
    .map-box img { width: 100%; height: 100%; object-fit: contain; }
    .table-section { margin-top: 20px; width: 100%; }
    table { width: 100%; border-collapse: collapse; font-size: 15px; }
    th, td { padding: 12px; text-align: center; }
    th {
      background-color: var(--color-background-sidebar);
      color: var(--color-text-dark);
    }
    tr:nth-child(even) { background-color: #f9f9f9; }
    .edit-button {
      background-color: #3490dc; color: white;
      padding: 6px 12px; border-radius: 5px;
      text-decoration: none;
    }
    .edit-button:hover { background-color: #2779bd; }
    .delete-button {
      background-color: #e3342f; color: white;
      padding: 6px 12px; border: none;
      border-radius: 5px; cursor: pointer;
      margin-left: 8px;
    }
    .delete-button:hover { background-color: #cc1f1a; }
  </style>
</head>
<body>
  <!-- Top bar -->
  <div class="top-bar">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    <a href="{{ route('home_de_admins') }}">home</a> |
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
        <div class="header-left">
          <h1 class="header-title">aulas</h1>
          <a href="{{ route('aulas.create') }}">
            <button class="create-button">crear aula</button>
          </a>
        </div>
        <div class="map-box">
          <img src="{{ asset('images/aulas.jpeg') }}" alt="Mapa de Aulas">
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
