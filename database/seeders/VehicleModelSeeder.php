<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleModel;

class VehicleModelSeeder extends Seeder
{
    public function run()
    {
        $models = [
            ['descripcion' => 'Corolla', 'brand_id' => 1], // Toyota
            ['descripcion' => 'Civic', 'brand_id' => 2],   // Honda
            ['descripcion' => 'Focus', 'brand_id' => 3],   // Ford
            ['descripcion' => 'Cruze', 'brand_id' => 4],   // Chevrolet
            ['descripcion' => 'Sentra', 'brand_id' => 5],  // Nissan
            ['descripcion' => 'Elantra', 'brand_id' => 6], // Hyundai
            ['descripcion' => 'Hilux', 'brand_id' => 1],   // Toyota
            ['descripcion' => 'Accord', 'brand_id' => 2],  // Honda
        ];

        foreach ($models as $model) {
            VehicleModel::create($model);
        }
    }
}
