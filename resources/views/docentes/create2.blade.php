@extends('layouts.app')

@section('content')
<div class="background">
  <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
  <div class="form-container">
    <h1>Crear Docente</h1>

    <form action="{{ route('docentes.store2') }}" method="POST">
      @csrf

      <!-- ID de usuario (oculto o fijo en 0 si lo crea un admin) -->
      <input type="hidden" name="user_id" value="0">

      <div class="form-group">
        <label for="nombre_completo">Nombre Completo</label>
        <input type="text" id="nombre_completo" name="nombre_completo" value="{{ old('nombre_completo') }}" required>
      </div>

      <div class="form-group">
        <label for="dni">DNI</label>
        <input type="text" id="dni" name="dni" value="{{ old('dni') }}" maxlength="8" required>
      </div>

   <div class="form-group">
                    <label for="especialidad">ESPECIALIDAD</label>
                    <select id="especialidad" name="especialidad" required>
                        <option value="">SELECCIONE UNA ESPECIALIDAD</option>
                        <option value="Robótica">ROBÓTICA</option>
                        <option value="Informática">INFORMÁTICA</option>
                        <option value="Ciencias Naturales">CIENCIAS NATURALES</option>
                        <option value="Ciencias Exactas">CIENCIAS EXACTAS</option>
                        <option value="Ciencias Sociales">CIENCIAS SOCIALES</option>
                        <option value="Lengua">LENGUA</option>
                        <option value="Lengua Extranjera">LENGUA EXTRANJERA</option>
                        <option value="Artes">ARTES</option>
                    </select>
                </div>

      <div style="display:flex; justify-content: space-between; gap:10px;">
        <a href="{{ route('docentes.index') }}" class="btn-secondary">Cancelar</a>
        <button type="submit" class="btn-primary">Guardar Docente</button>
      </div>
    </form>
  </div>
</div>
@endsection

