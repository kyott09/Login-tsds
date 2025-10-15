<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // idEmpleado
            $table->unsignedBigInteger('user_id')->nullable(); // idUsuario
            $table->unsignedBigInteger('vehicle_id')->nullable(); // idVehiculo

            $table->date('fecha_ingreso')->nullable();
            $table->text('skills')->nullable();
            $table->string('estado_laboral')->nullable();

            $table->date('fecha_inicio_licencia')->nullable();
            $table->date('fecha_fin_licencia')->nullable();

            $table->timestamps();

            // Foreign keys (si no existen tablas, borra/ajusta estas líneas)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['vehicle_id']);
        });
        Schema::dropIfExists('employees');
    }
}
