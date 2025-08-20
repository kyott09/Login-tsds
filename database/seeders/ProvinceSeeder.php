<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create(['nombre' => 'Buenos Aires', 'country_id' => 1]);
        Province::create(['nombre' => 'Catamarca', 'country_id' => 1]);
        Province::create(['nombre' => 'Chaco', 'country_id' => 1]);
        Province::create(['nombre' => 'Chubut', 'country_id' => 1]);
        Province::create(['nombre' => 'Córdoba', 'country_id' => 1]);
        Province::create(['nombre' => 'Corrientes', 'country_id' => 1]);
        Province::create(['nombre' => 'Entre Ríos', 'country_id' => 1]);
        Province::create(['nombre' => 'Formosa', 'country_id' => 1]);
        Province::create(['nombre' => 'Jujuy', 'country_id' => 1]);
        Province::create(['nombre' => 'La Pampa', 'country_id' => 1]);
        Province::create(['nombre' => 'La Rioja', 'country_id' => 1]);
        Province::create(['nombre' => 'Mendoza', 'country_id' => 1]);
        Province::create(['nombre' => 'Misiones', 'country_id' => 1]);
        Province::create(['nombre' => 'Neuquén', 'country_id' => 1]);
        Province::create(['nombre' => 'Río Negro', 'country_id' => 1]);
        Province::create(['nombre' => 'Salta', 'country_id' => 1]);
        Province::create(['nombre' => 'San Juan', 'country_id' => 1]);
        Province::create(['nombre' => 'San Luis', 'country_id' => 1]);
        Province::create(['nombre' => 'Santa Cruz', 'country_id' => 1]);
        Province::create(['nombre' => 'Santa Fe', 'country_id' => 1]);
        Province::create(['nombre' => 'Santiago del Estero', 'country_id' => 1]);
        Province::create(['nombre' => 'Tierra del Fuego', 'country_id' => 1]);
        Province::create(['nombre' => 'Tucumán', 'country_id' => 1]);
    }
}
