<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Reserva;
use App\Models\Materia;

class HorarioController extends Controller
{
    public function index()
{
    $horarios = Horario::all();

    foreach ($horarios as $horario) {
        $horario->reservas = Reserva::whereTime('hora_inicio', '<=', $horario->hora_fin)
            ->whereTime('hora_fin', '>=', $horario->hora_inicio)
            ->get();
    }

    return view('horarios.index', compact('horarios'));
}

    // Módulos turno mañana (8 módulos + recreos)
    private array $slots = [
        1 => ['07:00','07:40'],
        2 => ['07:40','08:15'],
        'recreo1' => ['08:15','08:25'],
        3 => ['08:25','09:05'],
        4 => ['09:05','09:40'],
        'recreo2' => ['09:40','09:50'],
        5 => ['09:50','10:30'],
        6 => ['10:30','11:05'],
        'recreo3' => ['11:05','11:15'],
        7 => ['11:15','11:55'],
        8 => ['11:55','12:30'],
    ];

    private array $days = [
        1=>'lunes',
        2=>'martes',
        3=>'miercoles',
        4=>'jueves',
        5=>'viernes'
    ];

    public function show(int $anio, string $division, string $turno)
    {
        // Traemos reservas con la relación materia y aula
       $reservas = Reserva::whereHas('materia', function ($query) {
       $query->where('año', 5);
    // si querés filtrar por carrera:
    // $query->where('carrera', 'Opcion 1');
        })->get();

        // Construcción de la grilla: módulo x día
        $grid = [];
        foreach ($this->numericModules() as $mod) {
            foreach ($this->days as $dnum=>$dname) {
                $grid[$mod][$dnum] = [];
            }
        }

        foreach ($reservas as $r) {
            // día de la semana
            $dow = $this->mapDiaToIso($r->dia ?? '');
            if ($dow < 1 || $dow > 5) continue;

            // turno (columna o inferido por hora_inicio)
            $resTurno = $r->turno ?? $this->inferTurno($r);
            $resTurno = $this->strLowerNoAccents($resTurno);
            if ($resTurno !== $turno) continue;

            // módulo
            

            $nombreMateria = $this->materiaNombre($r) ?? '—';
            foreach ($this->modulos($r) as $mod) {
    $grid[$mod][$dow][] = $nombreMateria;
}

        }

        return view('horarios.show', [
            'anio'     => $anio,
            'division' => strtoupper($division),
            'turno'    => $turno,
            'days'     => $this->days,
            'slots'    => $this->slots,
            'grid'     => $grid,
        ]);
    }

    private function numericModules(): array
    {
        return [1,2,3,4,5,6,7,8];
    }

private function modulos($r): array
{
    $horaInicio = $r->hora_inicio ?? null;
    $horaFin    = $r->hora_fin ?? null;
    if (!$horaInicio || !$horaFin) return [];

    try {
        $inicio = Carbon::parse($horaInicio)->format('H:i');
        $fin    = Carbon::parse($horaFin)->format('H:i');
    } catch (\Throwable $e) {
        return [];
    }

    $mods = [];
    foreach ($this->numericModules() as $mod) {
        [$a, $b] = $this->slots[$mod];
        // Si la reserva se superpone con este módulo
        if ($inicio < $b && $fin > $a) {
            $mods[] = $mod;
        }
    }

    return $mods;
}


    private function inferTurno($r): string
    {
        $hora = $r->hora_inicio ?? null;
        if (!$hora) return 'manana';

        try {
            $t = Carbon::parse($hora)->format('H:i');
            if ($t >= '07:00' && $t <= '12:30') return 'manana';
            if ($t >= '13:00' && $t <= '18:30') return 'tarde';
        } catch (\Throwable $e) {
            return 'manana';
        }
        return 'manana';
    }

    private function materiaNombre($r): ?string
    {
        if (isset($r->materia) && !empty($r->materia->nombre)) {
            return $r->materia->nombre;
        }
        return null;
    }

    private function mapDiaToIso(string $dia): int
    {
        $map = [
            'lunes'=>1,'martes'=>2,'miercoles'=>3,
            'jueves'=>4,'viernes'=>5,'sabado'=>6,'domingo'=>7
        ];
        $d = $this->strLowerNoAccents($dia);
        return $map[$d] ?? 0;
    }

    private function strLowerNoAccents(string $s): string
    {
        $s = Str::of($s)->lower()->toString();
        $s = str_replace(['á','é','í','ó','ú','ñ'], ['a','e','i','o','u','n'], $s);
        return $s;
    }
}
