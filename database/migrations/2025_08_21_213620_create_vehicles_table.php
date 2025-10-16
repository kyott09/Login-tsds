<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('patente',10)->unique();
            $table->string('color',50)->nullable();
            $table->foreignId('modelo_id')
                  ->constrained('vehicle_models')
                  ->onDelete('restrict');
            $table->string('descripcion',100)->nullable();
            $table->enum('estado',['disponible','no disponible'])->default('disponible');
            $table->timestamps(); // ✅ created_at y updated_at automáticos
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
