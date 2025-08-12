<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function create()
    {
        return view('reservas.create');
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'fecha' => [
            'required',
            'date',
            function ($attribute, $value, $fail) {
                $year = date('Y', strtotime($value));
                if ($year < 2025 || $year > 2030) {
                    $fail('El año debe estar entre 2025 y 2030');
                }
            }
        ],
        'hora_inicio' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) {
                $hour = date('H', strtotime($value));
                if ($hour < 7 || $hour >= 22) {
                    $fail('El horario debe ser entre 7:00 y 22:00');
                }
            }
        ],
        'hora_fin' => [
            'required',
            'date_format:H:i',
            'after:hora_inicio',
            function ($attribute, $value, $fail) {
                $hour = date('H', strtotime($value));
                if ($hour < 7 || $hour > 22) {
                    $fail('El horario debe ser entre 7:00 y 22:00');
                }
            }
        ],
        'materia' => 'required|string|max:255',
    ]);

    try {
        $reserva = new Reserva();
        $reserva->fecha = $validated['fecha'];
        $reserva->hora_inicio = $validated['hora_inicio'];
        $reserva->hora_fin = $validated['hora_fin'];
        $reserva->materia = $validated['materia'];
        $reserva->creador_username = Auth::user()->username;
        
        $reserva->save();

        return redirect()->route('reservas.create')->with('success', 'Reserva creada correctamente');
    } catch (\Exception $e) {
        return back()->with('error', 'Error al guardar la reserva: '.$e->getMessage());
    }
}}