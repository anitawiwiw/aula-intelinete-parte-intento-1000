@extends('layouts.app')

@section('content')
<div class="background">
    <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
    <div class="form-container">
        <h1>Registrar Foco</h1>

        <form action="{{ route('focos.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="codigo">Código *</label>
                <input type="text" id="codigo" name="codigo" value="{{ old('codigo') }}" required>
            </div>

            <div class="form-group">
                <label for="aula_id">Aula</label>
                <select id="aula_id" name="aula_id">
                    <option value="">-- Selecciona un aula --</option>
                    @foreach($aulas as $aula)
                        <option value="{{ $aula->id }}" {{ old('aula_id') == $aula->id ? 'selected' : '' }}>{{ $aula->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select id="tipo" name="tipo">
                    <option value="LED" {{ old('tipo') == 'LED' ? 'selected' : '' }}>LED</option>
                    <option value="Fluorescente" {{ old('tipo') == 'Fluorescente' ? 'selected' : '' }}>Fluorescente</option>
                    <option value="Emergencia" {{ old('tipo') == 'Emergencia' ? 'selected' : '' }}>Emergencia</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ubicacion">Ubicación</label>
                <input type="text" id="ubicacion" name="ubicacion" value="{{ old('ubicacion') }}">
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select id="estado" name="estado">
                    <option value="Operativo" {{ old('estado') == 'Operativo' ? 'selected' : '' }}>Operativo</option>
                    <option value="Dañado" {{ old('estado') == 'Dañado' ? 'selected' : '' }}>Dañado</option>
                </select>
            </div>

            <div style="display:flex; justify-content: space-between; gap:10px;">
                <a href="{{ route('focos.index') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<style>
/* Estilos basados en el ejemplo de 'Crear Materia' */
.background {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    z-index: -1;
}
.background img {
    width: 100%; height: 100%;
    object-fit: cover;
    filter: blur(8px) brightness(0.9);
}
.form-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}
.form-container {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 600px;
}
.form-container h1 {
    text-align: center;
    color: #491c57;
    margin-bottom: 30px;
}
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #491c57;
}
.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    font-size: 16px;
}
.form-group textarea {
    resize: vertical;
    min-height: 100px;
}
.btn-primary {
    background-color: #6d3a7c;
    color: #FDF9F5;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    font-size: 16px;
    transition: background-color 0.3s;
}
.btn-primary:hover {
    background-color: #491c57;
}
.btn-secondary {
    background-color: #d8d3dd;
    color: #491c57;
    border: none;
    padding: 12px 25px;
    border-radius: 25px;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    font-size: 16px;
    transition: background-color 0.3s;
}
.btn-secondary:hover {
    background-color: #a87cb0;
    color: #FDF9F5;
}
</style>
@endsection

