<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Crear tabla de Partidos
 * 
 * Esta migración crea la tabla 'games' que almacena información
 * de los partidos de fútbol.
 * 
 * Campos:
 * - id: Identificador único (clave primaria)
 * - date: Fecha y hora del partido
 * - status: Estado del partido (scheduled, in_progress, finished, postponed)
 * - created_at: Fecha de creación del registro
 * - updated_at: Fecha de última actualización
 */
return new class extends Migration
{
    /**
     * Ejecutar la migración
     * 
     * Crea la tabla 'games' con su estructura
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            // Identificador único autoincremental
            $table->id();
            
            // Fecha y hora del partido
            $table->dateTime('date');
            
            // Estado del partido
            $table->enum('status', ['scheduled', 'in_progress', 'finished', 'postponed'])->default('scheduled');
            
            // Timestamps automáticos
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración
     * 
     * Elimina la tabla 'games' cuando se deshace la migración
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
