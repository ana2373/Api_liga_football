<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Crear tabla de Equipos
 * 
 * Esta migración crea la tabla 'teams' que almacena información
 * de los equipos de fútbol de la liga.
 * 
 * Campos:
 * - id: Identificador único (clave primaria)
 * - name: Nombre del equipo
 * - city: Ciudad donde está ubicado el equipo
 * - stadium: Nombre del estadio del equipo
 * - capacity: Capacidad del estadio (número de espectadores)
 * - year_of_fundation: Año de fundación del equipo
 * - president_id: Identificador del presidente del equipo (clave foránea)
 * - created_at: Fecha de creación del registro
 * - updated_at: Fecha de última actualización
 * 
 * Relaciones:
 * - Un equipo pertenece a un presidente
 */
return new class extends Migration
{
    /**
     * Ejecutar la migración
     * 
     * Crea la tabla 'teams' con su estructura y relaciones
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            // Identificador único autoincremental
            $table->id();
            
            // Nombre del equipo
            $table->string('name');
            
            // Ciudad del equipo
            $table->string('city');
            
            // Nombre del estadio
            $table->string('stadium');
            
            // Capacidad del estadio
            $table->integer('capacity');
            
            // Año de fundación del equipo
            $table->year('year_of_fundation');
            
            // Clave foránea: Presidente del equipo
            // constrained() asegura que el presidente_id debe existir en la tabla presidents
            // onDelete('cascade') - Si se elimina el presidente, se eliminan sus equipos
            $table->foreignId('president_id')->constrained()->onDelete('cascade');
            
            // Timestamps automáticos (created_at, updated_at)
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración
     * 
     * Elimina la tabla 'teams' cuando se deshace la migración
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
