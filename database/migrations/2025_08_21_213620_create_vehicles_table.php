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
            $table->string('color',50)->nulleable();
            $table->foreignID('modelo_id',50)
                ->constrained('vehicle_models')
                ->onDelete('restrict');
            $table->string('descripcion',100)->nulleable();
            $table->enum('estado',['disponible','no disponible'])->default('disponible');
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
