<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarea;
use Illuminate\Support\Str;

class TareaSeeder extends Seeder
{
    public function run()
    {
        $estados = ['vista', 'en proceso', 'terminada', 'no terminada'];

        Tarea::create([
            'nombre_cliente' => 'Lucas',
            'apellido_cliente' => 'Aquino',
            'dni_cliente' => str_pad((string)random_int(10000000, 49999999), 8, '0', STR_PAD_LEFT),
            'telefono_cliente' => '+54 9 11 ' . rand(1000, 9999) . '-' . rand(1000, 9999),
            'direccion_cliente' => 'Calle 912 Nº ' . rand(1, 200),
            'descripcion' => 'Revisión y reparación de sistema eléctrico en el domicilio del cliente.',
            'estado' => $estados[array_rand($estados)],
        ]);
    }
}
