<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialFoco extends Model
{
    use HasFactory;

    protected $fillable = [
        'foco_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'intensidad',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    public function foco()
    {
        return $this->belongsTo(Foco::class);
    }
}
