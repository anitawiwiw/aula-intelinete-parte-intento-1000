<?php

namespace App\Http\Controllers;

use App\Models\HistorialAire;
use App\Models\Aire;
use Illuminate\Http\Request;

class HistorialAireController extends Controller
{
    public function index()
    {
        $historiales = HistorialAire::with('aire')->latest()->paginate(20);
        return view('historial_aires.index', compact('historiales'));
    }

    // POST desde ESP32
    public function storeFromSensor(Request $request)
    {
        $data = $request->validate([
            'aire_id' => 'required|exists:aires,id',
            'fecha' => 'nullable|date',
            'hora_inicio' => 'nullable',
            'hora_fin' => 'nullable',
            'temperatura' => 'nullable|numeric',
            'estado' => 'nullable|string',
        ]);

        $data['payload'] = $request->all();

        $hist = HistorialAire::create($data);

        return response()->json(['ok' => true, 'id' => $hist->id], 201);
    }
}
