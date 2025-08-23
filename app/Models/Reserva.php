<?php

namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'materia_id',
        'dia',
        'hora_inicio',
        'hora_fin',
        'tipo_origen',
    ];

    protected $casts = [
        'hora_inicio' => 'datetime:H:i',
        'hora_fin'    => 'datetime:H:i',
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }
        public function user()  // <- esta es la relación que faltaba
    {
        return $this->belongsTo(User::class);
    }
}
