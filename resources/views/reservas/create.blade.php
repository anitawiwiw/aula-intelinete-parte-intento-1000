@extends('layouts.app')

@section('title', 'Crear Reserva')

@push('styles')
<style>
    /* Fondo específico para el formulario */
    .form-page-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("{{ asset('images/boliviainteligente-QPu42AAJ5ZY-unsplash.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: -2;
    }
    
    .form-page-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }
    
    .form-container-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 2rem;
    }
    
    .form-container {
        width: 100%;
        max-width: 420px;
        background-color: rgba(50, 45, 60, 0.85);
        border: 1px solid #a0a0a0;
        padding: 2.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        border-radius: 8px;
        backdrop-filter: blur(4px);
    }
    
    /* Resto de tus estilos... */
    h1 {
        color: #d0d0d0;
        text-align: center;
        margin-bottom: 2rem;
        font-weight: 400;
        font-size: 1.5rem;
        letter-spacing: 0.5px;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    label {
        display: block;
        margin-bottom: 0.5rem;
        color: #c0c0c0;
        font-size: 0.9rem;
        letter-spacing: 0.3px;
    }
    
    input, select {
        width: 100%;
        padding: 0.8rem;
        background-color: rgba(70, 65, 80, 0.5);
        border: 1px solid #808080;
        color: #f0f0f0;
        font-size: 0.95rem;
        border-radius: 4px;
        transition: all 0.25s;
    }
    
    input:focus, select:focus {
        outline: none;
        border-color: #4fc3f7;
        box-shadow: 0 0 0 2px rgba(79, 195, 247, 0.2);
    }
    
    button {
        width: 100%;
        padding: 1rem;
        background-color: #606070;
        border: none;
        color: #e0e0e0;
        font-size: 1rem;
        font-weight: 500;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.25s;
        margin-top: 1rem;
        letter-spacing: 0.5px;
    }
    
    button:not(:disabled):hover {
        background-color: #4fc3f7;
        color: #ffffff;
    }
    
    button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    .alert {
        padding: 0.8rem 1rem;
        margin-bottom: 1.5rem;
        border-radius: 4px;
        font-size: 0.9rem;
    }
    
    .alert-success {
        background-color: rgba(46, 125, 50, 0.2);
        border: 1px solid rgba(46, 125, 50, 0.5);
        color: #a5d6a7;
    }
    
    .alert-error {
        background-color: rgba(198, 40, 40, 0.2);
        border: 1px solid rgba(198, 40, 40, 0.5);
        color: #ef9a9a;
    }
</style>
@endpush

@section('content')
    <!-- Fondo específico para esta página -->
    <div class="form-page-background"></div>
    <div class="form-page-overlay"></div>
    
    <div class="form-container-wrapper">
        <div class="form-container">
            <h1>CREAR RESERVA</h1>

            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('reservas.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="fecha">FECHA</label>
                    <input type="date" id="fecha" name="fecha" required 
                           min="2025-01-01" max="2030-12-31">
                </div>

                <div class="form-group">
                    <label for="hora_inicio">HORA INICIO</label>
                    <input type="time" id="hora_inicio" name="hora_inicio" required
                           min="07:00" max="22:00">
                </div>

                <div class="form-group">
                    <label for="hora_fin">HORA FIN</label>
                    <input type="time" id="hora_fin" name="hora_fin" required
                           min="07:00" max="22:00">
                </div>

                <div class="form-group">
                    <label for="materia">MATERIA</label>
                    <select id="materia" name="materia" required>
                        <option value="">SELECCIONE</option>
                        <option value="Matemáticas">MATEMÁTICAS</option>
                        <option value="Física">FÍSICA</option>
                        <option value="Química">QUÍMICA</option>
                    </select>
                </div>

                <button type="submit" id="submitBtn">CREAR RESERVA</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function validateForm() {
        const form = document.forms[0];
        const submitBtn = form.querySelector('button[type="submit"]');
        let isValid = true;

        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value) {
                isValid = false;
            }
        });

        const fechaInput = form.querySelector('#fecha');
        if (fechaInput.value) {
            const year = new Date(fechaInput.value).getFullYear();
            if (year < 2025 || year > 2030) {
                isValid = false;
            }
        }

        const horaInicio = form.querySelector('#hora_inicio').value;
        const horaFin = form.querySelector('#hora_fin').value;
        if (horaInicio && horaFin) {
            const inicioHour = parseInt(horaInicio.split(':')[0]);
            const finHour = parseInt(horaFin.split(':')[0]);
            
            if (inicioHour < 7 || inicioHour >= 22 || 
                finHour < 7 || finHour > 22) {
                isValid = false;
            }
        }

        submitBtn.disabled = !isValid;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.forms[0];
        form.querySelectorAll('input, select').forEach(element => {
            element.addEventListener('input', validateForm);
            element.addEventListener('change', validateForm);
        });
        validateForm();
    });
</script>
@endpush
