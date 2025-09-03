<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Reserva;
use App\Models\Materia;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['aula','materia','user'])
            ->orderByRaw("FIELD(dia,'lunes','martes','miercoles','jueves','viernes')")
            ->orderBy('hora_inicio')
            ->paginate(20);
        $aulas = Aula::orderBy('nombre')->get();
        $materias = Materia::orderBy('nombre')->get();
        $dias     = ['lunes','martes','miercoles','jueves','viernes'];
        $tipos    = ['opcion1' => 'Opción 1', 'opcion2' => 'Opción 2'];
        $trimestres = ['1er trimestre', '2do trimestre', '3er trimestre'];

        return view('reservas.index', compact('reservas','materias','dias','tipos','trimestres'));
    }

    public function create()
    { 
        $aulas = Aula::orderBy('nombre')->get();
        $materias = Materia::orderBy('nombre')->get();
        $dias     = ['lunes','martes','miercoles','jueves','viernes'];
        $tipos    = ['opcion1' => 'Opción 1', 'opcion2' => 'Opción 2'];
        $trimestres = ['1er trimestre', '2do trimestre', '3er trimestre'];

        return view('reservas.create', compact('aulas','materias','dias','tipos','trimestres'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['user_id'] = auth()->id() ?? null; // si tenés login
        $reserva = Reserva::create($data);
        $this->actualizarDisponibilidad($reserva->aula_id, $reserva->dia, $reserva->hora_inicio, $reserva->hora_fin);

        return redirect()->route('reservas.index')->with('ok', 'Reserva creada.');
    }

    public function edit(Reserva $reserva)
    {
        $aulas = Aula::orderBy('nombre')->get();
        $materias = Materia::orderBy('nombre')->get();
        $dias     = ['lunes','martes','miercoles','jueves','viernes'];
        $tipos    = ['opcion1' => 'Opción 1', 'opcion2' => 'Opción 2'];
        $trimestres = ['1er trimestre', '2do trimestre', '3er trimestre'];

        return view('reservas.edit', compact('reserva','aulas','materias','dias','tipos','trimestres'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        $data = $this->validateData($request, true, $reserva->id);
        $reserva->update($data);
        $this->actualizarDisponibilidad($reserva->aula_id, $reserva->dia, $reserva->hora_inicio, $reserva->hora_fin);

        return redirect()->route('reservas.index')->with('ok', 'Reserva actualizada.');
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('ok', 'Reserva eliminada.');
    }

    /* ================= helpers ================= */

    private function validateData(Request $request, bool $updating = false, ?int $reservaId = null): array
    {
        $request->merge([
            'hora_inicio' => substr($request->input('hora_inicio'), 0, 5),
            'hora_fin'    => substr($request->input('hora_fin'), 0, 5),
        ]);

        $data = $request->validate([
            'aula_id'     => ['required','exists:aulas,id'],
            'materia_id'  => ['required','exists:materias,id'],
            'dia'         => ['required','in:lunes,martes,miercoles,jueves,viernes'],
            'hora_inicio' => ['required','date_format:H:i'],
            'hora_fin'    => ['required','date_format:H:i','after:hora_inicio'],
            'tipo_origen' => ['required','in:opcion1,opcion2'],
            'trimestre'   => ['required','in:1er trimestre,2do trimestre,3er trimestre'],
        ]);

        $existe = \App\Models\Reserva::where('aula_id', $data['aula_id'])
            ->where('dia', $data['dia'])
            ->where('trimestre', $data['trimestre'])
            ->when($updating && $reservaId, fn($q) => $q->where('id', '!=', $reservaId))
            ->where(function ($q) use ($data) {
                $q->where('hora_inicio', '<', $data['hora_fin'])
                  ->where('hora_fin', '>', $data['hora_inicio']);
            })
            ->exists();

        if ($existe) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'hora_inicio' => 'Ya existe una reserva para este aula en ese rango horario y trimestre.',
            ]);
        }

        return $data;
    }

    private function actualizarDisponibilidad($aulaId, $dia, $horaInicio, $horaFin)
    {
        // Bloques fijos (imagen - mañana y tarde)
        $horarios = [
            // MAÑANA
            ["07:00","07:40"],["07:40","08:15"],
            ["08:25","09:05"],["09:05","09:40"],
            ["09:50","10:30"],["10:30","11:05"],
            ["11:15","11:55"],["11:55","12:30"],
            // TARDE (simétrico a la mañana)
            ["13:00","13:40"],["13:40","14:15"],
            ["14:25","15:05"],["15:05","15:40"],
            ["15:50","16:30"],["16:30","17:05"],
            ["17:15","17:55"],["17:55","18:30"],
        ];

        foreach ($horarios as [$bloqueInicio, $bloqueFin]) {
            // Solapa real (mitad-abierto): reserva_inicio < bloque_fin && reserva_fin > bloque_inicio
            if ($horaInicio < $bloqueFin && $horaFin > $bloqueInicio) {
                \App\Models\Disponibilidad::updateOrCreate(
                    [
                        'aula_id' => $aulaId,
                        'dia'     => $dia,
                        'hora_inicio' => $bloqueInicio,
                        'hora_fin'    => $bloqueFin,
                    ],
                    ['estado' => 'ocupado']
                );
            }
        }
    }

    // Método para verificar disponibilidad de un aula en un día/horario
    public function verificarDisponibilidad(Request $request)
    {
        $aula_id = $request->aula_id;
        $dia     = $request->dia;
        $inicio  = $request->inicio;
        $fin     = $request->fin;
        $trimestre = $request->trimestre;

        // Choque real: nuevo_inicio < existente_fin && nuevo_fin > existente_inicio
        $conflicto = \App\Models\Reserva::where('aula_id', $aula_id)
            ->where('dia', $dia)
            ->where('trimestre', $trimestre)
            ->where(function ($q) use ($inicio, $fin) {
                $q->where('hora_inicio', '<', $fin)
                  ->where('hora_fin', '>', $inicio);
            })
            ->exists();

        if (!$conflicto) {
            return response()->json(['disponible' => true, 'alternativas' => []]);
        }

        // Bloques de la grilla (mañana + tarde)
        $turnos = [
            ["07:00","07:40"],["07:40","08:15"],
            ["08:25","09:05"],["09:05","09:40"],
            ["09:50","10:30"],["10:30","11:05"],
            ["11:15","11:55"],["11:55","12:30"],
            ["13:00","13:40"],["13:40","14:15"],
            ["14:25","15:05"],["15:05","15:40"],
            ["15:50","16:30"],["16:30","17:05"],
            ["17:15","17:55"],["17:55","18:30"],
        ];

        // Sugerencias: libres según misma lógica (mitad-abierto)
        $alternativas = [];
        foreach ($turnos as [$h0, $h1]) {
            $ocupado = \App\Models\Reserva::where('aula_id', $aula_id)
                ->where('dia', $dia)
                ->where('trimestre', $trimestre)
                ->where(function ($q) use ($h0, $h1) {
                    $q->where('hora_inicio', '<', $h1)
                      ->where('hora_fin', '>', $h0);
                })
                ->exists();

            if (!$ocupado) {
                $alternativas[] = "$h0 - $h1";
            }
        }

        // Próximo día con aula libre (si querés lo dejamos igual)
        $dias_semana = ['lunes','martes','miercoles','jueves','viernes'];
        $pos = array_search($dia, $dias_semana);
        $proximo_dia = null;
        for ($i=1; $i<count($dias_semana); $i++) {
            $dia_check = $dias_semana[($pos+$i) % count($dias_semana)];
            $hay = \App\Models\Reserva::where('aula_id', $aula_id)
                ->where('dia', $dia_check)
                ->where('trimestre', $trimestre)
                ->exists();
            if (!$hay) { $proximo_dia = ucfirst($dia_check); break; }
        }

        return response()->json([
            'disponible'   => false,
            'alternativas' => $alternativas,
            'proximo_dia'  => $proximo_dia,
        ]);
    }
    // Mostrar el formulario de creación de reservas para docentes
public function createDeDocentes()
{
    $aulas = Aula::orderBy('nombre')->get();
    $materias = Materia::orderBy('nombre')->get();
    $dias = ['lunes','martes','miercoles','jueves','viernes'];
    $tipos = ['opcion1' => 'Opción 1', 'opcion2' => 'Opción 2'];
    $trimestres = ['1er trimestre', '2do trimestre', '3er trimestre'];

    return view('reservas.create_de_docentes', compact('aulas','materias','dias','tipos','trimestres'));
}

// Guardar la reserva creada por un docente y redirigir al home de docentes
public function storeDeDocentes(Request $request)
{
    // Validar los datos usando la misma lógica que en store()
    $data = $request->validate([
        'aula_id'     => ['required','exists:aulas,id'],
        'materia_id'  => ['required','exists:materias,id'],
        'dia'         => ['required','in:lunes,martes,miercoles,jueves,viernes'],
        'hora_inicio' => ['required','date_format:H:i'],
        'hora_fin'    => ['required','date_format:H:i','after:hora_inicio'],
        'tipo_origen' => ['required','in:opcion1,opcion2'],
        'trimestre'   => ['required','in:1er trimestre,2do trimestre,3er trimestre'],
    ]);

    $data['user_id'] = auth()->id() ?? null; // docente logueado
    $reserva = Reserva::create($data);

    // Actualizar disponibilidad como en store()
    $this->actualizarDisponibilidad($reserva->aula_id, $reserva->dia, $reserva->hora_inicio, $reserva->hora_fin);

    // Redirigir al tablero de docentes
    return redirect()->route('docentes.home_de_docentes')
                     ->with('success', 'Reserva creada correctamente.');
}

}