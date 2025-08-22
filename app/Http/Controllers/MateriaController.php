<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Docente;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::with('docentes')->get();
        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        $docentes = Docente::all();
        return view('materias.create', compact('docentes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'carrera' => 'required|in:Opcion 1,Opcion 2',
            'año' => 'required|in:1A,1B,1C,2A,2B,2C,3A,3B,3C,4A,4B,5A',
            'tipo_cursada' => 'required|in:basica,especializada',
            'docentes' => 'array',
            'docentes.*' => 'exists:docentes,id',
        ]);

        $materia = Materia::create($data);
        $materia->docentes()->sync($request->docentes ?? []);

        return redirect()->route('materias.index')->with('success', 'Materia creada correctamente.');
    }
    public function edit(Materia $materia)
{
    $docentes = Docente::all();
    return view('materias.edit', compact('materia', 'docentes'));
}

public function update(Request $request, Materia $materia)
{
    $data = $request->validate([
        'nombre' => 'required|string|max:255',
        'carrera' => 'required|in:Opcion 1,Opcion 2',
        'año' => 'required|in:1A,1B,1C,2A,2B,2C,3A,3B,3C,4A,4B,5A',
        'tipo_cursada' => 'required|in:basica,especializada',
        'docentes' => 'array',
        'docentes.*' => 'exists:docentes,id',
    ]);

    $materia->update($data);
    $materia->docentes()->sync($request->docentes ?? []);

    return redirect()->route('materias.index')->with('success', 'Materia actualizada correctamente.');
}

public function destroy(Materia $materia)
{
    $materia->delete();
    return redirect()->route('materias.index')->with('success', 'Materia eliminada correctamente.');
}
}

