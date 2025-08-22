@extends('layouts.app')

@section('content')
<div class="background">
  <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
  <div class="form-container">
    <h1>Crear Aula</h1>

    <div class="map-box">
      <img src="{{ asset('images/aulas.jpeg') }}" alt="Mapa de Aulas">
    </div>

    <form action="{{ route('aulas.store') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="nombre">Nombre del Aula</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
      </div>

      <div class="form-group">
        <label for="ubicacion">Ubicación</label>
        <select id="ubicacion" name="ubicacion" required>
          <option value="">Seleccione una ubicación</option>
          @for($i = 1; $i <= 9; $i++)
            <option value="{{ $i }}" {{ old('ubicacion') == $i ? 'selected' : '' }}>Aula {{ $i }}</option>
          @endfor
        </select>
      </div>

      <div class="form-group">
        <label for="capacidad">Capacidad (máx 35)</label>
        <input type="number" id="capacidad" name="capacidad" value="{{ old('capacidad', 30) }}" min="1" max="35" required>
      </div>

      <div style="display:flex; justify-content: space-between; gap:10px;">
        <a href="{{ route('aulas.index') }}" class="btn-secondary">Cancelar</a>
        <button type="submit" class="btn-primary">Guardar Aula</button>
      </div>
    </form>
  </div>
</div>
@endsection
