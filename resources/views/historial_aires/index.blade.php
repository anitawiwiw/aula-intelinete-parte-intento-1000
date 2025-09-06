@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Historial de Aires</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Aire</th>
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
                <td>{{ $h->id }}</td>
                <td>{{ $h->aire?->marca_modelo ?? 'Aire '.$h->aire_id }}</td>
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
</div>
@endsection
