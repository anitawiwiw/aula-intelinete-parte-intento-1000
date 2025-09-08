@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historial del Aire: {{ $aire->marca_modelo }} (Aula: {{ $aire->aula?->nombre }})</h1>

    @if($historiales->count() > 0)
        <table class="table table-bordered">
            <div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">Último mantenimiento: 
            {{ $aire->fecha_ultimo_mantenimiento ?? 'No registrado' }}
        </h5>
        <p class="card-text">Ubicación: {{ $aire->ubicacion }}</p>
    </div>
</div>

            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Temperatura</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historiales as $h)
                <tr>
                    <td>{{ $h->fecha }}</td>
                    <td>{{ $h->hora_inicio }}</td>
                    <td>{{ $h->hora_fin }}</td>
                    <td>{{ $h->temperatura }}</td>
                    <td>{{ $h->estado }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $historiales->links() }}
    @else
        <div class="alert alert-info">No hay registros de historial para este aire.</div>
    @endif

    <a href="{{ route('aires.index') }}" class="btn btn-secondary mt-3">Volver a Aires</a>
</div>
@endsection
