@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historial de Focos</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foco</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Intensidad</th>
            </tr>
        </thead>
        <tbody>
            @forelse($historiales as $h)
            <tr>
                <td>{{ $h->id }}</td>
                <td>{{ $h->foco?->ubicacion ?? 'Foco '.$h->foco_id }}</td>
                <td>{{ $h->fecha }}</td>
                <td>{{ $h->hora_inicio }}</td>
                <td>{{ $h->hora_fin }}</td>
                <td>{{ $h->intensidad }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No hay registros aún.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $historiales->links() }}
</div>
@endsection
