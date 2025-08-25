@extends('layouts.app')

@section('content')
<div class="top-bar flex justify-between px-6">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    <span class="admin-text">Administrador</span>
</div>

<div class="main-container">
  <!-- Sidebar -->
  <div class="sidebar">
    <a href="{{ route('aulas.index') }}" class="sidebar-button">Aulas</a>
    <a href="{{ route('docentes.index') }}" class="sidebar-button">Docentes</a>
    <a href="{{ route('materias.index') }}" class="sidebar-button">Materias</a>
    <a href="{{ route('reservas.index') }}" class="sidebar-button">Reservas</a>
  </div>

  <!-- Contenido principal -->
  <div class="content-area">
    <!-- Welcome -->
    <h1 class="header-title">Bienvenido</h1>
    <div class="user-name">
        {{ Auth::user()->name }}
    </div>

    <!-- Imagen principal decorada -->
    <div class="image-container">
        <div class="image-frame">
            <img src="{{ asset('images/aulas.jpeg') }}" alt="Aulas" class="main-image">
            <div class="overlay-text">Gestión de Aulas</div>
        </div>
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
  display: flex;
  flex-direction: column;
}

/* Top bar */
.top-bar {
  position: fixed;
  top: 0; left: 0;
  width: 100%;
  height: 60px;
  background: linear-gradient(90deg, var(--color-secondary), var(--color-primary));
  align-items: center;
  z-index: 1000;
}
.top-bar .logo {
  height: 50px;
}
.admin-text {
  font-family: 'Cinzel', serif;
  font-size: 20px;
  color: var(--color-text-light);
  font-weight: bold;
}

/* Sidebar */
.sidebar {
  position: fixed;
  top: 60px;
  left: 0;
  width: 200px;
  height: calc(100vh - 60px);
  background-color: var(--color-background-sidebar);
  padding: 30px 20px;
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
  color: var(--color-text-light);
  text-decoration: none;
  font-weight: bold;
  transition: background-color 0.3s ease, transform 0.2s ease;
}
.sidebar-button:hover {
  background-color: var(--color-secondary);
  transform: translateY(-2px);
}

/* Contenido principal */
.content-area {
  margin-left: 200px;
  padding: 80px 40px 40px 40px;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Welcome header */
.header-title {
  font-family: 'Cinzel', serif;
  font-size: 80px;
  color: var(--color-primary);
  margin-bottom: 10px;
}
.user-name {
  font-family: 'Inter', sans-serif;
  font-size: 22px;
  color: var(--color-text-dark);
  margin-bottom: 40px;
  padding: 10px 20px;
  border-radius: 12px;
  background-color: rgba(255, 255, 255, 0.6);
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Imagen principal decorada */
.image-container {
  width: 100%;
  display: flex;
  justify-content: center;
}
.image-frame {
  position: relative;
  max-width: 1200px;
  width: 100%;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  transition: transform 0.3s ease;
}
.image-frame:hover {
  transform: scale(1.02);
}
.main-image {
  width: 100%;
  display: block;
  object-fit: cover;
}

/* Overlay sutil */
.overlay-text {
  position: absolute;
  bottom: 15px;
  left: 20px;
  font-family: 'Cinzel', serif;
  font-size: 28px;
  color: var(--color-text-light);
  text-shadow: 1px 1px 6px rgba(0,0,0,0.4);
}
</style>
@endsection
