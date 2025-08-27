<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'patente',
        'modelo_id',
        'color',
        'descripcion',
        'estado',
    ];

    public function modelo()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    
}


