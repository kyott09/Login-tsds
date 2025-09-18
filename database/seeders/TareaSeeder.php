<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarea;
use App\Models\User;
use Carbon\Carbon;

class TareaSeeder extends Seeder
{
    public function run()
    {
        // Asegurate de tener usuarios creados en la tabla users
        $user = User::first(); // Toma el primer usuario
        if (!$user) {
            $this->command->info('No hay usuarios en la tabla users. Por favor, crea usuarios primero.');
            return;
        }

        $estados = ['vista', 'en proceso', 'terminada', 'no terminada'];
        $servicios = [
            'instalacion_wifi',
            'mantenimiento_redes',
            'configuracion_router',
            'extension_cobertura',
            'diagnostico_problemas',
            'instalacion_camaras'
        ];
        $prioridades = ['premium', 'basico'];

        // Crear solo 2 tareas
        for ($i = 1; $i <= 2; $i++) {
            Tarea::create([
                'user_id'        => $user->id,
                'fecha_creacion' => Carbon::now()->subDays(rand(0, 10))->format('Y-m-d'),
                'servicio'       => $servicios[array_rand($servicios)],
                'prioridad'      => $prioridades[array_rand($prioridades)],
                'descripcion'    => 'Trabajo de prueba Nº ' . $i . ' para instalación y mantenimiento de Wi-Fi.',
                'estado'         => $estados[array_rand($estados)],
            ]);
        }

        $this->command->info('Se crearon 2 tareas de ejemplo correctamente.');
    }
}
