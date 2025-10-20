<?php

namespace App\Http\Controllers;

use App\Models\Mueble;
use App\Models\Aula;
use Illuminate\Http\Request;

class MuebleController extends Controller
{
    /**
     * Mostrar todos los muebles de un aula específica.
     */
    public function indexByAula($aulaId)
    {
        $aula = Aula::with('muebles')->findOrFail($aulaId);
        $muebles = $aula->muebles()->orderBy('nombre')->paginate(10);

        return view('muebles.index_by_aula', compact('aula', 'muebles'));
    }

    /**
     * Mostrar formulario de creación de un mueble dentro de un aula.
     */
    public function createByAula($aulaId)
    {
        $aula = Aula::findOrFail($aulaId);
        return view('muebles.create_by_aula', compact('aula'));
    }

    /**
     * Guardar un nuevo mueble.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|string|max:100',
            'numero_inventario' => 'required|string|max:100',
            'aula_id' => 'required|exists:aulas,id',
        ]);

        Mueble::create($data);

        return redirect()
            ->route('muebles.byAula', $data['aula_id'])
            ->with('success', '✅ Mueble creado correctamente.');
    }

    /**
     * Mostrar un aula y sus muebles (vista detallada).
     */
    public function show($id)
    {
        $aula = Aula::with('muebles')->findOrFail($id);
        return view('aulas.show', compact('aula'));
    }

    /**
     * Mostrar formulario de edición de un mueble.
     */
    public function edit(Mueble $mueble)
    {
        $aulas = Aula::orderBy('nombre')->get();
        return view('muebles.edit', compact('mueble', 'aulas'));
    }

    /**
     * Actualizar datos del mueble.
     */
    public function update(Request $request, Mueble $mueble)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|string|max:100',
            'numero_inventario' => 'required|string|max:100',
            'aula_id' => 'required|exists:aulas,id',
        ]);

        $mueble->update($data);

        return redirect()
            ->route('muebles.byAula', $data['aula_id'])
            ->with('success', '✅ Mueble actualizado correctamente.');
    }

    /**
     * Eliminar un mueble.
     */
    public function destroy(Mueble $mueble)
    {
        $aulaId = $mueble->aula_id;
        $mueble->delete();

        return redirect()
            ->route('muebles.byAula', $aulaId)
            ->with('success', '🗑️ Mueble eliminado correctamente.');
    }
}

