<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'carrera', 'año', 'tipo_cursada'];

    // Mutator para capitalizar la primera letra de cada palabra
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = ucwords($value);
    }

    // Relación con docentes
    public function docentes()
    {
        return $this->belongsToMany(Docente::class);
    }
}
