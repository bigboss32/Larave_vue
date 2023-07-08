<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('título');
            $table->string('descripción');
            $table->unsignedBigInteger('proyecto_id'); // Agregar la columna para la clave foránea

            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade'); // Definir la relación de clave foránea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
