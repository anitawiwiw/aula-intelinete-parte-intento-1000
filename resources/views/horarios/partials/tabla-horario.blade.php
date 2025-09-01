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

        @foreach($slots as $k => $rango)
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