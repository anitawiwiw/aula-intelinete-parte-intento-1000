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
    
    .separador-turno { margin-top: 40px; padding-top: 20px; border-top: 2px solid #ccc; }
</style>
@endpush
@section('content')
<div class="container-fluid py-3">
    <!-- Barra de navegación -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Horario {{ $anio }}° {{ $division }}</h2>
                <a href="{{ route('horarios.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Cambiar Curso
                </a>
            </div>
        </div>
    </div>

    <!-- Horario Turno Mañana -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Turno Mañana</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-horario">
                        <thead>
                            <tr>
                                <th class="col-index">#</th>
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

                            @foreach($slotsManana as $k => $rango)
                                @if(is_string($k) && in_array($k, $recreos))
                                    @php $fila++; @endphp
                                    <tr class="recreo">
                                        <td class="col-index">—</td>
                                        <td class="col-aux">Recreo {{ $rango[0] }}-{{ $rango[1] }}</td>
                                        <td colspan="5"> </td>
                                    </tr>
                                @else
                                    @php $fila++; @endphp
                                    <tr>
                                        <td class="col-index">{{ $loop->iteration - ( $loop->iteration > 3 ? 1 : 0 ) - ( $loop->iteration > 6 ? 1 : 0 ) }}</td>
                                        <td class="col-aux">{{ $rango[0] }} - {{ $rango[1] }}</td>

                                        @for($d=1; $d<=5; $d++)
                                            <td class="celda">
                                                @php $contenido = $gridManana[$k][$d] ?? []; @endphp
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
            </div>
        </div>
    </div>

    <!-- Horario Turno Tarde -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Turno Tarde</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-horario">
                        <thead>
                            <tr>
                                <th class="col-index">#</th>
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

                            @foreach($slotsTarde as $k => $rango)
                                @if(is_string($k) && in_array($k, $recreos))
                                    @php $fila++; @endphp
                                    <tr class="recreo">
                                        <td class="col-index">—</td>
                                        <td class="col-aux">Recreo {{ $rango[0] }}-{{ $rango[1] }}</td>
                                        <td colspan="5"> </td>
                                    </tr>
                                @else
                                    @php $fila++; @endphp
                                    <tr>
                                        <td class="col-index">{{ $loop->iteration - ( $loop->iteration > 3 ? 1 : 0 ) - ( $loop->iteration > 6 ? 1 : 0 ) }}</td>
                                        <td class="col-aux">{{ $rango[0] }} - {{ $rango[1] }}</td>

                                        @for($d=1; $d<=5; $d++)
                                            <td class="celda">
                                                @php $contenido = $gridTarde[$k][$d] ?? []; @endphp
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
            </div>
        </div>
    </div>
</div>
@endsection