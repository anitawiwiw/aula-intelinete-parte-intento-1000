<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Reserva;
use App\Models\Materia;
use App\Models\Horario;

class HorarioController extends Controller
{
    // Módulos turno mañana
    private array $slotsManana = [
        1 => ['07:00', '07:40'], 2 => ['07:40', '08:15'], 'recreo1' => ['08:15', '08:25'],
        3 => ['08:25', '09:05'], 4 => ['09:05', '09:40'], 'recreo2' => ['09:40', '09:50'],
        5 => ['09:50', '10:30'], 6 => ['10:30', '11:05'], 'recreo3' => ['11:05', '11:15'],
        7 => ['11:15', '11:55'], 8 => ['11:55', '12:30'],
    ];

    // Módulos turno tarde
    private array $slotsTarde = [
        1 => ['13:00', '13:40'], 2 => ['13:40', '14:15'], 'recreo1' => ['14:15', '14:25'],
        3 => ['14:25', '15:05'], 4 => ['15:05', '15:40'], 'recreo2' => ['15:40', '15:50'],
        5 => ['15:50', '16:30'], 6 => ['16:30', '17:05'], 'recreo3' => ['17:05', '17:15'],
        7 => ['17:15', '17:55'], 8 => ['17:55', '18:30'],
    ];

    private array $days = [1 => 'lunes', 2 => 'martes', 3 => 'miercoles', 4 => 'jueves', 5 => 'viernes'];

    public function index(Request $request)
    {
        // Cursos y trimestres disponibles para el formulario
        $cursosDisponibles = ['1A','1B','1C','2A','2B','2C','3A','3B','3C','4A','4B','5A'];
        $trimestres = ['1er trimestre','2do trimestre','3er trimestre'];
        
        // Valores por defecto
        $curso = $request->input('curso') ?? $cursosDisponibles[0];
        $trimestre = $request->input('trimestre') ?? $trimestres[0];

        // Se usa el valor completo de la base de datos sin separar
        $anio_division = $curso;
        
        // Inicializamos las grillas vacías para que siempre se muestren
        $gridManana = $this->inicializarGrillaVacia();
        $gridTarde = $this->inicializarGrillaVacia();
        
        // Obtener ids de materias para el año y división seleccionados
        // Se asume que la tabla 'materias' tiene la columna 'año' con el valor '1A', '2B', etc.
        $materiaIds = Materia::where('año', $anio_division)
            ->pluck('id');

        // Reservas filtradas por materia_id (año/division), trimestre y turno
        $reservas = Reserva::with('materia')
            ->whereIn('materia_id', $materiaIds)
            ->where('trimestre', $trimestre)
            ->get();
        
        // Horarios fijos, se asume que no tienen relación con el año
        $horarios = Horario::all();

        // Construir las grillas con los datos
        $gridManana = $this->construirGrillaCompleta($horarios, $reservas, 'manana');
        $gridTarde  = $this->construirGrillaCompleta($horarios, $reservas, 'tarde');

        return view('admins.home_de_admins', compact(
            'cursosDisponibles', 'trimestres',
            'curso', 'trimestre',
            'gridManana', 'gridTarde'
        ));
    }

    private function construirGrillaCompleta($horarios, $reservas, $turno)
    {
        $grid = $this->inicializarGrillaVacia();

        // Agregar horarios fijos
        foreach ($horarios as $horario) {
            $dow = $this->mapDiaToIso($horario->dia);
            if ($dow < 1 || $dow > 5) continue;
            foreach ($this->modulosDesdeHorario($horario, $turno) as $mod) {
                $grid[$mod][$dow][] = [
                    'tipo' => 'horario',
                    'nombre' => 'Horario Fijo',
                    'color' => '#e3f2fd'
                ];
            }
        }
        
        // Agregar reservas
        foreach ($reservas as $r) {
            $dow = $this->mapDiaToIso($r->dia ?? '');
            if ($dow < 1 || $dow > 5) continue;
            $resTurno = $r->turno ?? $this->inferirTurno($r);
            $resTurno = $this->strLowerNoAccents($resTurno);
            if ($resTurno !== $turno) continue;
            $nombreMateria = $this->materiaNombre($r) ?? '—';
            
            foreach ($this->modulosDesdeReserva($r, $turno) as $mod) {
                $grid[$mod][$dow][] = [
                    'tipo' => 'reserva',
                    'nombre' => $nombreMateria,
                    'color' => '#f3e5f5'
                ];
            }
        }
        return $grid;
    }

