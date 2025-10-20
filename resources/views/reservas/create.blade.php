@extends('layouts.app')

@section('content')
<div class="background">
    <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
    <div class="form-container">
        <h1>Crear Reserva</h1>

        <form id="formReserva" action="{{ route('reservas.store') }}" method="POST">
            @csrf
<div class="form-wrapper">
    <div class="form-container">
        <h1>Crear Reserva</h1>

        <form id="formReserva" action="{{ route('reservas.store') }}" method="POST">
            @csrf

            {{-- Aula --}}
            <div class="form-group">
                <label>Aula</label>
                <select name="aula_id" required>
                    <option value="">— Elegir —</option>
                    @foreach($aulas as $a)
                        <option value="{{ $a->id }}" @selected(old('aula_id') == $a->id)>
                            {{ $a->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Materia --}}
            <div class="form-group">
                <label>Materia</label>
                <select name="materia_id" required>
                    <option value="">— Elegir —</option>
                    @foreach($materias as $m)
                        <option value="{{ $m->id }}" @selected(old('materia_id')==$m->id)>{{ $m->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Tipo origen --}}
            <div class="form-group">
                <label>Tipo origen</label>
                <select name="tipo_origen" required>
                    @foreach($tipos as $k=>$v)
                        <option value="{{ $k }}" @selected(old('tipo_origen')==$k)>{{ $v }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Trimestre --}}
            <div class="form-group">
                <label>Trimestre</label>
                <select name="trimestre" required>
                    <option value="">— Elegir —</option>
                    @foreach($trimestres as $trimestre)
                        <option value="{{ $trimestre }}" @selected(old('trimestre')==$trimestre)>{{ $trimestre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Campos ocultos para módulo seleccionado --}}
            <input type="hidden" name="dia" value="{{ request('dia') }}">
            <input type="hidden" name="turno" value="{{ request('turno') }}">
            <input type="hidden" name="hora_inicio" value="{{ request('hora_inicio') }}">
            <input type="hidden" name="hora_fin" value="{{ request('hora_fin') }}">

            <div id="mensaje-reserva" style="color:red; font-weight:bold; margin:10px 0; white-space:pre-line;"></div>

            <div style="display:flex; justify-content: space-between; gap:10px;">
                <a href="{{ route('reservas.index') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary">Guardar Reserva</button>
            </div>
        </form>
    </div>
</div>

<script>
function cargarHorarios() {
    let turno = document.getElementById('turno').value;
    let inicioSelect = document.getElementById('hora_inicio');
    let finSelect = document.getElementById('hora_fin');
    inicioSelect.innerHTML = "<option value=''>— Elegir —</option>";
    finSelect.innerHTML = "<option value=''>— Elegir —</option>";

    let horarios = [];
if (turno === "maniana") {
    horarios = [
        ["07:00","07:40"],["07:40","08:15"],
        ["08:25","09:05"],["09:05","09:40"],
        ["09:50","10:30"],["10:30","11:05"],
        ["11:15","11:55"],["11:55","12:30"]
    ];
} else if (turno === "tarde") {
    horarios = [
        ["13:00","13:40"],["13:40","14:15"],
        ["14:25","15:05"],["15:05","15:40"],
        ["15:50","16:30"],["16:30","17:05"],
        ["17:15","17:55"],["17:55","18:30"]
    ];
}

    horarios.forEach(h => {
        let optionInicio = document.createElement("option");
        optionInicio.value = h[0];
        optionInicio.textContent = h[0];
        if (h[0] === "{{ old('hora_inicio', $reserva->hora_inicio ?? '') }}") optionInicio.selected = true;
        inicioSelect.appendChild(optionInicio);

        let optionFin = document.createElement("option");
        optionFin.value = h[1];
        optionFin.textContent = h[1];
        if (h[1] === "{{ old('hora_fin', $reserva->hora_fin ?? '') }}") optionFin.selected = true;
        finSelect.appendChild(optionFin);
    });
}

// Cargar horarios automáticamente si ya hay turno seleccionado
document.addEventListener('DOMContentLoaded', function() {
    if(document.getElementById('turno').value) {
        cargarHorarios();
    }

    document.getElementById('formReserva').addEventListener('submit', function(e) {
        e.preventDefault();
        let aula_id = document.querySelector('select[name="aula_id"]').value;
        let dia     = document.querySelector('select[name="dia"]').value;
        let inicio  = document.getElementById('hora_inicio').value;
        let fin     = document.getElementById('hora_fin').value;
        let mensaje = document.getElementById('mensaje-reserva');

        if (!aula_id || !dia || !inicio || !fin) {
            mensaje.textContent = "⚠️ Selecciona aula, día y horario.";
            return;
        }

        fetch(`/verificar-reserva?aula_id=${aula_id}&dia=${dia}&inicio=${inicio}&fin=${fin}`)
            .then(res => res.json())
            .then(data => {
                if (data.disponible) {
                    mensaje.textContent = "";
                    e.target.submit();
                } else {
                    let sugerencias = data.alternativas.length > 0 
                        ? " 👉 Puedes probar en estos horarios libres: " + data.alternativas.join(", ")
                        : data.proximo_dia ? " 👉 Este día está ocupado, prueba el " + data.proximo_dia : "";
                    mensaje.textContent = "❌ El aula ya está reservada en ese horario." + sugerencias;
                }
            })
            .catch(err => {
                console.error(err);
                mensaje.textContent = "⚠️ Error al verificar disponibilidad.";
            });
    });
});
</script>
@endsection

