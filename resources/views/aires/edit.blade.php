@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear aire</h1>

    <form action="{{ route('aires.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Marca / Modelo</label>
            <input name="marca_modelo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Aula</label>
            <select name="aula_id" class="form-control">
                <option value="">-- ninguno --</option>
                @foreach($aulas as $aula)
                    <option value="{{ $aula->id }}">{{ $aula->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Ubicación</label>
            <input name="ubicacion" class="form-control">
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <input name="estado" value="operativo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Última fecha de mantenimiento</label>
            <input type="date" name="ultima_mantenimiento" class="form-control">
        </div>

        <div class="mb-3">
            <label>Observaciones</label>
            <textarea name="observaciones" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Guardar</button>
        <a href="{{ route('aires.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
