<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;
use App\Models\Materia;

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
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|integer|between:1,7',
            'capacidad' => 'required|integer|min:1'
        ]);
        
        Aula::create($validated);
        
         return redirect()->route('dashboard')->with('success', 'Aula creada exitosamente');
    }
    private function recomendarAulas($materia_ids)
{
    $materias = Materia::with('docentes')->find($materia_ids);
    
    $tiposAula = collect();
    
    foreach ($materias as $materia) {
        if (str_contains($materia->nombre, 'Robótica') || str_contains($materia->nombre, 'Tecnología')) {
            $tiposAula->push('Maker');
            $tiposAula->push('Maker Lab');
        } elseif (str_contains($materia->nombre, 'Ciencias') || str_contains($materia->nombre, 'Laboratorio')) {
            $tiposAula->push('Laboratorio');
        } elseif (str_contains($materia->nombre, 'Letras') || str_contains($materia->nombre, 'Humanidades')) {
            $tiposAula->push('Letras');
        } elseif (str_contains($materia->nombre, 'Matemática') || str_contains($materia->nombre, 'Exactas')) {
            $tiposAula->push('Exactas');
        } else {
            $tiposAula->push('Sociales');
        }
    }
    
    $tiposUnicos = $tiposAula->unique();
    
    return Aula::whereIn('nombre', $tiposUnicos)->get();
}
}
