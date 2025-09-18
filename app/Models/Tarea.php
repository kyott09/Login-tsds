<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'user_id',         // ID del usuario/cliente
        'fecha_creacion',  // Fecha de creación
        'servicio',        // Servicio elegido
        'prioridad',       // Premium o Básico
        'descripcion',     // Descripción de la tarea
        'estado',          // Estado
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
