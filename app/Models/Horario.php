<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = [
        'anio',
        'division',
        'trimestre',
        'turno',
        'dia',
        'hora_inicio',
        'hora_fin',
        'materia_id',
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
}
