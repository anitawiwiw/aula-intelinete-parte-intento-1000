@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de Aulas</h2>
        <a href="{{ route('aulas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Aula
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Capacidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aulas as $aula)
                    <tr>
                        <td>{{ $aula->nombre }}</td>
                        <td>Edificio {{ $aula->ubicacion }}</td>
                        <td>{{ $aula->capacidad }}</td>
                        <td>
                            <a href="{{ route('aulas.edit', $aula->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('aulas.destroy', $aula->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta aula?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No hay aulas registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection