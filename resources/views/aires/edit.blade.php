@extends('layouts.app')

@section('content')
<div class="background">
    <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
    <div class="form-container">
        <h1>Editar aire</h1>

        <form action="{{ route('aires.update', $aire) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="marca_modelo">Marca / Modelo</label>
                <input type="text" id="marca_modelo" name="marca_modelo" value="{{ old('marca_modelo', $aire->marca_modelo) }}" required>
            </div>

            <div class="form-group">
                <label for="aula_id">Aula</label>
                <select id="aula_id" name="aula_id">
                    <option value="">-- ninguno --</option>
                    @foreach($aulas as $aula)
                        <option value="{{ $aula->id }}" {{ old('aula_id', $aire->aula_id) == $aula->id ? 'selected' : '' }}>{{ $aula->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="ubicacion">Ubicación</label>
                <input type="text" id="ubicacion" name="ubicacion" value="{{ old('ubicacion', $aire->ubicacion) }}" required>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
                    <option value="operativo" {{ old('estado', $aire->estado) == 'operativo' ? 'selected' : '' }}>Operativo</option>
                    <option value="averiado" {{ old('estado', $aire->estado) == 'averiado' ? 'selected' : '' }}>Averiado</option>
                    <option value="mantenimiento" {{ old('estado', $aire->estado) == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ultima_mantenimiento">Última fecha de mantenimiento</label>
                <input type="date" id="ultima_mantenimiento" name="ultima_mantenimiento" value="{{ old('ultima_mantenimiento', $aire->ultima_mantenimiento?->format('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea id="observaciones" name="observaciones">{{ old('observaciones', $aire->observaciones) }}</textarea>
            </div>

            <div style="display:flex; justify-content: space-between; gap:10px;">
                <a href="{{ route('aires.index') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary">Actualizar</button>
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
