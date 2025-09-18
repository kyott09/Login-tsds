<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
    ];

    public function vehicleModels()
    {
        return $this->hasMany(\App\Models\VehicleModel::class, 'brand_id');
    }

}


