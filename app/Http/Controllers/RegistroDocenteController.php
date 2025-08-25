<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException; // Asegurate de importarlo

class RegistroDocenteController extends Controller
{ 
public function index()
{
    $docentes = \App\Models\Docente::all();
    return view('docentes.index', compact('docentes'));
}


    public function create() {
        return view('docentes.create');
    }
    public function edit(Docente $docente)
    {
        return view('docentes.edit', compact('docente'));
    }    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'dni' => 'required|string|size:8',
            'especialidad' => 'required|string',
        ]);

        $docente->update([
            'nombre_completo' => $request->nombre_completo,
            'dni' => $request->dni,
            'especialidad' => $request->especialidad,
            'user_id' => $request->user_id ?: null, // <-- usar null en vez de 0
        ]);
 try {
        Docente::create([
            'user_id' => Auth::id(), 
            'nombre_completo' => Auth::user()->name,
            'dni' => $validated['dni'],
            'especialidad' => $validated['especialidad'],
        ]);
    } catch (QueryException $e) {
        // Aquí podés loguear el error si querés
        \Log::error('Error al crear docente: '.$e->getMessage());
        // Pero seguimos igual, no rompemos la app
    }
        return redirect()->route('docentes.index')->with('success', 'Docente actualizado correctamente.');
    }
    
    public function store(Request $request) {
           $validated = $request->validate([
          'dni' => 'required|string|size:8',
        'especialidad' => 'required|string',
        // ... otros campos (excepto 'nombre_completo')
    ]);

    Docente::create([
        'user_id' => Auth::id(), // ID del usuario autenticado
        'nombre_completo' => Auth::user()->name, // Nombre del usuario
        'dni' => $validated['dni'],
        'especialidad' => $validated['especialidad'],
        // ... otros campos
    ]);

    return redirect()->route('welcome')->with('success', 'Docente creado.');
}
public function create2()
{
    return view('docentes.create2'); // vista del admin
}
public function destroy(Docente $docente)
{
    $docente->delete(); // elimina el docente
    return redirect()->route('docentes.index')->with('success', 'Docente eliminado correctamente.');
}
public function store2(Request $request)
{
    $request->validate([
        'nombre_completo' => 'required|string|max:255',
        'dni' => 'required|string|size:8',
        'especialidad' => 'required|string',
    ]);

    $docente = new Docente();
    $docente->nombre_completo = $request->nombre_completo;
    $docente->dni = $request->dni;
    $docente->especialidad = $request->especialidad;
    $docente->user_id = null; // <-- clave para evitar error
    $docente->save();
    return redirect()->route('docentes.index')->with('success', 'Docente creado por admin');

}

}
