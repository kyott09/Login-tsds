<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        $vehicles = [
            [
                'patente' => 'FG 746 RT',
                'modelo_id' => 1,
                'color' => 'Rojo',
                'descripcion' => 'Auto compacto',
                'estado' => 'Disponible',
            ],
            [
                'patente' => 'AB 123 CD',
                'modelo_id' => 2,
                'color' => 'Negro',
                'descripcion' => 'Sedán moderno',
                'estado' => 'Disponible',
            ],
            [
                'patente' => 'XY 987 ZZ',
                'modelo_id' => 3,
                'color' => 'Azul',
                'descripcion' => 'Hatchback familiar',
                'estado' => 'Disponible',
            ],
            [
                'patente' => 'LM 456 YT',
                'modelo_id' => 4,
                'color' => 'Gris',
                'descripcion' => 'Vehículo económico',
                'estado' => 'Disponible',
            ],
            [
                'patente' => 'CD 321 QW',
                'modelo_id' => 5,
                'color' => 'Blanco',
                'descripcion' => 'Auto para ciudad',
                'estado' => 'Disponible',
            ],
            [
                'patente' => 'EF 765 GH',
                'modelo_id' => 6,
                'color' => 'Negro',
                'descripcion' => 'Sedán de lujo',
                'estado' => 'Disponible',
            ],
            [
                'patente' => 'JK 234 UI',
                'modelo_id' => 7,
                'color' => 'Verde',
                'descripcion' => 'Camioneta 4x4',
                'estado' => 'Disponible',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
