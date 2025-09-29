<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mueble extends Model
{
    protected $fillable = [
        'nombre',
        'estado',
        'numero_inventario',
        'aula_id',
    ];

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
}


