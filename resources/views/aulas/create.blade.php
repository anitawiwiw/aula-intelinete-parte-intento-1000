@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Crear Nueva Aula</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('aulas.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="nombre" class="form-label">Nombre del Aula</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <select class="form-control @error('ubicacion') is-invalid @enderror" 
                                    id="ubicacion" name="ubicacion" required>
                                <option value="">Seleccione una ubicación</option>
                                @for($i = 1; $i <= 7; $i++)
                                    <option value="{{ $i }}" {{ old('ubicacion') == $i ? 'selected' : '' }}>
                                        Edificio {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('ubicacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="capacidad" class="form-label">Capacidad</label>
                            <input type="number" class="form-control @error('capacidad') is-invalid @enderror" 
                                   id="capacidad" name="capacidad" value="{{ old('capacidad', 30) }}" min="1" required>
                            @error('capacidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('aulas.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Aula
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection