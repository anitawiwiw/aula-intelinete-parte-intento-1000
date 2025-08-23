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

        return view('reservas.index', compact('reservas','materias','dias','tipos'));
    }

    public function create()
    { 
        $aulas = Aula::orderBy('nombre')->get();
        $materias = Materia::orderBy('nombre')->get();
        $dias     = ['lunes','martes','miercoles','jueves','viernes'];
        $tipos    = ['opcion1' => 'Opción 1', 'opcion2' => 'Opción 2'];

        return view('reservas.create', compact('aulas','materias','dias','tipos'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['user_id'] = auth()->id() ?? null; // si tenés login
        Reserva::create($data);
        return redirect()->route('reservas.index')->with('ok', 'Reserva creada.');
    }

    public function edit(Reserva $reserva)
    {
        $aulas = Aula::orderBy('nombre')->get(); // Agrega esta línea
        $materias = Materia::orderBy('nombre')->get();
        $dias     = ['lunes','martes','miercoles','jueves','viernes'];
        $tipos    = ['opcion1' => 'Opción 1', 'opcion2' => 'Opción 2'];

        return view('reservas.edit', compact('reserva','aulas','materias','dias','tipos'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        $data = $this->validateData($request, true, $reserva->id);
        $reserva->update($data);
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
        ]);

        return $data;
    }
}
