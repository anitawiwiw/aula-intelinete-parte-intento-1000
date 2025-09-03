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
    <div class="user-name">{{ Auth::user()->name }}</div>



    <!-- Variables por defecto para evitar error -->
    @php
        $cursosDisponibles = $cursosDisponibles ?? ['1A','1B','1C','2A','2B','2C','3A','3B','3C','4A','4B','5A'];
        $trimestres = $trimestres ?? ['1er trimestre','2do trimestre','3er trimestre'];
        $curso = $curso ?? $cursosDisponibles[0];
        $trimestre = $trimestre ?? $trimestres[0];
           $gridManana = $gridManana ?? [];
    $gridTarde  = $gridTarde ?? [];
    @endphp

    <!-- Formulario de selección de curso y trimestre -->
    <div class="container">
        <h3>Seleccionar Curso y Trimestre</h3>
        <form action="{{ route('horarios.index') }}" method="GET" class="mb-4">
            <div class="form-group mb-2">
                <label for="curso">Curso:</label>
                <select name="curso" id="curso" class="form-control" onchange="this.form.submit()">
                    @foreach($cursosDisponibles as $c)
                    <option value="{{ $c }}" {{ ($curso == $c) ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="trimestre">Trimestre:</label>
                <select name="trimestre" id="trimestre" class="form-control" onchange="this.form.submit()">
                    @foreach($trimestres as $t)
                    <option value="{{ $t }}" {{ ($trimestre == $t) ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <noscript><button class="btn btn-primary" type="submit">Ver Horarios</button></noscript>
        </form>

        <hr>


    </div>
  </div>
</div>
<!-- Horarios Turno Mañana -->

<div class="table-container">
  <h3>Horario del curso {{ $curso }} - {{ $trimestre }}</h3>
  <h4>Turno Mañana</h4>
    <table class="horario-table">
        <thead>
            <tr>
                <th>Módulo</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
        </thead>
        <tbody>
            @php
                $slotsManana = [
                    1 => ['07:00','07:40'], 2 => ['07:40','08:15'], 'recreo1'=>['08:15','08:25'],
                    3 => ['08:25','09:05'], 4 => ['09:05','09:40'], 'recreo2'=>['09:40','09:50'],
                    5 => ['09:50','10:30'], 6 => ['10:30','11:05'], 'recreo3'=>['11:05','11:15'],
                    7 => ['11:15','11:55'], 8 => ['11:55','12:30']
                ];
            @endphp
            @foreach(array_keys($slotsManana) as $mod)
                @if(strpos($mod,'recreo')!==false)
                    <tr class="recreo-row">
                        <td colspan="6">Recreo ({{ $slotsManana[$mod][0] }} - {{ $slotsManana[$mod][1] }})</td>
                    </tr>
                @else
                    <tr>
                        <td class="modulo-cell">{{ $mod }}</td>
                        @for($d=1;$d<=5;$d++)
                            <td>
                                @if(!empty($gridManana[$mod][$d]))
                                    @foreach($gridManana[$mod][$d] as $cell)
                                        <div class="clase-block" style="background: {{ $cell['color'] ?? '#e6f7ff' }};">
                                            {{ $cell['nombre'] }}
                                        </div>
                                    @endforeach
                                @else
                                    <div class="clase-block" style="background:#f7f7f7;">&nbsp;</div>
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<!-- Horarios Turno Tarde -->

<div class="table-container">
  <h4>Turno Tarde</h4>
    <table class="horario-table">
        <thead>
            <tr>
                <th>Módulo</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
            </tr>
        </thead>
        <tbody>
            @php
                $slotsTarde = [
                    1 => ['13:00','13:40'], 2 => ['13:40','14:15'], 'recreo1'=>['14:15','14:25'],
                    3 => ['14:25','15:05'], 4 => ['15:05','15:40'], 'recreo2'=>['15:40','15:50'],
                    5 => ['15:50','16:30'], 6 => ['16:30','17:05'], 'recreo3'=>['17:05','17:15'],
                    7 => ['17:15','17:55'], 8 => ['17:55','18:30']
                ];
            @endphp
            @foreach(array_keys($slotsTarde) as $mod)
                @if(strpos($mod,'recreo')!==false)
                    <tr class="recreo-row">
                        <td colspan="6">Recreo ({{ $slotsTarde[$mod][0] }} - {{ $slotsTarde[$mod][1] }})</td>
                    </tr>
                @else
                    <tr>
                        <td class="modulo-cell">{{ $mod }}</td>
                        @for($d=1;$d<=5;$d++)
                            <td>
                                @if(!empty($gridTarde[$mod][$d]))
                                    @foreach($gridTarde[$mod][$d] as $cell)
                                        <div class="clase-block" style="background: {{ $cell['color'] ?? '#e6f7ff' }};">
                                            {{ $cell['nombre'] }}
                                        </div>
                                    @endforeach
                                @else
                                    <div class="clase-block" style="background:#f7f7f7;">&nbsp;</div>
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
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
  overflow-y: auto;
}

/* Top bar */
.top-bar {
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 60px;
    background: linear-gradient(90deg, var(--color-secondary), var(--color-primary));
    display: flex; 
    justify-content: space-between; 
    padding: 0 2rem; 
    align-items: center;
    z-index: 1000;
}

.top-bar .logo { height: 170px; }

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
  background-color: var(--color-background-main);
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Imagen principal decorada */
.image-container { width: 100%; display: flex; justify-content: center; }
.image-frame {
  position: relative;
  max-width: 1200px;
  width: 100%;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  transition: transform 0.3s ease;
}
.image-frame:hover { transform: scale(1.02); }
.main-image { width: 100%; display: block; object-fit: cover; }
.overlay-text {
  position: absolute;
  bottom: 15px;
  left: 20px;
  font-family: 'Cinzel', serif;
  font-size: 28px;
  color: var(--color-text-light);
  text-shadow: 1px 1px 6px rgba(0,0,0,0.4);
}

.selection-panel {
    background-color: var(--color-background-main);
    padding: 1.5rem 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    display: flex;
    flex-wrap: wrap; 
    gap: 1.5rem;
    align-items: center;
    margin-bottom: 2rem;
}

.selection-panel h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--color-text-dark);
    margin-right: 1rem;
    flex-shrink: 0;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--color-text-dark);
    margin-bottom: 0.5rem;
}
h1, h2, h3, h4, h5 {
    color: var(--color-text-dark);
}
/* Estilo personalizado para los selectores */
.custom-select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: var(--color-background-main);
    border: 1px solid var(--color-text-dark);
    border-radius: 8px;
    padding: 0.75rem 2.5rem 0.75rem 1rem;
    font-size: 1rem;
    color: var(--color-text-dark);
    cursor: pointer;
    min-width: 200px;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.custom-select:hover {
    border-color: var(--color-secondary);
}

