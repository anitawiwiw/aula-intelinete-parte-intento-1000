 @extends('layouts.app')

@section('content')
<div class="container">
    <h1>Horarios de Aulas</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hora/Aula</th>
                    @foreach($aulas as $aula)
                        <th>{{ $aula->nombre }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($horas as $hora)
                    <tr>
                        <td>{{ $hora['inicio'] }} - {{ $hora['fin'] }}</td>
                        @foreach($aulas as $aula)
                            <td>
                                @php
                                    $reserva = $reservas->firstWhere(function($item) use ($aula, $hora) {
                                        return $item->aula_id == $aula->id && 
                                               $item->hora_inicio <= $hora['inicio'] && 
                                               $item->hora_fin >= $hora['fin'];
                                    });
                                @endphp
                                
                                @if($reserva)
                                    <div class="bg-info p-1">
                                        {{ $reserva->nombre_materia }}<br>
                                        @foreach($reserva->docentes as $docente)
                                            {{ $docente->name }}@if(!$loop->last), @endif
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-success p-1 text-white">
                                        Libre
                                    </div>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
 @endsection