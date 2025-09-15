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
    </div>

    <div class="content-area">
        <div class="header-section">
            <div class="header-left">
                <h1 class="header-title">Focos</h1>
                <a href="{{ route('focos.create') }}">
                    <button class="create-button">Registrar foco</button>
                </a>
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
                        <th>Código</th>
                        <th>Aula</th>
                        <th>Tipo</th>
                        <th>Ubicación</th>
                        <th>Estado</th>
                        <th>Última lectura</th>
                        <th>Historial</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($focos as $foco)
                        <tr>
                            <td>{{ $foco->id }}</td>
                            <td>{{ $foco->codigo }}</td>
                            <td>{{ $foco->aula->nombre ?? 'Sin asignar' }}</td>
                            <td>{{ $foco->tipo }}</td>
                            <td>{{ $foco->ubicacion }}</td>
                            <td>{{ $foco->estado }}</td>
                            <td>
                                @if($foco->ultimoHistorial)
                                    {{ $foco->ultimoHistorial->fecha }}
                                @endif
                            </td>
                            <td>
                            <a href="{{ route('historial_focos.by_foco', $foco->id) }}" class="historial-button">Historial</a>

</td>
                            <td>
                                <a href="{{ route('focos.edit', $foco) }}" class="edit-button">Editar</a>
                                <form action="{{ route('focos.destroy', $foco) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar este foco?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="delete-button">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No hay focos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-section">
            {{ $focos->links() }}
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
    .scrollable-table {
        max-height: 500px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-radius: 8px;
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
        margin-left: 70%;
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
    .historial-button {
        background-color: #ffd75fff;
        color: #212529;
        padding: 6px 12px;
        border-radius: 5px;
        text-decoration: none;
        margin-right: 8px;
    }
    .historial-button:hover {
        background-color: #ffd75fff;
    }
    .delete-button {
        background-color: #e3342f; color: white;
        padding: 6px 12px; border: none;
        border-radius: 5px; cursor: pointer;
        margin-left: 8px;
    }
    .delete-button:hover { background-color: #cc1f1a; }
    .alert-section {
        margin-bottom: 20px;
    }
    .alert {
        padding: 10px;
        border-radius: 5px;
        font-weight: bold;
        text-align: center;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }
    .pagination-section {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
</style>
@endsection