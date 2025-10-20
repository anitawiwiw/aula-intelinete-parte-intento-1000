<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mueble extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'estado',
        'numero_inventario',
        'aula_id',
    ];

    /**
     * Relación inversa: un mueble pertenece a un aula.
     */
    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }
}



