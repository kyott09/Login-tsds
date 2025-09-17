<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'nombre_cliente',
        'apellido_cliente',
        'dni_cliente',
        'telefono_cliente',
        'direccion_cliente',
        'descripcion',
        'estado',
    ];
}
