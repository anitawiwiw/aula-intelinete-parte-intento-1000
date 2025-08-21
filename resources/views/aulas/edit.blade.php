@extends('layouts.app')

@section('content')
<div class="background">
  <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
  <div class="form-container">
    <h1>Editar Aula</h1>

    <div class="map-box">
      <img src="{{ asset('images/aulas.jpeg') }}" alt="Mapa de Aulas">
    </div>

    <form action="{{ route('aulas.update', $aula->id) }}" method="POST" onsubmit="return validarFormulario();">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label>ID (no editable)</label>
        <input type="text" value="{{ $aula->id }}" disabled>
      </div>

      <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ $aula->nombre }}" required>
      </div>

      <div class="form-group">
        <label>Ubicación (1-10)</label>
        <select name="ubicacion" required>
          @for ($i=1; $i<=10; $i++)
            <option value="{{ $i }}" @if($aula->ubicacion == $i) selected @endif>{{ $i }}</option>
          @endfor
        </select>
      </div>

      <div class="form-group">
        <label>Capacidad (máx 35)</label>
        <input type="number" name="capacidad" value="{{ $aula->capacidad }}" max="35" required>
      </div>

      <div style="display:flex; justify-content: space-between; gap:10px;">
        <a href="{{ route('aulas.index') }}" class="btn-secondary">Cancelar</a>
        <button type="submit" class="btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>

<script>
  function validarFormulario() {
    const capacidad = document.querySelector('input[name="capacidad"]').value;
    if (capacidad > 35) {
      alert("La capacidad máxima es 35.");
      return false;
    }
    return true;
  }
</script>
@endsection
