<?php

namespace App\Http\Controllers;

use App\Models\Aire;
use Illuminate\Http\Request;

class AireController extends Controller
{
    public function index()
    {
        $aires = Aire::with('aula','ultimoHistorial')->paginate(10);
        return view('aires.index', compact('aires'));
    }

    public function create()
    {
        $aulas = \App\Models\Aula::orderBy('nombre')->get();
        return view('aires.create', compact('aulas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'aula_id' => 'nullable|exists:aulas,id',
            'marca_modelo' => 'nullable|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:50',
            'ultima_mantenimiento' => 'nullable|date',
            'observaciones' => 'nullable|string',
        ]);

        Aire::create($data);

        return redirect()->route('aires.index')->with('success', 'Aire creado.');
    }

    public function edit(Aire $aire)
    {
        $aulas = \App\Models\Aula::orderBy('nombre')->get();
        return view('aires.edit', compact('aire','aulas'));
    }

    public function update(Request $request, Aire $aire)
    {
        $data = $request->validate([
            'aula_id' => 'nullable|exists:aulas,id',
            'marca_modelo' => 'nullable|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:50',
            'ultima_mantenimiento' => 'nullable|date',
            'observaciones' => 'nullable|string',
        ]);

        $aire->update($data);

        return redirect()->route('aires.index')->with('success', 'Aire actualizado.');
    }

    public function destroy(Aire $aire)
    {
        $aire->delete();
        return redirect()->route('aires.index')->with('success', 'Aire eliminado.');
    }
}
