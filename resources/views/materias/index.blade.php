@extends('layouts.app')

@section('content')
<div class="top-bar">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    <a href="{{ route('home_de_admins') }}">home</a> |

</div>

<div class="main-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('aulas.index') }}" class="sidebar-button">Aulas</a>
    <a href="{{ route('docentes.index') }}" class="sidebar-button">Docentes</a>
    <a href="{{ route('materias.index') }}" class="sidebar-button">Materias</a>
    <a href="{{ route('reservas.index') }}" class="sidebar-button">Reservas</a>
     <a href="{{ route('aires.index') }}" class="sidebar-button">Aires Acondicionados</a>
    <div class="sidebar-button"></div>
    </div>

    <!-- Contenido principal -->
    <div class="content-area">
        <div class="header-section">
            <div class="header-left">
                <h1 class="header-title">Materias</h1>
                <a href="{{ route('materias.create') }}">
                    <button class="create-button">Crear Materia</button>
                </a>
            </div>
        </div>

        <!-- Tabla -->
        <div class="table-section scrollable-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Carrera</th>
                        <th>Año</th>
                        <th>Tipo de Cursada</th>
                        <th>Docentes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materias as $materia)
                    <tr>
                        <td>{{ $materia->id }}</td>
                        <td>{{ $materia->nombre }}</td>
                        <td>{{ $materia->carrera }}</td>
                        <td>{{ $materia->año }}</td>
                        <td>{{ $materia->tipo_cursada }}</td>
                        <td>@foreach($materia->docentes as $docente)
                            {{ $docente->nombre_completo }}@if(!$loop->last), @endif
                            @endforeach</td>

                        <td>
                            <a href="{{ route('materias.edit', $materia->id) }}" class="edit-button">Editar</a>
                            <form action="{{ route('materias.destroy', $materia->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que deseas eliminar esta materia?');">
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
}
.top-bar {
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 60px;
    background: linear-gradient(90deg, var(--color-secondary), var(--color-primary));
    /* -- Cambios aquí -- */
    display: flex; /* 1. Habilita Flexbox */
    justify-content: space-between; /* 2. Separa los elementos (logo a la izq, admin a la der) */
    padding: 0 2rem; /* 3. (Opcional) Añade un poco de espacio en los bordes */
    /* -- Fin de los cambios -- */
    align-items: center;
    z-index: 1000;
}

.top-bar .logo { height: 170px; }
.top-bar a {
  color: var(--color-text-light);
  text-decoration: none;
  font-weight: bold; margin-left: 70%;
}

.main-container { display: flex; }
.sidebar {
  position: fixed;
  top: 50px;
  left: 0;
  width: 200px;
  height: calc(100vh - 50px);
  background-color: var(--color-background-sidebar);
  padding: 40px 20px;
  display: flex;
  flex-direction: column;
  gap: 20px;
  align-items: center;
}
.sidebar-button {
    background-color: var(--color-primary);
    width: 100%;
    height: 40px;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-text-light); /* texto en color claro */
    text-decoration: none; /* quitar subrayado para enlaces */
    font-weight: bold;
}
.sidebar-button:hover {
    background-color: var(--color-secondary);

}
.content-area {
  margin-left: 200px;
  padding: 70px;
  flex-grow: 1;
}
.header-section {
  display: flex; justify-content: space-between;
  align-items: flex-start; margin-bottom: 30px;
}
.header-left {
  display: flex; flex-direction: column; gap: 15px;
}
.header-title {
  font-family: 'Cinzel', serif;
  font-size: 80px; color: var(--color-primary);
  margin: 0;
}
.scrollable-table {
    max-height: 500px; /* Ajusta según necesites */
    overflow-y: auto;
    border: 1px solid #ccc;
    border-radius: 8px;
}
.scrollable-table table {
    width: 100%;
    border-collapse: collapse;
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
@endsection
