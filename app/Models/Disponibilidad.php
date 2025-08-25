<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'aula_id','dia','turno','hora_inicio','hora_fin','estado'
    ];

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
}
