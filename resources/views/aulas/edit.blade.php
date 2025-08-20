@extends('layouts.app')

@section('content')
<div class="p-8 max-w-lg mx-auto">
  <h1 class="text-2xl font-bold mb-6">Editar Aula</h1>

  <form action="{{ route('aulas.update', $aula->id) }}" method="POST" onsubmit="return validarFormulario();">
    @csrf
    @method('PUT')

    <div class="mb-4">
      <label class="block text-gray-700">ID (no editable)</label>
      <input type="text" value="{{ $aula->id }}" disabled class="w-full border rounded px-3 py-2 bg-gray-200">
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Nombre</label>
      <input type="text" name="nombre" value="{{ $aula->nombre }}" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Ubicación (1-10)</label>
      <select name="ubicacion" class="w-full border rounded px-3 py-2" required>
        @for ($i=1; $i<=10; $i++)
          <option value="{{ $i }}" @if($aula->ubicacion == $i) selected @endif>{{ $i }}</option>
        @endfor
      </select>
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Capacidad (máx 35)</label>
      <input type="number" name="capacidad" value="{{ $aula->capacidad }}" max="35" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="flex gap-4">
      <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
        Guardar
      </button>
      <a href="{{ route('aulas.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
        Cancelar
      </a>
    </div>
  </form>
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
