<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sensor; // Asegúrate de importar el modelo

class SensorController extends Controller
{
    public function store(Request $request)
    {
        // Validamos que la petición contenga el campo 'tipo'
        $request->validate([
            'tipo' => 'required|string',
        ]);

        $sensor = new Sensor();
        $sensor->tipo = $request->tipo;
        // Si el valor no viene en la petición, usamos 1 por defecto
        $sensor->valor = $request->valor ?? 1;
        $sensor->save();

        return response()->json(['message' => 'Dato guardado con éxito'], 201);
    }
}