<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Horario extends Model
{
    protected $fillable = ['dia', 'hora_inicio', 'hora_fin', 'turno', 'necesita_reserva'];
    
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}