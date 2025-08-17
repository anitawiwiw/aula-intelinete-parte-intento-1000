@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Reserva</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $reserva->nombre_materia }}</h5>
            <p class="card-text">
                <strong>Aula:</strong> {{ $reserva->aula->nombre }}<br>
                <strong>Ubicación:</strong> {{ $reserva->aula->ubicacion }}<br>
                <strong>Día:</strong> {{ $reserva->dia }}<br>
                <strong>Hora Inicio:</strong> {{ $reserva->hora_inicio }}<br>
                <strong>Hora Fin:</strong> {{ $reserva->hora_fin }}<br>
                <strong>Estado:</strong> {{ $reserva->estado }}<br>
            </p>
            
            <h6>Docentes:</h6>
            <ul>
                @foreach($reserva->docentes as $docente)
                    <li>{{ $docente->name }}</li>
                @endforeach
            </ul>
            
            <h6>Materias:</h6>
            <ul>
                @foreach($reserva->materias as $materia)
                    <li>{{ $materia->nombre }} ({{ $materia->tipo_cursada }})</li>
                @endforeach
            </ul>
            
            <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
            <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection