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
        $request->validate([
            'dni' => 'required|string|max:20',
            'especialidad' => 'required|string'
        ]);

        Docente::create([
            'user_id' => Auth::id(),
            'dni' => $request->dni,
            'especialidad' => $request->especialidad
        ]);

        return redirect()->route('home')->with('success', 'Datos de docente guardados. Ahora puedes iniciar sesión.');
    }
}
