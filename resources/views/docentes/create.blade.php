@extends('layouts.app')

@section('title', 'Registro de Docente')

@section('content')
<div class="background">
    <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
    <div class="form-container">
        <h1>COMPLETAR DATOS DE DOCENTE</h1>

        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert-success" style="margin-bottom:1rem; padding:0.8rem; border-radius:6px;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('docentes.store') }}" id="docenteForm">
            @csrf

            <div class="form-group">
                <label for="dni">DNI</label>
                <input 
                    type="text" 
                    id="dni" 
                    name="dni" 
                    maxlength="8" 
                    required 
                    placeholder="Ingrese su número de documento"
                >
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

            <div style="display:flex; justify-content: space-between; gap:10px; margin-top:15px;">
                <a href="{{ url('/') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary" id="submitBtn" disabled>GUARDAR DATOS</button>
            </div>
        </form>
    </div>
</div>

<style>
.form-wrapper { 
    display:flex; 
    justify-content:center; 
    align-items:center; 
    min-height:80vh; 
    padding:20px; 
}
.form-container {
    background: #fff;
    padding: 2.5rem 3rem;
    border-radius: 12px;
    box-shadow: 0 15px 25px rgba(0,0,0,0.2);
    width: 400px;
    max-width: 90vw;
    text-align: center;
}
h1 { 
    font-size: 1.8rem; 
    margin-bottom: 2rem; 
    color: #4b4b4b; 
}
.form-group { 
    margin-bottom: 1.5rem; 
    text-align:left; 
}
.form-group label { 
    display:block; 
    margin-bottom:0.5rem; 
    font-weight:600; 
    color:#555; 
}
.form-group input, .form-group select { 
    width:100%; 
    padding:0.8rem 1rem; 
    border:2px solid #ddd; 
    border-radius:8px; 
    font-size:1rem; 
    transition:border-color 0.3s ease; 
}
.form-group input:focus, .form-group select:focus { 
    border-color: #667eea; 
    outline:none; 
    box-shadow:0 0 6px rgba(102,126,234,0.4); 
}
.btn-primary { 
    background:#667eea; 
    color:#fff; 
    font-weight:600; 
    padding:0.9rem 1rem; 
    border-radius:8px; 
    border:none; 
    cursor:pointer; 
    flex:1; 
}
.btn-primary:hover { background:#5563d6; }
.btn-primary:disabled { background:#aaa; cursor:default; }
.btn-secondary { 
    background:#eee; 
    color:#333; 
    padding:0.9rem 1rem; 
    border-radius:8px; 
    text-decoration:none; 
    flex:1; 
    text-align:center; 
}
.btn-secondary:hover { background:#ddd; }
.error-message { 
    background:#ffeded; 
    color:#cc0033; 
    padding:0.8rem 1rem; 
    border-radius:6px; 
    font-weight:600; 
    margin-bottom:1rem; 
}
.alert-success { 
    background: rgba(46, 125, 50, 0.2); 
    border: 1px solid rgba(46, 125, 50, 0.5); 
    color: #2e7d32; 
    padding:0.8rem; 
    border-radius:6px; 
}
</style>

@push('scripts')
<script>
const submitBtn = document.getElementById('submitBtn');
const form = document.getElementById('docenteForm');

function validateForm() {
    const dni = document.getElementById('dni').value.trim();
    const especialidad = document.getElementById('especialidad').value.trim();

    submitBtn.disabled = !(dni && especialidad);
}

form.querySelectorAll('input, select').forEach(el => {
    el.addEventListener('input', validateForm);
    el.addEventListener('change', validateForm);
});

window.addEventListener('load', validateForm);
</script>
@endpush
