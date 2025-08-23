@extends('layouts.app')

@section('content')
<div class="background">
    <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
    <div class="form-container">
        <h1>Editar Materia</h1>

        <form action="{{ route('materias.update', $materia->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $materia->nombre) }}" required>
            </div>

            <div class="form-group">
                <label for="carrera">Carrera</label>
                <select id="carrera" name="carrera" required>
                    <option value="Opcion 1" {{ $materia->carrera=='Opcion 1' ? 'selected' : '' }}>Opción 1</option>
                    <option value="Opcion 2" {{ $materia->carrera=='Opcion 2' ? 'selected' : '' }}>Opción 2</option>
                </select>
            </div>

            <div class="form-group">
                <label for="año">Año</label>
                <select id="año" name="año" required>
                    @foreach(['1A','1B','1C','2A','2B','2C','3A','3B','3C','4A','4B','5A'] as $ano)
                        <option value="{{ $ano }}" {{ $materia->año==$ano ? 'selected' : '' }}>{{ $ano }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_cursada">Tipo de Cursada</label>
                <select id="tipo_cursada" name="tipo_cursada" required>
                    <option value="basica" {{ $materia->tipo_cursada=='basica' ? 'selected' : '' }}>Básica</option>
                    <option value="especializada" {{ $materia->tipo_cursada=='especializada' ? 'selected' : '' }}>Especializada</option>
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
                <button type="submit" class="btn-primary">Actualizar Materia</button>
            </div>
        </form>
    </div>
</div>

<style>
.background img {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    object-fit: cover;
    z-index: -1;
    opacity: 0.5;
}

.form-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px 20px;
}

.form-container {
    background: white;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    max-width: 600px;
    width: 100%;
}

.form-container h1 {
    margin-bottom: 30px;
    font-size: 32px;
    color: #6d3a7c;
    text-align: center;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    color: #491c57;
    margin-bottom: 8px;
}

input, select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
}

.btn-primary {
    background-color: #6d3a7c;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #a87cb0;
}

.btn-secondary {
    background-color: #ccc;
    color: #491c57;
    padding: 12px 25px;
    border: none;
    border-radius: 25px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-secondary:hover {
    background-color: #bbb;
}
</style>
@endsection
