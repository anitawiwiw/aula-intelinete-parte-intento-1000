<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

  protected $fillable = ['nombre_completo', 'dni', 'especialidad', 'user_id'];
public function materias()
{
    return $this->belongsToMany(Materia::class);
}

}
