<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id(); // Número de tarea (auto incremental)
            $table->string('nombre_cliente');
            $table->string('apellido_cliente');
            $table->string('dni_cliente');
            $table->string('telefono_cliente');
            $table->string('direccion_cliente');
            $table->text('descripcion');
            $table->enum('estado', ['vista', 'en proceso', 'terminada', 'no terminada'])->default('vista');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}

