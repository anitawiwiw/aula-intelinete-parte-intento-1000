<?php

namespace App\Http\Controllers;

use App\Models\HistorialFoco;
use App\Models\Foco;
use Illuminate\Http\Request;

class HistorialFocoController extends Controller
{
    public function index()
    {
        $historiales = HistorialFoco::with('foco')->latest()->paginate(20);
        return view('historial_focos.index', compact('historiales'));
    }

    public function showByFoco($foco_id)
    {
        $foco = Foco::find($foco_id);

        if (!$foco) {
            return redirect()->route('focos.index')
                             ->with('error', 'El foco solicitado no existe.');
        }

        $historiales = HistorialFoco::where('foco_id', $foco_id)
                                    ->latest()
                                    ->paginate(20);

        return view('historial_focos.by_foco', compact('foco', 'historiales'));
    }

    // Para recibir datos de la ESP32
    public function storeFromSensor(Request $request)
    {
        $data = $request->validate([
            'foco_id' => 'required|exists:focos,id',
            'fecha' => 'nullable|date',
            'hora_inicio' => 'nullable',
            'hora_fin' => 'nullable',
            'intensidad' => 'nullable|integer',
        ]);

        $data['payload'] = $request->all();

        $hist = HistorialFoco::create($data);

        return response()->json(['ok' => true, 'id' => $hist->id], 201);
    }
}
