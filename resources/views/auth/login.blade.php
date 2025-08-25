<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app')

@section('content')
<div class="background">
    <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
    <div class="form-container">
        <h1>Iniciar Sesión</h1>

        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
            @csrf

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autocomplete="username"
                >
            </div>

            <div class="form-group" style="position:relative;">
                <label for="password">Contraseña</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    autocomplete="current-password"
                >
                <span 
                    class="password-toggle" 
                    id="togglePassword" 
                    title="Mostrar/Ocultar Contraseña"
                    onmousedown="showPassword()" 
                    onmouseup="hidePassword()" 
                    onmouseleave="hidePassword()"
                    style="position:absolute; right:10px; top:38px; cursor:pointer; user-select:none;"
                >👁️</span>
            </div>

            <div style="display:flex; justify-content: space-between; gap:10px; margin-top:15px;">
                <a href="{{ url('/') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary" id="submitBtn" disabled>Iniciar Sesión</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Mantener consistencia de estilos con "Crear Materia" */
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
        font-size: 2rem; 
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
    .form-group input { 
        width:100%; 
        padding:0.8rem 1rem; 
        border:2px solid #ddd; 
        border-radius:8px; 
        font-size:1rem; 
        transition:border-color 0.3s ease; 
    }
    .form-group input:focus { 
        border-color: #667eea; 
        outline:none; 
        box-shadow:0 0 6px rgba(102,126,234,0.4); 
    }
    .password-toggle { font-size:1.2rem; color:#888; }
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
</style>

<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const submitBtn = document.getElementById('submitBtn');
    const emailInput = document.getElementById('email');

    function showPassword(){ passwordInput.type='text'; }
    function hidePassword(){ passwordInput.type='password'; }

    function validateInputs(){
        submitBtn.disabled = emailInput.value.trim()==='' || passwordInput.value.trim()==='';
    }

    emailInput.addEventListener('input', validateInputs);
    passwordInput.addEventListener('input', validateInputs);
    window.addEventListener('load', validateInputs);
</script>
@endsection
