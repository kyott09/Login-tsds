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

        // crear roles
        $admin = Role::create(['name' => 'admin']);
        $empleado = Role::create(['name' => 'empleado']);

        // asignar permisos al rol admin
        $admin->givePermissionTo(Permission::all());
        // asignar permisos al rol empleado
        $empleado->givePermissionTo(['ver vehiculos']);
    }
}
