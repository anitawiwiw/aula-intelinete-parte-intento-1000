@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Reserva</h2>
    <form action="{{ route('docente.reservas.store') }}" method="POST">
        @csrf
        <label>Materia:</label>
        <select name="materia_id" required>
            @foreach($materias as $materia)
                <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
            @endforeach
        </select>

        <label>Aula:</label>
        <select name="aula_id" required>
            @foreach($aulas as $aula)
                <option value="{{ $aula->id }}">{{ $aula->nombre }}</option>
            @endforeach
        </select>

        <input type="text" name="dia" placeholder="Día de la semana" required>
        
        <label>Trimestre:</label>
        <select name="trimestre" required>
            <option value="1">1er Trimestre</option>
            <option value="2">2do Trimestre</option>
            <option value="3">3er Trimestre</option>
        </select>

        <button type="submit">Guardar</button>
    </form>
</div>
@endsection
