<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Aula extends Model
{
     use HasFactory;
    protected $fillable = ['nombre', 'ubicacion', 'capacidad'];
    
    public function disponibilidades()
    {
        return $this->hasMany(Disponibilidad::class);
    }
    
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
public function muebles()
{
    return $this->belongsToMany(Mueble::class, 'aula_mueble');
}

}

