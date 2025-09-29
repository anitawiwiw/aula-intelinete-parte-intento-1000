<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;


use App\Models\Mueble;
use App\Models\Aula;
use Illuminate\Http\Request;

class MuebleController extends Controller
{


public function store(Request $request)
{
$data = $request->validate([
    'nombre' => 'required|string|max:255',
    'estado' => 'required|string|max:100',
    'numero_inventario' => 'required|string|unique:muebles',
    'aula_id' => 'nullable|exists:aulas,id',
]);

// Crear solo los campos de muebles
$mueble = Mueble::create($data);

if (!empty($data['aula_id'])) {
    $mueble->aulas()->attach($data['aula_id']);
}


    return redirect()->route('muebles.byAula', $data['aula_id'])
        ->with('success', 'Mueble creado.');
}

public function show($id)
{
    $aula = Aula::with('muebles')->findOrFail($id);
    return view('aulas.show', compact('aula'));
}


    public function edit(Mueble $mueble)
    {
        $aulas = Aula::all();
        return view('muebles.edit', compact('mueble', 'aulas'));
    }

public function update(Request $request, Mueble $mueble)
{
$data = $request->validate([
    'nombre' => 'required|string|max:255',
    'estado' => 'required|string|max:100',
    'numero_inventario' => 'required|string|unique:muebles',
    'aula_id' => 'nullable|exists:aulas,id',
]);

    $mueble->update($data);

    if (!empty($data['aula_id'])) {
        $mueble->aulas()->sync([$data['aula_id']]);
    }

    return redirect()->route('muebles.index')->with('success', 'Mueble actualizado.');
}


    public function destroy(Mueble $mueble)
    {
        $mueble->delete();
        return redirect()->route('muebles.index')->with('success', 'Mueble eliminado.');
    }
public function indexByAula($aulaId)
{
    $aula = Aula::with('muebles')->findOrFail($aulaId);
    $muebles = $aula->muebles()->paginate(10);

    return view('muebles.index_by_aula', compact('aula', 'muebles'));
}



public function createByAula($aulaId)
{
    $aula = Aula::findOrFail($aulaId);
    return view('muebles.create_by_aula', compact('aula'));
}



}
