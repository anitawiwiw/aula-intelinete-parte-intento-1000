
@extends('layouts.app')
@section('content')
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
<div style="overflow-x:auto;">
    <table class="table table-bordered">
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
            @foreach([1, 2, 3, 4, 5, 6, 7, 8] as $mod)
                <tr>
                    <td>{{ $mod }}</td>
                    @for($d=1;$d<=5;$d++)
                        <td>
                            @if(!empty($gridManana[$mod][$d]))
                                @foreach($gridManana[$mod][$d] as $cell)
                                    <div style="padding:4px; margin-bottom:3px; border-radius:4px; background: {{ $cell['color'] ?? '#eee' }};">
                                        {{ $cell['nombre'] }}
                                    </div>
                                @endforeach
                            @else
                                &nbsp;
                            @endif
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<hr>

<h4>Turno Tarde</h4>
<div style="overflow-x:auto;">
    <table class="table table-bordered">
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
            @foreach([1, 2, 3, 4, 5, 6, 7, 8] as $mod)
                <tr>
                    <td>{{ $mod }}</td>
                    @for($d=1;$d<=5;$d++)
                        <td>
                            @if(!empty($gridTarde[$mod][$d]))
                                @foreach($gridTarde[$mod][$d] as $cell)
                                    <div style="padding:4px; margin-bottom:3px; border-radius:4px; background: {{ $cell['color'] ?? '#eee' }};">
                                        {{ $cell['nombre'] }}
                                    </div>
                                @endforeach
                            @else
                                &nbsp;
                            @endif
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
@endsection