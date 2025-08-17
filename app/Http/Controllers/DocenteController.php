<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DocenteController extends Controller
{
    /**
     * Muestra el formulario de creación de docente
     */
    public function create()
    {
        return view('docentes.create');
    }
    public function index()
{
    // Si no quieres crear una vista, redirige al welcome
    return redirect()->route('home');
}
    /**
     * Almacena un nuevo docente (para registro inicial)
     */
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:20|unique:docentes,dni',
            'especialidad' => 'required|string|max:255'
        ]);

        Docente::create([
            'user_id' => Auth::id(),
            'nombre_completo' => Auth::user()->name,
            'dni' => $request->dni,
            'especialidad' => $request->especialidad
        ]);

        // Cerrar sesión para que puedan iniciar nuevamente
        Auth::logout();

        // Redirigir a welcome (inicio) con mensaje
        return redirect()->route('home')->with('success', 'Registro completado. Ahora puedes iniciar sesión.');
    }

    // Elimina o comenta los siguientes métodos si no los necesitas:
    /*
    public function index()
    {
        // Eliminar este método si no quieres listar docentes
        $docentes = Docente::with(['user', 'creador'])->latest()->get();
        return view('docentes.index', compact('docentes'));
    }
    
    public function update() {...}
    public function destroy() {...}
    public function asignarMaterias() {...}
    public function crearDesdeUsuario() {...}
    */
}