<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Crear tabla de Goles
 * 
 * Esta migración crea la tabla 'goals' que almacena información
 * de los goles marcados en los partidos.
 * 
 * Campos:
 * - id: Identificador único (clave primaria)
 * - player_id: Identificador del jugador que marcó el gol (clave foránea)
 * - game_id: Identificador del partido en el que se marcó el gol (clave foránea)
 * - minute: Minuto del partido en el que se marcó el gol (1-120)
 * - created_at: Fecha de creación del registro
 * - updated_at: Fecha de última actualización
 * 
 * Relaciones:
 * - Un gol pertenece a un jugador (player_id)
 * - Un gol pertenece a un partido (game_id)
 */
return new class extends Migration
{
    /**
     * Ejecutar la migración
     * 
     * Crea la tabla 'goals' con su estructura y relaciones
     */
    public function up(): void
    {
        Schema::create('goals', function (Blueprint $table) {
            // Identificador único autoincremental
            $table->id();
            
            // Clave foránea: Jugador que marcó el gol
            // onDelete('cascade') - Si se elimina el jugador, se eliminan sus goles
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            
            // Clave foránea: Partido en el que se marcó el gol
            // onDelete('cascade') - Si se elimina el partido, se eliminan sus goles
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            
            // Minuto en el que se marcó el gol (entre 1 y 120 minutos)
            $table->integer('minute');

            // Timestamps automáticos
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración
     * 
     * Elimina la tabla 'goals' cuando se deshace la migración
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
