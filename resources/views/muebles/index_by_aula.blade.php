@extends('layouts.app')

@section('content')
<div class="top-bar">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    <a href="{{ route('home_de_admins') }}">home</a>
</div>

<div class="main-container">
    <div class="sidebar">
        <a href="{{ route('aulas.index') }}" class="sidebar-button">Aulas</a>
        <a href="{{ route('docentes.index') }}" class="sidebar-button">Docentes</a>
        <a href="{{ route('materias.index') }}" class="sidebar-button">Materias</a>
        <a href="{{ route('reservas.index') }}" class="sidebar-button">Reservas</a>
        <a href="{{ route('aires.index') }}" class="sidebar-button">Aires Acondicionados</a>
        <a href="{{ route('focos.index') }}" class="sidebar-button">Focos</a>
        <a href="{{ route('muebles.index') }}" class="sidebar-button">Muebles</a>
    </div>

    <div class="content-area">
        <div class="historial-container">
            <div class="header-historial">
                <h1 class="historial-title">Muebles del Aula</h1>
                <div class="historial-details">
                    <div class="details-box">
                        <span class="label">Aula:</span> {{ $aula->nombre }}
                    </div>
                    <div class="details-box">
                        <span class="label">Total de muebles:</span> {{ $muebles->count() }}
                    </div>
                    <div class="details-box">
                        <a href="{{ route('muebles.createByAula', $aula->id) }}" class="create-button">
                            Registrar nuevo mueble
                        </a>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert-section">
                    <div class="alert alert-success">{{ session('success') }}</div>
                </div>
            @endif

            <div class="table-section scrollable-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Número Inventario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($muebles as $mueble)
                            <tr>
                                <td>{{ $mueble->id }}</td>
                                <td>{{ $mueble->nombre }}</td>
                                <td>
                                    <span class="estado-badge estado-{{ strtolower($mueble->estado) }}">
                                        {{ $mueble->estado }}
                                    </span>
                                </td>
                                <td>{{ $mueble->numero_inventario }}</td>
                                <td class="acciones-cell">
                                    <a href="{{ route('muebles.edit', $mueble) }}" class="edit-button">Editar</a>
                                    <form action="{{ route('muebles.destroy', $mueble) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este mueble?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="delete-button">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="no-data">No hay muebles registrados en este aula</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-section">
                {{ $muebles->links() }}
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
        --color-success: #28a745;
        --color-warning: #ffc107;
        --color-danger: #dc3545;
    }
    body {
        font-family: Arial, sans-serif;
        margin: 0; padding: 0;
        background-color: var(--color-background-main);
        display: flex; flex-direction: column;
    }
    .scrollable-table {
        max-height: 600px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        background-color: rgba(255, 255, 255, 0.9);
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
        padding: 8px 16px;
        border-radius: 20px;
        transition: background-color 0.3s;
    }
    .top-bar a:hover {
        background-color: rgba(255, 255, 255, 0.2);
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
        transition: background-color 0.3s;
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
        max-width: 1200px;
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
        font-size: 3rem;
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
        font-weight: 500;
    }
    .details-box .label {
        font-weight: bold;
        color: var(--color-primary);
    }
    .create-button {
        background-color: var(--color-primary);
        color: var(--color-text-light);
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s;
        border: none;
        cursor: pointer;
        display: inline-block;
    }
    .create-button:hover {
        background-color: var(--color-secondary);
        color: var(--color-text-light);
        text-decoration: none;
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
        background-color: var(--color-secondary);
        color: var(--color-text-dark);
        font-weight: bold;
        text-transform: uppercase;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    tr:nth-child(even) { background-color: #f9f9f9; }
    tr:hover { background-color: #e6e6e6; }
    td {
        color: var(--color-text-dark);
    }
    .estado-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 0.85em;
    }
    .estado-óptimo { background-color: var(--color-success); color: white; }
    .estado-regular { background-color: var(--color-warning); color: black; }
    .estado-defectuoso { background-color: var(--color-danger); color: white; }
    .acciones-cell {
        display: flex;
        gap: 10px;
        justify-content: center;
        align-items: center;
    }
    .edit-button {
        background-color: var(--color-warning);
        color: black;
        padding: 8px 16px;
        border-radius: 20px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s;
        border: none;
        cursor: pointer;
        font-size: 0.9em;
    }
    .edit-button:hover {
        background-color: #e0a800;
        color: black;
        text-decoration: none;
    }
    .delete-button {
        background-color: var(--color-danger);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        border: none;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s;
        font-size: 0.9em;
    }
    .delete-button:hover {
        background-color: #c82333;
    }
    .no-data {
        text-align: center;
        color: var(--color-text-dark);
        font-style: italic;
        padding: 30px;
    }
    .alert-section {
        margin-bottom: 30px;
    }
    .alert {
        padding: 15px 25px;
        border-radius: 15px;
        font-weight: bold;
        text-align: center;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .pagination-section {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }
    .pagination-section .pagination {
        display: flex;
        gap: 10px;
    }
    .pagination-section .page-link {
        padding: 8px 16px;
        border-radius: 20px;
        background-color: var(--color-background-sidebar);
        color: var(--color-text-dark);
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s;
    }
    .pagination-section .page-link:hover {
        background-color: var(--color-secondary);
        color: var(--color-text-light);
    }
    .pagination-section .page-item.active .page-link {
        background-color: var(--color-primary);
        color: var(--color-text-light);
    }
</style>
@endsection