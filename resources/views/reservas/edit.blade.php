@extends('layouts.app')
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
            ["17:15","17:30"]
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

// Validación de horarios (igual que en create)
document.addEventListener('DOMContentLoaded', function() {
    if(document.getElementById('turno').value) {
        cargarHorarios();
    }

    document.querySelector('form').addEventListener('submit', function(e) {
        let aula_id   = document.querySelector('select[name="aula_id"]').value;
        let dia       = document.querySelector('select[name="dia"]').value;
        let inicio    = document.getElementById('hora_inicio').value;
        let fin       = document.getElementById('hora_fin').value;
        let reservaId = "{{ $reserva->id }}"; // Para excluir la reserva actual

        if (!aula_id || !dia || !inicio || !fin) return;

        e.preventDefault(); // detenemos envío hasta chequear

        fetch(`/api/verificar-superposicion?aula_id=${aula_id}&dia=${dia}&inicio=${inicio}&fin=${fin}&reserva_id=${reservaId}`)
            .then(res => res.json())
            .then(data => {
                if (data.superpuesto) {
                    alert("⚠️ El horario se sobrepone con otra reserva existente.");
                } else {
                    e.target.submit();
                }
            })
            .catch(() => {
                alert("❌ Error al verificar disponibilidad. Intenta de nuevo.");
            });
    });
});
</script>

@section('content')
<div class="background">
    <img src="{{ asset('images/burbujas.jpg') }}" alt="Fondo burbujas">
</div>

<div class="form-wrapper">
    <div class="form-container">
        <h1>Editar Reserva</h1>

        <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label>Aula</label>
                <select name="aula_id" required>
                    @foreach($aulas as $a)
                        <option value="{{ $a->id }}" @selected(old('aula_id', $reserva->aula_id) == $a->id)>
                            {{ $a->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Materia</label>
                <select name="materia_id" required>
                    @foreach($materias as $m)
                        <option value="{{ $m->id }}" @selected(old('materia_id', $reserva->materia_id) == $m->id)>
                            {{ $m->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Día</label>
                <select name="dia" required>
                    @foreach($dias as $d)
                        <option value="{{ $d }}" @selected(old('dia', $reserva->dia) == $d)>
                            {{ ucfirst($d) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Turno</label>
                <select id="turno" name="turno" onchange="cargarHorarios()" required>
                    <option value="">— Elegir turno —</option>
                    <option value="maniana" @selected(old('turno', $reserva->turno)=='maniana')>Mañana</option>
                    <option value="tarde" @selected(old('turno', $reserva->turno)=='tarde')>Tarde</option>
                </select>
            </div>

            <div class="form-group">
                <label>Hora inicio</label>
                <select id="hora_inicio" name="hora_inicio" required>
                    <option value="">— Elegir —</option>
                </select>
            </div>

            <div class="form-group">
                <label>Hora fin</label>
                <select id="hora_fin" name="hora_fin" required>
                    <option value="">— Elegir —</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tipo origen</label>
                <select name="tipo_origen" required>
                    @foreach($tipos as $k=>$v)
                        <option value="{{ $k }}" @selected(old('tipo_origen', $reserva->tipo_origen)==$k)>
                            {{ $v }}
                        </option>
                    @endforeach
                </select>
            </div>
<div class="form-group">
    <label>Trimestre</label>
    <select name="trimestre" required>
        <option value="">— Elegir —</option>
        @foreach($trimestres as $trimestre)
            <option value="{{ $trimestre }}" @selected(old('trimestre')==$trimestre)>{{ $trimestre }}</option>
        @endforeach
    </select>
</div>
            <div style="display:flex; justify-content: space-between; gap:10px;">
                <a href="{{ route('reservas.index') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary">Actualizar Reserva</button>
            </div>
        </form>
    </div>
</div>

@endsection
