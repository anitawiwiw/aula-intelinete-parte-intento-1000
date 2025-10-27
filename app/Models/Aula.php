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
        return $this->hasMany(Mueble::class);
    }

public function cortinas()
{
    return $this->hasMany(Cortina::class);
}

}

