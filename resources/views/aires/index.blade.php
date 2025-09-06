@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Aires acondicionados</h1>

    <a href="{{ route('aires.create') }}" class="btn btn-primary mb-2">Crear aire</a>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca/Modelo</th>
                <th>Aula</th>
                <th>Ubicación</th>
                <th>Estado</th>
                <th>Últ. Mant.</th>
                <th>Última lectura</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aires as $aire)
            <tr>
                <td>{{ $aire->id }}</td>
                <td>{{ $aire->marca_modelo }}</td>
                <td>{{ optional($aire->aula)->nombre }}</td>
                <td>{{ $aire->ubicacion }}</td>
                <td>{{ $aire->estado }}</td>
                <td>{{ $aire->ultima_mantenimiento?->format('Y-m-d') }}</td>
                <td>
                    @if($aire->ultimoHistorial)
                        {{ $aire->ultimoHistorial->fecha }} - {{ $aire->ultimoHistorial->temperatura }}°C
                    @endif
                </td>
                <td>
                    <a href="{{ route('aires.edit', $aire) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('aires.destroy', $aire) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este aire?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $aires->links() }}
</div>
@endsection
