<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Crear tabla intermedia Equipo-Partido
 * 
 * Esta migración crea la tabla 'team_games' que es una tabla intermedia
 * para la relación muchos-a-muchos entre equipos y partidos.
 * 
 * Un equipo participa en muchos partidos, y un partido tiene dos equipos participantes.
 * 
 * Campos:
 * - id: Identificador único (clave primaria)
 * - team_id: Identificador del equipo (clave foránea)
 * - game_id: Identificador del partido (clave foránea)
 * - goals: Cantidad de goles marcados por el equipo en el partido
 * - created_at: Fecha de creación del registro
 * - updated_at: Fecha de última actualización
 * 
 * Relaciones:
 * - Un registro relaciona un equipo con un partido
 * - Si se elimina un equipo o partido, se elimina automáticamente esta relación
 */
return new class extends Migration
{
    /**
     * Ejecutar la migración
     * 
     * Crea la tabla 'team_games' con su estructura
     */
    public function up(): void
    {
        Schema::create('team_games', function (Blueprint $table) {
            // Identificador único autoincremental
            $table->id();
            
            // Clave foránea: Equipo participante en el partido
            // onDelete('cascade') - Si se elimina el equipo, se elimina esta relación
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            
            // Clave foránea: Partido en el que participa el equipo
            // onDelete('cascade') - Si se elimina el partido, se elimina esta relación
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            
            // Cantidad de goles marcados por el equipo (opcional)
            $table->integer('goals')->nullable();

            // Timestamps automáticos
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración
     * 
     * Elimina la tabla 'team_games' cuando se deshace la migración
     */
    public function down(): void
    {
        Schema::dropIfExists('team_games');
    }
};
