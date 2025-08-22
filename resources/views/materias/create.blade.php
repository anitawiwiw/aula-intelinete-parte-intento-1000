@extends('layouts.app')

@section('content')
<div class="background">
    <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
    <div class="form-container">
        <h1>Crear Materia</h1>

        <form action="{{ route('materias.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="carrera">Carrera</label>
                <select id="carrera" name="carrera" required>
                    <option value="Opcion 1">Opción 1</option>
                    <option value="Opcion 2">Opción 2</option>
                </select>
            </div>

            <div class="form-group">
                <label for="año">Año</label>
                <select id="año" name="año" required>
                    <option value="1A">1A</option>
                    <option value="1B">1B</option>
                    <option value="1C">1C</option>
                    <option value="2A">2A</option>
                    <option value="2B">2B</option>
                    <option value="2C">2C</option>
                    <option value="3A">3A</option>
                    <option value="3B">3B</option>
                    <option value="3C">3C</option>
                    <option value="4A">4A</option>
                    <option value="4B">4B</option>
                    <option value="5A">5A</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_cursada">Tipo de Cursada</label>
                <select id="tipo_cursada" name="tipo_cursada" required>
                    <option value="basica">Básica</option>
                    <option value="especializada">Especializada</option>
                </select>
            </div>

                       <div class="form-group">
    <label for="docentes">Docentes</label>
    <small style="display:block; color: #555; margin-bottom: 5px;">Mantén presionada la tecla Ctrl (o Cmd en Mac) para seleccionar varios docentes</small>
    <select id="docentes" name="docentes[]" multiple>
        @foreach($docentes as $docente)
            <option value="{{ $docente->id }}" {{ $materia->docentes->contains($docente->id) ? 'selected' : '' }}>
                {{ $docente->nombre_completo }}
            </option>
        @endforeach
    </select>
</div>

            <div style="display:flex; justify-content: space-between; gap:10px;">
                <a href="{{ route('materias.index') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary">Guardar Materia</button>
            </div>
        </form>
    </div>
</div>
@endsection
