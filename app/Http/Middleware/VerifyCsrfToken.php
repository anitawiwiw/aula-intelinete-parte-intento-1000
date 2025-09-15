<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */

    protected $except = [
         'sensor/aire',   // ruta POST desde ESP32 aire
         'sensor/foco',   // ruta POST desde ESP32 foco
         'sensores' // 👈 nuestra ruta para la ESP32
    ];
}
