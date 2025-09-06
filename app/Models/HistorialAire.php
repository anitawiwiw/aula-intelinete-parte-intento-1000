<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialAire extends Model
{
    use HasFactory;

    protected $table = 'historial_aires';

    protected $fillable = [
        'aire_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'temperatura',
        'estado',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
        'fecha' => 'date',
    ];

public function aire()
{
    return $this->belongsTo(Aire::class);
}

}
