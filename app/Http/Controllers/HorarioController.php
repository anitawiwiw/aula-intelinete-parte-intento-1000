<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Reserva;
use App\Models\Materia;

class HorarioController extends Controller
{
    // Módulos turno mañana
    private array $slotsManana = [
        1 => ['07:00','07:40'], 2 => ['07:40','08:15'], 'recreo1' => ['08:15','08:25'],
        3 => ['08:25','09:05'], 4 => ['09:05','09:40'], 'recreo2' => ['09:40','09:50'],
        5 => ['09:50','10:30'], 6 => ['10:30','11:05'], 'recreo3' => ['11:05','11:15'],
        7 => ['11:15','11:55'], 8 => ['11:55','12:30'],
    ];

    // Módulos turno tarde
    private array $slotsTarde = [
        1 => ['13:00','13:40'], 2 => ['13:40','14:15'], 'recreo1' => ['14:15','14:25'],
        3 => ['14:25','15:05'], 4 => ['15:05','15:40'], 'recreo2' => ['15:40','15:50'],
        5 => ['15:50','16:30'], 6 => ['16:30','17:05'], 'recreo3' => ['17:05','17:15'],
        7 => ['17:15','17:55'], 8 => ['17:55','18:30'],
    ];

    private array $days = [1 => 'lunes', 2 => 'martes', 3 => 'miercoles', 4 => 'jueves', 5 => 'viernes'];

    public function index()
    {
        $cursosDisponibles = [
            '1A', '1B', '1C', 
            '2A', '2B', '2C', 
            '3A', '3B', '3C', 
            '4A', '4B', 
            '5A'
        ];
        
        return view('horarios.index', compact('cursosDisponibles'));
    }

    public function seleccionar(Request $request)
    {
        $request->validate([
            'curso' => 'required|in:1A,1B,1C,2A,2B,2C,3A,3B,3C,4A,4B,5A'
        ]);
        
        $curso = $request->input('curso');
        $anio = substr($curso, 0, 1); // Obtener el año (1, 2, 3, 4, 5)
        $division = substr($curso, 1); // Obtener la división (A, B, C)
        
        // Redirigir al horario del curso seleccionado (turno mañana)
        return redirect()->route('horarios.show', [
            'anio' => $anio,
            'division' => $division,
            'turno' => 'manana'
        ]);
    }

    public function show(int $anio, string $division, string $turno)
    {
        // El año y división están juntos en la columna "año" (ej: "5A")
        $cursoCompleto = $anio . $division; // Esto produce "5A"
        
        // Traemos reservas para el curso específico (año + división)
        $reservas = Reserva::whereHas('materia', function ($query) use ($cursoCompleto) {
            $query->where('año', $cursoCompleto); // Buscar donde año = "5A"
        })->get();

        // Construcción de la grilla para ambos turnos
        $gridManana = $this->construirGrilla($reservas, 'manana');
        $gridTarde = $this->construirGrilla($reservas, 'tarde');

        return view('horarios.show', [
            'anio'     => $anio,
            'division' => strtoupper($division),
            'turno'    => $turno,
            'days'     => $this->days,
            'slotsManana' => $this->slotsManana,
            'slotsTarde' => $this->slotsTarde,
            'gridManana' => $gridManana,
            'gridTarde' => $gridTarde,
        ]);
    }

    private function construirGrilla($reservas, $turno)
    {
        $slots = $turno === 'manana' ? $this->slotsManana : $this->slotsTarde;
        $grid = [];
        
        foreach ($this->numericModules() as $mod) {
            foreach ($this->days as $dnum => $dname) {
                $grid[$mod][$dnum] = [];
            }
        }

        foreach ($reservas as $r) {
            $dow = $this->mapDiaToIso($r->dia ?? '');
            if ($dow < 1 || $dow > 5) continue;

            $resTurno = $r->turno ?? $this->inferTurno($r);
            $resTurno = $this->strLowerNoAccents($resTurno);
            if ($resTurno !== $turno) continue;

            $nombreMateria = $this->materiaNombre($r) ?? '—';
            foreach ($this->modulos($r, $turno) as $mod) {
                $grid[$mod][$dow][] = $nombreMateria;
            }
        }

        return $grid;
    }

    private function numericModules(): array
    {
        return [1, 2, 3, 4, 5, 6, 7, 8];
    }

    private function modulos($r, $turno): array
    {
        if (!$r->hora_inicio || !$r->hora_fin) return [];

        try {
            $inicio = Carbon::parse($r->hora_inicio)->format('H:i');
            $fin = Carbon::parse($r->hora_fin)->format('H:i');
        } catch (\Throwable $e) {
            return [];
        }

        $slots = $turno === 'manana' ? $this->slotsManana : $this->slotsTarde;
        $mods = [];

        foreach ($this->numericModules() as $mod) {
            if (!isset($slots[$mod])) continue;
            
            [$a, $b] = $slots[$mod];
            if ($inicio < $b && $fin > $a) {
                $mods[] = $mod;
            }
        }

        return $mods;
    }

    private function inferTurno($r): string
    {
        if (!$r->hora_inicio) return 'manana';

        try {
            $t = Carbon::parse($r->hora_inicio)->format('H:i');
            return ($t >= '07:00' && $t <= '12:30') ? 'manana' : 'tarde';
        } catch (\Throwable $e) {
            return 'manana';
        }
    }

    private function materiaNombre($r): ?string
    {
        return $r->materia->nombre ?? null;
    }

    private function mapDiaToIso(string $dia): int
    {
        $map = ['lunes' => 1, 'martes' => 2, 'miercoles' => 3, 'jueves' => 4, 'viernes' => 5];
        $d = $this->strLowerNoAccents($dia);
        return $map[$d] ?? 0;
    }

    private function strLowerNoAccents(string $s): string
    {
        return Str::lower(Str::ascii($s));
    }
}