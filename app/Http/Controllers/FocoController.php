<?php

namespace App\Http\Controllers;

use App\Models\Foco;
use App\Models\Aula;
use Illuminate\Http\Request;

class FocoController extends Controller
{
    public function index()
    {
        $focos = Foco::with('aula')->paginate(10);
        return view('focos.index', compact('focos'));
    }

    public function create()
    {
        $aulas = Aula::orderBy('nombre')->get();
        return view('focos.create', compact('aulas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo' => 'required|string|max:50|unique:focos,codigo',
            'aula_id' => 'nullable|exists:aulas,id',
            'tipo' => 'required|string|in:LED,Fluorescente,Emergencia',
            'ubicacion' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:50',
        ]);

        Foco::create($data);

        return redirect()->route('focos.index')->with('success', 'Foco registrado correctamente.');
    }

    public function edit(Foco $foco)
    {
        $aulas = Aula::orderBy('nombre')->get();
        return view('focos.edit', compact('foco', 'aulas'));
    }

    public function update(Request $request, Foco $foco)
    {
        $data = $request->validate([
            'codigo' => 'required|string|max:50|unique:focos,codigo,' . $foco->id,
            'aula_id' => 'nullable|exists:aulas,id',
            'tipo' => 'required|string|in:LED,Fluorescente,Emergencia',
            'ubicacion' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:50',
        ]);

        $foco->update($data);

        return redirect()->route('focos.index')->with('success', 'Foco actualizado correctamente.');
    }

    public function destroy(Foco $foco)
    {
        $foco->delete();
        return redirect()->route('focos.index')->with('success', 'Foco eliminado correctamente.');
    }
}