    private function inicializarGrillaVacia(): array
    {
        $grid = [];
        $numericModules = [1, 2, 3, 4, 5, 6, 7, 8];
        foreach ($numericModules as $mod) {
            foreach ($this->days as $dnum => $dname) {
                $grid[$mod][$dnum] = [];
            }
        }
        return $grid;
    }
    
    private function modulosDesdeHorario($horario, $turno): array
    {
        if (!$horario->hora_inicio || !$horario->hora_fin) return [];
        try {
            $inicio = Carbon::parse($horario->hora_inicio)->format('H:i');
            $fin = Carbon::parse($horario->hora_fin)->format('H:i');
        } catch (\Throwable $e) { return []; }
        $slots = $turno === 'manana' ? $this->slotsManana : $this->slotsTarde;
        $mods = [];
        foreach ($this->numericModules() as $mod) {
            if (!isset($slots[$mod])) continue;
            [$a, $b] = $slots[$mod];
            if ($inicio < $b && $fin > $a) { $mods[] = $mod; }
        }
        return $mods;
    }
    
    private function modulosDesdeReserva($r, $turno): array
    {
        if (!$r->hora_inicio || !$r->hora_fin) return [];
        try {
            $inicio = Carbon::parse($r->hora_inicio)->format('H:i');
            $fin = Carbon::parse($r->hora_fin)->format('H:i');
        } catch (\Throwable $e) { return []; }
        $slots = $turno === 'manana' ? $this->slotsManana : $this->slotsTarde;
        $mods = [];
        foreach ($this->numericModules() as $mod) {
            if (!isset($slots[$mod])) continue;
            [$a, $b] = $slots[$mod];
            if ($inicio < $b && $fin > $a) { $mods[] = $mod; }
        }
        return $mods;
    }

    private function numericModules(): array
    {
        return [1, 2, 3, 4, 5, 6, 7, 8];
    }
    
    private function inferirTurno($r): string
    {
        if (!$r->hora_inicio) return 'manana';
        try {
            $t = Carbon::parse($r->hora_inicio)->format('H:i');
            return ($t >= '07:00' && $t <= '12:30') ? 'manana' : 'tarde';
        } catch (\Throwable $e) { return 'manana'; }
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
    // =======================
// VERSIÓN PARA DOCENTES
// =======================
public function indexDeProfes(Request $request)
{
    // Cursos y trimestres disponibles para el formulario
    $cursosDisponibles = ['1A','1B','1C','2A','2B','2C','3A','3B','3C','4A','4B','5A'];
    $trimestres = ['1er trimestre','2do trimestre','3er trimestre'];
    
    // Valores por defecto
    $curso = $request->input('curso') ?? $cursosDisponibles[0];
    $trimestre = $request->input('trimestre') ?? $trimestres[0];

    $anio_division = $curso;

    $gridManana = $this->inicializarGrillaVacia();
    $gridTarde = $this->inicializarGrillaVacia();

    $materiaIds = Materia::where('año', $anio_division)->pluck('id');

    $reservas = Reserva::with('materia')
        ->whereIn('materia_id', $materiaIds)
        ->where('trimestre', $trimestre)
        ->get();

    $horarios = Horario::all();

    $gridManana = $this->construirGrillaCompleta($horarios, $reservas, 'manana');
    $gridTarde  = $this->construirGrillaCompleta($horarios, $reservas, 'tarde');

    return view('docentes.home_de_docentes', compact(
        'cursosDisponibles', 'trimestres',
        'curso', 'trimestre',
        'gridManana', 'gridTarde'
    ));
}

}