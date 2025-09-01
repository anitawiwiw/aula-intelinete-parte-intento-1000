@extends('layouts.app') {{-- o el layout que uses --}}

@section('title', "Horario {$anio}° {$division} - " . ($turno==='manana'?'Turno mañana':'Turno tarde'))

@push('styles')
<style>
    .horario-wrap { max-width: 1100px; margin: 16px auto; }
    .horario-head { text-align:center; margin-bottom: 8px; }
    .horario-head h2 { margin: 0; font-size: 20px; }
    .sub { color:#666; font-size: 13px; }

    table.horario { width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size:14px; }
    .horario th, .horario td { border:1px solid #cfcfcf; padding:6px; text-align:center; vertical-align: middle; }
    .horario thead th { font-weight:600; }

    /* Cabeceras con colores similares a tu imagen */
    .col-lunes    { background:#3b6ea5; color:#fff; }
    .col-martes   { background:#d64242; color:#fff; }
    .col-miercoles{ background:#6b6b6b; color:#fff; }
    .col-jueves   { background:#2e8b57; color:#fff; }
    .col-viernes  { background:#e57b7b; color:#fff; }

    .col-aux      { background:#f7f7f7; font-weight:600; width:110px; }
    .col-index    { width:40px; background:#fafafa; }

    .recreo { background:#fff799; font-weight:700; }
    .celda { min-height: 54px; }
    .materias { line-height:1.2; }
</style>
@endpush

@section('content')
<div class="horario-wrap">
    <div class="horario-head">
        <h2>Primer trimestre</h2>
        <div class="sub">{{ $anio }}° {{ $division }} — {{ $turno==='manana'?'Turno mañana':'Turno tarde' }}</div>
    </div>

    <table class="horario">
        <thead>
            <tr>
                <th class="col-index"></th>
                <th class="col-aux">Hora</th>
                <th class="col-lunes">Lunes</th>
                <th class="col-martes">Martes</th>
                <th class="col-miercoles">Miércoles</th>
                <th class="col-jueves">Jueves</th>
                <th class="col-viernes">Viernes</th>
            </tr>
        </thead>
        <tbody>
            @php
                $fila = 0;
                $recreos = ['recreo1','recreo2','recreo3'];
            @endphp

            @foreach($slots as $k => $rango)
                @if(is_string($k) && in_array($k, $recreos))
                    {{-- Fila de RECREO que ocupa todo el ancho --}}
                    @php $fila++; @endphp
                    <tr class="recreo">
                        <td class="col-index">—</td>
                        <td class="col-aux">{{ strtoupper($k==='recreo1'?'recreo':($k==='recreo2'?'Recreo':'Recreo')) }} {{ $rango[0] }}-{{ $rango[1] }}</td>
                        <td colspan="5"> </td>
                    </tr>
                @else
                    @php $fila++; @endphp
                    <tr>
                        <td class="col-index">{{ $loop->iteration - ( $loop->iteration > 3 ? 1 : 0 ) - ( $loop->iteration > 6 ? 1 : 0 ) }}</td>
                        <td class="col-aux">{{ $rango[0] }} - {{ $rango[1] }}</td>

                        @for($d=1; $d<=5; $d++)
                            <td class="celda">
                                @php $contenido = $grid[$k][$d] ?? []; @endphp
                                @if(!empty($contenido))
                                    <div class="materias">
                                        {!! implode('<br>', array_map('e', $contenido)) !!}
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
@endsection
