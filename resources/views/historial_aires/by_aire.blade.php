@extends('layouts.app')

@section('content')
<div class="top-bar">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    <a href="{{ route('home_de_admins') }}">home</a>
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
        <div class="historial-container">
            <div class="header-historial">
                <h1 class="historial-title">Historial del Aire Acondicionado</h1>
                <div class="historial-details">
                    <div class="details-box">
                        <span class="label">Marca / Modelo:</span> {{ $aire->marca_modelo }}
                    </div>
                    <div class="details-box">
                        <span class="label">Aula:</span> {{ $aire->aula?->nombre ?? 'N/A' }}
                    </div>
                    <div class="details-box">
                        <span class="label">Ubicación:</span> {{ $aire->ubicacion }}
                    </div>
                </div>
            </div>

            <div class="table-and-info-container">
                <div class="table-section scrollable-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora Inicio</th>
                                <th>Hora Fin</th>
                                <th>Temperatura (°C)</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($historiales as $h)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($h->fecha)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($h->hora_inicio)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($h->hora_fin)->format('H:i') }}</td>
                                <td>{{ $h->temperatura }}</td>
                                <td>{{ ucfirst($h->estado) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No hay registros de historial para este aire.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="sidebar-info-section">
                    <div class="sidebar-info-box">
                        <h3>Resumen del Aire</h3>
                        <p><strong>Último mantenimiento:</strong> {{ $aire->ultima_mantenimiento?->format('d/m/Y') ?? 'No registrado' }}</p>
                        <p><strong>Observaciones:</strong> {{ $aire->observaciones ?? 'No hay observaciones' }}</p>
                        <p><strong>Estado Actual:</strong> {{ ucfirst($aire->estado) }}</p>
                    </div>
                </div>
            </div>

            <div class="pagination-section">
                {{ $historiales->links() }}
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
    --color-yellow-button: #ffc107;
}
body {
    font-family: Arial, sans-serif;
    margin: 0; padding: 0;
    background-color: var(--color-background-main);
    display: flex; flex-direction: column;
}
.scrollable-table {
    max-height: 500px;
    overflow-y: auto;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}
.scrollable-table table {
    width: 100%;
    border-collapse: collapse;
}

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
.top-bar a {
    color: var(--color-text-light);
    text-decoration: none;
    font-weight: bold;
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
    color: var(--color-text-light);
    text-decoration: none;
    font-weight: bold;
}
.sidebar-button:hover {
    background-color: var(--color-secondary);
}

.content-area {
    margin-left: 200px;
    padding: 70px;
    flex-grow: 1;
    background-image: linear-gradient(135deg, rgba(216, 211, 221, 0.4), rgba(249, 249, 249, 0.4));
}

.historial-container {
    max-width: 1200px; /* Aumentado para que sea más grande */
    margin: 0 auto;
}

.header-historial {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    margin-bottom: 40px;
    text-align: center;
}
.historial-title {
    font-family: 'Cinzel', serif;
    font-size: 3rem; /* Aumentado el tamaño del título */
    color: var(--color-primary);
    margin-bottom: 15px;
}
.historial-details {
    display: flex;
    justify-content: center;
    gap: 25px;
    flex-wrap: wrap;
}
.details-box {
    background-color: var(--color-background-sidebar);
    padding: 15px 30px;
    border-radius: 15px;
    color: var(--color-text-dark);
}
.details-box .label {
    font-weight: bold;
}

.table-and-info-container {
    display: flex;
    gap: 30px;
}
.table-section {
    flex-grow: 1;
}

.sidebar-info-section {
    width: 350px; /* Aumentado el tamaño de la barra lateral de info */
    flex-shrink: 0;
}
.sidebar-info-box {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    text-align: center;
}
.sidebar-info-box h3 {
    font-size: 1.5rem; /* Aumentado el tamaño del subtítulo */
    color: var(--color-primary);
    margin-bottom: 20px;
}
.sidebar-info-box p {
    color: var(--color-text-dark);
    margin: 8px 0;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 15px;
    border-radius: 8px;
    overflow: hidden;
}
th, td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}
th {
    background-color: var( --color-secondary);
    color: var(--color-text-dark);
    font-weight: bold;
    text-transform: uppercase;
}
tr:nth-child(even) { background-color: #f9f9f9; }
tr:hover { background-color: #e6e6e6; }
td {
    color: var(--color-text-dark);
}

.pagination-section {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}
</style>
@endsection
