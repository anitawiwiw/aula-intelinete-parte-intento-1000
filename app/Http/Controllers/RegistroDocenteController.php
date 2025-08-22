<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use Illuminate\Support\Facades\Auth;

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
            'user_id' => $request->user_id ?? 0,
        ]);

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

public function store2(Request $request)
{
    $request->validate([
        'nombre_completo' => 'required|string|max:255',
        'dni' => 'required|string|size:8',
        'especialidad' => 'required|string',
    ]);

    Docente::create([
        'nombre_completo' => $request->nombre_completo,
        'dni' => $request->dni,
        'especialidad' => $request->especialidad,
        'user_id' => $request->user_id ?? null,
    ]);
    return redirect()->route('docentes.index')->with('success', 'Docente creado por admin');

}

}
