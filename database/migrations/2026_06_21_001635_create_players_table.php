<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Crear tabla de Jugadores
 * 
 * Esta migración crea la tabla 'players' que almacena información
 * de los jugadores de fútbol que pertenecen a los equipos.
 * 
 * Campos:
 * - id: Identificador único (clave primaria)
 * - name: Nombre del jugador
 * - position: Posición del jugador en el equipo (ej: Portero, Defensa, Centrocampista, Delantero)
 * - team_id: Identificador del equipo al que pertenece el jugador (clave foránea)
 * - created_at: Fecha de creación del registro
 * - updated_at: Fecha de última actualización
 * 
 * Relaciones:
 * - Un jugador pertenece a un equipo
 */
return new class extends Migration
{
    /**
     * Ejecutar la migración
     * 
     * Crea la tabla 'players' con su estructura y relaciones
     */
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            // Identificador único autoincremental
            $table->id();
            
            // Nombre del jugador
            $table->string('name');
            
            // Posición del jugador (ej: Portero, Defensa, Centrocampista, Delantero)
            $table->string('position');
            
            // Clave foránea: Equipo al que pertenece el jugador
            // constrained() asegura que el team_id debe existir en la tabla teams
            // onDelete('cascade') - Si se elimina el equipo, se eliminan sus jugadores
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            
            // Timestamps automáticos (created_at, updated_at)
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración
     * 
     * Elimina la tabla 'players' cuando se deshace la migración
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
