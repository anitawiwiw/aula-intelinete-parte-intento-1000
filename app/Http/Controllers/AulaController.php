<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index()
    {
        $aulas = Aula::all();
        return view('aulas.index', compact('aulas'));
    }

    public function create()
    {
        return view('aulas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|integer|min:1|max:10',
            'capacidad' => 'required|integer|max:35',
        ]);

        Aula::create($request->all());
        return redirect()->route('aulas.index')->with('success', 'Aula creada correctamente');
    }

    public function edit(Aula $aula)
    {
        return view('aulas.edit', compact('aula'));
    }

    public function update(Request $request, Aula $aula)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|integer|min:1|max:10',
            'capacidad' => 'required|integer|max:35',
        ]);

        $aula->update($request->all());
        return redirect()->route('aulas.index')->with('success', 'Aula actualizada correctamente');
    }

    public function destroy(Aula $aula)
    {
        $aula->delete();
        return redirect()->route('aulas.index')->with('success', 'Aula eliminada correctamente');
    }
}
