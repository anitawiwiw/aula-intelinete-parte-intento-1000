@extends('layouts.app')

@section('title', 'Seleccionar Curso - Horarios')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Seleccionar Curso</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('horarios.select') }}" method="GET">
                        <div class="mb-3">
                            <label for="curso" class="form-label">Seleccione el curso:</label>
                            <select class="form-select form-select-lg" id="curso" name="curso" required>
                                <option value="">-- Seleccione --</option>
                                <optgroup label="1er Año">
                                    <option value="1A">1° A</option>
                                    <option value="1B">1° B</option>
                                    <option value="1C">1° C</option>
                                </optgroup>
                                <optgroup label="2do Año">
                                    <option value="2A">2° A</option>
                                    <option value="2B">2° B</option>
                                    <option value="2C">2° C</option>
                                </optgroup>
                                <optgroup label="3er Año">
                                    <option value="3A">3° A</option>
                                    <option value="3B">3° B</option>
                                    <option value="3C">3° C</option>
                                </optgroup>
                                <optgroup label="4to Año">
                                    <option value="4A">4° A</option>
                                    <option value="4B">4° B</option>
                                </optgroup>
                                <optgroup label="5to Año">
                                    <option value="5A">5° A</option>
                                </optgroup>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">Ver Horario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection