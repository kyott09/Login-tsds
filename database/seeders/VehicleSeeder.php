<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::create([
            'patente' => 'FG 746 RT',
            'modelo_id' => 1,
            'color' => 'Rojo',
            'descripcion' => 'Auto compacto',
            'estado' => 'Disponible',
        ]);
    }
}
