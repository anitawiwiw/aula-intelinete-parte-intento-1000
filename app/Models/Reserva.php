<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

  protected $fillable = [
    'numero_reserva',
    'fecha',
    'hora_inicio',
    'hora_fin',
    'materia',
    'creador_username',
];

    // Desactivar timestamps si no las usas
    public $timestamps = false;

    // Opcional: generar el número de reserva automáticamente
    public static function boot()
    {
        parent::boot();

        static::creating(function ($reserva) {
            // Generar un número aleatorio único de 4 cifras
            do {
                $numero = mt_rand(1000, 9999);
            } while (self::where('numero_reserva', $numero)->exists());

            $reserva->numero_reserva = $numero;
        });
    }
}