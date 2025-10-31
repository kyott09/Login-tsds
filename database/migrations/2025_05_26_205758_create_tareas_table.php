<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();

            // Relación con users
            $table->unsignedBigInteger('user_id');

            // Nombre del usuario (opcional)
            $table->string('nombre')->nullable();

            // Fechas
            $table->date('fecha_creacion')->nullable();
            $table->date('fecha_fin')->nullable(); // 👈 nuevo campo

            // Servicio y prioridad
            $table->string('servicio');
            $table->enum('prioridad', ['premium', 'basico'])->default('basico');

            // Descripción y estado
            $table->text('descripcion');
            $table->enum('estado', ['vista', 'en proceso', 'terminada', 'no terminada'])->default('vista');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
