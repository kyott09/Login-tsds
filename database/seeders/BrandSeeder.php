<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            'Toyota',
            'Honda',
            'Ford',
            'Chevrolet',
            'Nissan',
            'Hyundai',
        ];

        foreach ($brands as $brand) {
            Brand::create(['descripcion' => $brand]);
        }
    }
}
