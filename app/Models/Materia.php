<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['nombre', 'año', 'tipo'];
    
    public function profesores()
    {
        return $this->belongsToMany(User::class, 'materia_profesor');
    }
    
    // Relación para materias conjuntas
    public function materiasComponentes()
    {
        return $this->belongsToMany(Materia::class, 'materia_conjunta', 'materia_conjunta_id', 'materia_id');
    }
}