.custom-select:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(109,58,124,0.3);
}

        /* Estilos para la tabla de horarios */
        .horario-table {

            width: 80%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden; /* Clave para que los bordes redondeados afecten a las celdas */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
/* Contenedor de la tabla para centrar con márgenes del 5% a ambos lados */
.table-container {
    margin-left: calc(200px + 5%); /* 200px del sidebar + 5% de espacio */
    margin-right: 5%;
    width: auto; /* Ajusta automáticamente según el contenido */
    overflow-x: auto; /* Scroll horizontal si es necesario */
}
.horario-table th,
.horario-table {
    width: 100%;
    border-collapse: collapse;
    background-color: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    table-layout: fixed; /* Para columnas más compactas y uniformes */
}
        
        /* Estilo de la cabecera de la tabla */
        .horario-table thead th {
            font-weight: 600;
            color: #333;
            padding: 1rem 0.5rem;
            border-bottom: 1px solid #E5E7EB;
        }

        /* Colores de cabecera específicos para cada día */
        .horario-table thead th:nth-child(2) { background-color: #D6EAF8; } /* Lunes - Azul Pastel */
        .horario-table thead th:nth-child(3) { background-color: #FADBD8; } /* Martes - Rojo Pastel */
        .horario-table thead th:nth-child(4) { background-color: #FDEBD0; } /* Miércoles - Naranja Pastel */
        .horario-table thead th:nth-child(5) { background-color: #D5F5E3; } /* Jueves - Verde Pastel */
        .horario-table thead th:nth-child(6) { background-color: #EAEDED; } /* Viernes - Gris Pastel */

        .horario-table tbody tr {
            border-bottom: 1px solid #F3F4F6; /* Líneas horizontales muy sutiles */
        }
        .horario-table tbody tr:last-child {
            border-bottom: none;
        }

        /* Celda del Módulo/Hora */
/* Celda del Módulo/Hora */
.modulo-cell {
    background-color: var(--color-background-sidebar);
    font-weight: 600;
    color: var(--color-secondary);
    font-size: 0.85rem;
    padding: 0.5rem 0.25rem;
}

/* Contenedor de la clase para controlar padding y estilos */
.clase-block {
    padding: 0.5rem 0.25rem;
    min-height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
}

/* Contenedor principal central de toda la vista */
.main-container {
    width: 80%;
    max-width: 1600px;
    margin: 0 auto;
    padding: 2rem 3rem;
    overflow-y: auto;
    flex-grow: 1;
}

/* Fila de Recreo */
.recreo-row {
    background-color: var(--color-secondary);
}

.recreo-row td {
    padding: 0.75rem;
    font-weight: 500;
    color: var(--color-text-light);
    font-size: 0.9em;
}
