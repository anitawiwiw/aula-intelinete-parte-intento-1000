<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aire extends Model
{
    use HasFactory;

    protected $fillable = [
        'aula_id',
        'marca_modelo',
        'ubicacion',
        'estado',
        'ultima_mantenimiento',
        'observaciones',
    ];

 protected $casts = [
    'ultima_mantenimiento' => 'date',
];


    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

    public function historial()
    {
        return $this->hasMany(HistorialAire::class);
    }

    public function ultimoHistorial()
    {
        return $this->hasOne(HistorialAire::class)->latestOfMany();
    }
}
