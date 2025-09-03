@extends('layouts.app_de_profes')

@section('content')
<div class="background">
    <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
    <div class="form-container">
        <h1>Crear Materia</h1>

        <form action="{{ route('materias.store_de_profes') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="carrera">Carrera</label>
                <select id="carrera" name="carrera" required>
                    <option value="Opcion 1" {{ old('carrera')=='Opcion 1' ? 'selected' : '' }}>Opción 1</option>
                    <option value="Opcion 2" {{ old('carrera')=='Opcion 2' ? 'selected' : '' }}>Opción 2</option>
                </select>
            </div>

            <div class="form-group">
                <label for="año">Año</label>
                <select id="año" name="año" required>
                    @foreach(['1A','1B','1C','2A','2B','2C','3A','3B','3C','4A','4B','5A'] as $ano)
                        <option value="{{ $ano }}" {{ old('año')==$ano ? 'selected' : '' }}>{{ $ano }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_cursada">Tipo de Cursada</label>
                <select id="tipo_cursada" name="tipo_cursada" required>
                    <option value="basica" {{ old('tipo_cursada')=='basica' ? 'selected' : '' }}>Básica</option>
                    <option value="especializada" {{ old('tipo_cursada')=='especializada' ? 'selected' : '' }}>Especializada</option>
                </select>
            </div>

            <div class="form-group">
                <label for="docentes">Docentes</label>
                <small style="display:block; color: #555; margin-bottom: 5px;">Mantén presionada la tecla Ctrl (o Cmd en Mac) para seleccionar varios docentes</small>
                <select id="docentes" name="docentes[]" multiple>
                    @foreach($docentes as $docente)
                        <option value="{{ $docente->id }}" 
                            {{ collect(old('docentes'))->contains($docente->id) ? 'selected' : '' }}>
                            {{ $docente->nombre_completo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex; justify-content: space-between; gap:10px;">
                <a href="{{ route('docentes.home_de_docentes') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary">Guardar Materia</button>
            </div>
        </form>
    </div>
</div>
@endsection

