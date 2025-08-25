<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app')

@section('content')
<div class="background">
    <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
    <div class="form-container">
        <h1>Registro</h1>

        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
            @csrf

            <div class="form-group">
                <label for="name">Nombre Completo</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autocomplete="name"
                >
            </div>

            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}" 
                    required 
                    autocomplete="username"
                >
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autocomplete="email"
                >
            </div>

            <div class="form-group" style="position:relative;">
                <label for="password">Contraseña</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    autocomplete="new-password"
                >
                <span 
                    class="password-toggle" 
                    id="togglePassword" 
                    title="Mostrar/Ocultar Contraseña"
                    onmousedown="showPassword('password')" 
                    onmouseup="hidePassword('password')" 
                    onmouseleave="hidePassword('password')"
                    style="position:absolute; right:10px; top:38px; cursor:pointer; user-select:none;"
                >👁️</span>
            </div>

            <div class="password-hint">
                La contraseña debe tener al menos 8 caracteres.
            </div>

            <div class="form-group" style="position:relative;">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                >
                <span 
                    class="password-toggle" 
                    id="togglePasswordConfirm" 
                    title="Mostrar/Ocultar Contraseña"
                    onmousedown="showPassword('password_confirmation')" 
                    onmouseup="hidePassword('password_confirmation')" 
                    onmouseleave="hidePassword('password_confirmation')"
                    style="position:absolute; right:10px; top:38px; cursor:pointer; user-select:none;"
                >👁️</span>
            </div>

            <div class="form-group">
                <label for="role">Rol</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Seleccioná un rol</option>
                    <option value="profesor" {{ old('role') == 'profesor' ? 'selected' : '' }}>Profesor</option>
                    <option value="administrador" {{ old('role') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>

            <div style="display:flex; justify-content: space-between; gap:10px; margin-top:15px;">
                <a href="{{ url('/') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary" id="submitBtn" disabled>Registrarse</button>
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
        width: 420px;
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
    .password-toggle { font-size:1.2rem; color:#888; }
    .password-hint { font-size:0.9rem; color:#888; margin-bottom:1.4rem; }
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
    function showPassword(id){ document.getElementById(id).type='text'; }
    function hidePassword(id){ document.getElementById(id).type='password'; }

    const submitBtn = document.getElementById('submitBtn');
    const inputs = [
        document.getElementById('name'),
        document.getElementById('username'),
        document.getElementById('email'),
        document.getElementById('password'),
        document.getElementById('password_confirmation'),
        document.getElementById('role'),
    ];

    function validateInputs(){
        const allFilled = inputs.every(input => {
            if(input.tagName==='SELECT') return input.value!=='';
            return input.value.trim()!=='';
        });
        const password = document.getElementById('password').value;
        const passConfirm = document.getElementById('password_confirmation').value;
        const passwordsMatch = password===passConfirm;
        submitBtn.disabled = !(allFilled && password.length>=8 && passwordsMatch);
    }

    inputs.forEach(input=>{
        input.addEventListener('input', validateInputs);
        if(input.tagName==='SELECT') input.addEventListener('change', validateInputs);
    });

    window.addEventListener('load', validateInputs);
</script>
@endsection
