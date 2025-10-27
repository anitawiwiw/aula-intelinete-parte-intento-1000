@extends('layouts.app')

@section('content')
<style>
 html, body {
    margin: 0;
    padding: 0;
    height: auto; /* O min-height: 100% */
    overflow-y: auto; /* Permite scroll vertical */
}
    
    /* Estilos generales para el contenedor y la fuente */
    .container {
        font-family: 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        background-color: #f8f9fa;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    h3, h4 {
        color: #2c3e50;
        border-bottom: 2px solid #3498db;
        padding-bottom: 0.5rem;
        margin-top: 2rem;
    }

    /* Estilos de la tabla de horarios */
    .table-container {
        overflow-x: auto;
    }

    .horario-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .horario-table th,
    .horario-table td {
        border: 1px solid #dcdcdc;
        text-align: center;
        padding: 0; /* Eliminamos el padding para el div interno */
        vertical-align: middle;
        position: relative;
    }

    .horario-table thead th {
        background-color: #e9f2ff;
        color: #2c3e50;
        font-weight: 600;
        padding: 12px 8px;
        border-bottom: 2px solid #3498db;
    }
    
    .modulo-cell {
        background-color: #f0f4f7;
        font-weight: 600;
        color: #555;
    }

    /* Estilos para los bloques de clase */
    .clase-block {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding: 8px 6px;
        margin: 4px;
        border-radius: 6px;
        font-size: 0.9em;
        font-weight: 500;
        color: #333;
        transition: transform 0.2s ease-in-out;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .clase-block:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    /* Estilo especial para el recreo */
    .recreo-row td {
        background-color: #f1f1f1;
        font-style: italic;
        font-weight: 500;
        color: #666;
        padding: 12px;
    }

    /* Estilos para el formulario de selección */
    .form-group label {
        font-weight: 500;
        color: #555;
    }
    .form-control {
        border-radius: 8px;
        border: 1px solid #dcdcdc;
        box-shadow: none;
    }
    .reservar-btn {
    display: inline-block;
    background: linear-gradient(135deg, #4CAF50, #388E3C);
    color: #fff !important;
    border: none;
    border-radius: 8px;
    padding: 6px 14px;
    font-weight: 600;
    font-size: 0.85rem;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 3px 5px rgba(0,0,0,0.1);
}
.reservar-btn:hover {
    background: linear-gradient(135deg, #43A047, #2E7D32);
    transform: translateY(-2px);
    box-shadow: 0 6px 10px rgba(0,0,0,0.15);
}
.reservar-btn:active {
    transform: translateY(1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

</style>

<div class="container">
    <h3>Seleccionar Curso y Trimestre</h3>
    <form action="{{ route('horarios.index') }}" method="GET" class="mb-4">
        <div class="form-group mb-2">
            <label for="curso">Curso:</label>
            <select name="curso" id="curso" class="form-control" onchange="this.form.submit()">
                @foreach($cursosDisponibles as $c)
                <option value="{{ $c }}" {{ ($curso == $c) ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-2">
            <label for="trimestre">Trimestre:</label>
            <select name="trimestre" id="trimestre" class="form-control" onchange="this.form.submit()">
                @foreach($trimestres as $t)
                <option value="{{ $t }}" {{ ($trimestre == $t) ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </div>
        <noscript><button class="btn btn-primary" type="submit">Ver Horarios</button></noscript>
    </form>

    <hr>

    <h3>Horario del curso {{ $curso }} - {{ $trimestre }}</h3>

    <h4>Turno Mañana</h4>
    <div class="table-container">
        <table class="horario-table">
            <thead>
                <tr>
                    <th>Módulo</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                </tr>
            </thead>
            <tbody>
                @php
    $slotsManana = [
        1 => ['07:00', '07:40'], 2 => ['07:40', '08:15'], 'recreo1' => ['08:15', '08:25'],
        3 => ['08:25', '09:05'], 4 => ['09:05', '09:40'], 'recreo2' => ['09:40', '09:50'],
        5 => ['09:50', '10:30'], 6 => ['10:30', '11:05'], 'recreo3' => ['11:05', '11:15'],
        7 => ['11:15', '11:55'], 8 => ['11:55', '12:30'],
    ];

    // Mapeo numérico a nombre de día (para querystring)
    $dayNames = [1 => 'lunes', 2 => 'martes', 3 => 'miercoles', 4 => 'jueves', 5 => 'viernes'];
@endphp

@foreach(array_keys($slotsManana) as $mod)
    @if(strpos($mod, 'recreo') !== false)
        <tr class="recreo-row">
            <td colspan="6">Recreo ({{ $slotsManana[$mod][0] }} - {{ $slotsManana[$mod][1] }})</td>
        </tr>
    @else
        <tr>
            <td class="modulo-cell">{{ $mod }}</td>
            @for($d=1;$d<=5;$d++)
                <td>
                    @if(!empty($gridManana[$mod][$d]))
                        @foreach($gridManana[$mod][$d] as $cell)
                            <div class="clase-block" style="background: {{ $cell['color'] ?? '#e6f7ff' }};">
                                {{ $cell['nombre'] }}
                            </div>
                        @endforeach
                    @else
                        {{-- Celda libre: botón para reservar este módulo --}}
                        @php
                            $h0 = $slotsManana[$mod][0];
                            $h1 = $slotsManana[$mod][1];
                            $diaName = $dayNames[$d];
                            $query = http_build_query([
                                'dia' => $diaName,
                                'hora_inicio' => $h0,
                                'hora_fin' => $h1,
                                'trimestre' => $trimestre,
                                'turno' => 'manana',
                                'modulo' => $mod,
                            ]);
                        @endphp

                        <div class="clase-block libre" title="Libre: {{ $h0 }} - {{ $h1 }}">
                            <a href="{{ route('reservas.create') }}?{{ $query }}" 
                               class="btn btn-sm btn-outline-primary reservar-btn"
                               role="button"
                               aria-label="Reservar módulo {{ $mod }} {{ $diaName }} {{ $h0 }} - {{ $h1 }}">
                                Reservar
                            </a>
                        </div>
                    @endif
                </td>
            @endfor
        </tr>
    @endif
@endforeach
            </tbody>
        </table>
    </div>

    <hr>

    <h4>Turno Tarde</h4>
    <div class="table-container">
        <table class="horario-table">
            <thead>
                <tr>
                    <th>Módulo</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                </tr>
            </thead>
            <tbody>
                @php
    $slotsTarde = [
        1 => ['13:00', '13:40'], 2 => ['13:40', '14:15'], 'recreo1' => ['14:15', '14:25'],
        3 => ['14:25', '15:05'], 4 => ['15:05', '15:40'], 'recreo2' => ['15:40', '15:50'],
        5 => ['15:50', '16:30'], 6 => ['16:30', '17:05'], 'recreo3' => ['17:05', '17:15'],
        7 => ['17:15', '17:55'], 8 => ['17:55', '18:30'],
    ];
    $dayNames = [1 => 'lunes', 2 => 'martes', 3 => 'miercoles', 4 => 'jueves', 5 => 'viernes'];
@endphp

@foreach(array_keys($slotsTarde) as $mod)
    @if(strpos($mod, 'recreo') !== false)
        <tr class="recreo-row">
            <td colspan="6">Recreo ({{ $slotsTarde[$mod][0] }} - {{ $slotsTarde[$mod][1] }})</td>
        </tr>
    @else
        <tr>
            <td class="modulo-cell">{{ $mod }}</td>
            @for($d=1;$d<=5;$d++)
                <td>
                    @if(!empty($gridTarde[$mod][$d]))
                        @foreach($gridTarde[$mod][$d] as $cell)
                            <div class="clase-block" style="background: {{ $cell['color'] ?? '#e6f7ff' }};">
                                {{ $cell['nombre'] }}
                            </div>
                        @endforeach
                    @else
                        @php
                            $h0 = $slotsTarde[$mod][0];
                            $h1 = $slotsTarde[$mod][1];
                            $diaName = $dayNames[$d];
                            $query = http_build_query([
                                'dia' => $diaName,
                                'hora_inicio' => $h0,
                                'hora_fin' => $h1,
                                'trimestre' => $trimestre,
                                'turno' => 'tarde',
                                'modulo' => $mod,
                            ]);
                        @endphp

                        <div class="clase-block libre" title="Libre: {{ $h0 }} - {{ $h1 }}">
                            <a href="{{ route('reservas.create') }}?{{ $query }}" 
                               class="btn btn-sm btn-outline-primary reservar-btn"
                               role="button"
                               aria-label="Reservar módulo {{ $mod }} {{ $diaName }} {{ $h0 }} - {{ $h1 }}">
                                Reservar
                            </a>
                        </div>
                    @endif
                </td>
            @endfor
        </tr>
    @endif
@endforeach
            </tbody>
        </table>
        
    </div>
<style>
    .clase-block { padding: .25rem .4rem; border-radius: 6px; min-height: 36px; display:flex; align-items:center; justify-content:center; }
    .clase-block.libre { background: #ffffff; border: 1px dashed #ddd; }
    .reservar-btn { font-size: .85rem; }
    .recreo-row td { text-align:center; font-weight:600; background:#fafafa; }
    .modulo-cell { font-weight:700; text-align:center; width:60px; }
</style>

<script>
    // Confirm opcional antes de ir al formulario (descomentar si querés confirmación)
    document.querySelectorAll('.reservar-btn').forEach(btn => {
        btn.addEventListener('click', function(e){
            // si querés pedir confirmacion, descomenta:
            // if (!confirm('Confirmar: abrir formulario de reserva con el módulo seleccionado?')) {
            //     e.preventDefault();
            // }
            // Dejar tal cual -> redirige directo al formulario create con params.
        });
    });
</script>

</div>
@endsection