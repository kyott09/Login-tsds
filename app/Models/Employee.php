<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_employee_id',
        'vehicle_id',
        'fecha_ingreso',
        'skills',
        'estado_laboral',
        'fecha_inicio_licencia',
        'fecha_fin_licencia',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
        'fecha_inicio_licencia' => 'date',
        'fecha_fin_licencia' => 'date',
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }


    public function vehicle()
    {
        return $this->belongsTo(\App\Models\Vehicle::class);
    }
}
