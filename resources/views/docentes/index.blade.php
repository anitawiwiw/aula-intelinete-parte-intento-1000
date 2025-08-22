@extends('layouts.app')

@section('content')
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

  <!-- Contenido principal -->
  <div class="content-area">
    <div class="header-section">
      <h1 class="header-title">Docentes</h1>
      <a href="{{ route('docentes.create2') }}">
        <button class="create-button">Crear Docente</button>
      </a>
    </div>

    <!-- Tabla -->
    <div class="table-section">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuario ID</th>
            <th>Nombre Completo</th>
            <th>DNI</th>
            <th>Especialidad</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($docentes as $docente)
          <tr>
            <td>{{ $docente->id }}</td>
            <td>{{ $docente->user_id == 0 ? 'No asignado' : $docente->user_id }}</td>
            <td>{{ $docente->nombre_completo }}</td>
            <td>{{ $docente->dni }}</td>
            <td>{{ $docente->especialidad }}</td>
            <td>
              <a href="{{ route('docentes.edit', $docente->id) }}" class="edit-button">Editar</a>
              <form action="{{ route('docentes.destroy', $docente->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Seguro que deseas eliminar este docente?');">
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
@endsection
