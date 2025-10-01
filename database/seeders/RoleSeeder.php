<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // crear permisos
        Permission::create(['name' => 'ver vehiculos']);
        Permission::create(['name' => 'crear vehiculos']);
        Permission::create(['name' => 'editar vehiculos']);
        Permission::create(['name' => 'borrar vehiculos']);
        Permission::create(['name' => 'ver tarea']);
        Permission::create(['name' => 'crear tarea']);
        Permission::create(['name' => 'editar tarea']);
        Permission::create(['name' => 'borrar tarea']);
        Permission::create(['name' => 'ver admin']);
        Permission::create(['name' => 'ver user']);

        // crear roles
        $admin = Role::create(['name' => 'admin']);
        $empleado = Role::create(['name' => 'empleado']);
        $cliente = Role::create(['name' => 'cliente']);

        // asignar permisos al rol admin
        $admin->givePermissionTo(['ver vehiculos', 'crear vehiculos', 'editar vehiculos', 'borrar vehiculos', 'ver admin', 'ver tarea', 'crear tarea', 'editar tarea', 'borrar tarea']);
        // asignar permisos al rol empleado
        $empleado->givePermissionTo(['ver vehiculos','ver user','ver tarea']);
        // asignar permisos al rol cliente
        $cliente->givePermissionTo(['ver user']);
    }
}
