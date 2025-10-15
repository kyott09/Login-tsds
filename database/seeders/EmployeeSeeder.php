<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        // Crea 10 empleados demo
        Employee::factory()->count(10)->create();
    }
}
