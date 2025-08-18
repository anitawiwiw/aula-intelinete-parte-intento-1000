<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use Illuminate\Support\Facades\Auth;

class RegistroDocenteController extends Controller
{
    public function create() {
        return view('docentes.create');
    }

    public function store(Request $request) {
           $validated = $request->validate([
        'dni' => 'required|numeric',
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
}
