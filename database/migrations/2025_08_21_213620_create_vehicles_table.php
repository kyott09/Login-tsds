<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->string('patente',10)->unique();
        $table->string('color',50)->nullable(); // <- corregido
        $table->foreignId('modelo_id') // <- corregido
              ->constrained('vehicle_models')
              ->onDelete('restrict');
        $table->string('descripcion',100)->nullable(); // <- corregido
        $table->enum('estado',['activo','inactivo'])->default('activo');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
