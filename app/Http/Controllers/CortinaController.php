<?php

namespace App\Http\Controllers;

use App\Models\Cortina;
use App\Models\Aula;
use Illuminate\Http\Request;

class CortinaController extends Controller
{
    public function indexByAula($aulaId)
    {
        $aula = Aula::with('cortinas')->findOrFail($aulaId);
        $cortinas = $aula->cortinas()->orderBy('nombre')->paginate(10);

        return view('cortinas.index_by_aula', compact('aula', 'cortinas'));
    }

    public function createByAula($aulaId)
    {
        $aula = Aula::findOrFail($aulaId);
        return view('cortinas.create_by_aula', compact('aula'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|string|max:100',
            'ubicacion' => 'nullable|string|max:255',
            'aula_id' => 'required|exists:aulas,id',
        ]);

        Cortina::create($data);

        return redirect()
            ->route('cortinas.byAula', $data['aula_id'])
            ->with('success', '✅ Cortina registrada correctamente.');
    }

    public function edit(Cortina $cortina)
    {
        $aulas = Aula::orderBy('nombre')->get();
        return view('cortinas.edit', compact('cortina', 'aulas'));
    }

    public function update(Request $request, Cortina $cortina)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|string|max:100',
            'ubicacion' => 'nullable|string|max:255',
            'aula_id' => 'required|exists:aulas,id',
        ]);

        $cortina->update($data);

        return redirect()
            ->route('cortinas.byAula', $data['aula_id'])
            ->with('success', '✅ Cortina actualizada correctamente.');
    }

    public function destroy(Cortina $cortina)
    {
        $aulaId = $cortina->aula_id;
        $cortina->delete();

        return redirect()
            ->route('cortinas.byAula', $aulaId)
            ->with('success', '🗑️ Cortina eliminada correctamente.');
    }
}
