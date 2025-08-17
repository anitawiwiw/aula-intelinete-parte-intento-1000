<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    protected $fillable = ['hora_inicio', 'hora_fin', 'dia', 'turno', 'estado', 'aula_id'];
    
    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
    
    public function reserva()
    {
        return $this->hasOne(Reserva::class);
    }
}