<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foco extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'aula_id',
        'tipo',
        'ubicacion',
        'estado',
    ];

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

    public function historiales()
    {
        return $this->hasMany(HistorialFoco::class);
    }
}

