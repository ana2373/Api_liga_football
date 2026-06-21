<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración: Crear tabla de Presidentes
 * 
 * Esta migración crea la tabla 'presidents' que almacena información
 * de los presidentes/directores de los equipos de fútbol.
 * 
 * Campos:
 * - id: Identificador único (clave primaria)
 * - name: Nombre del presidente
 * - email: Correo electrónico del presidente
 * - phone: Número de teléfono del presidente
 * - created_at: Fecha de creación del registro
 * - updated_at: Fecha de última actualización
 */
return new class extends Migration
{
    /**
     * Ejecutar la migración
     * 
     * Crea la tabla 'presidents' con su estructura
     */
    public function up(): void
    {
        Schema::create('presidents', function (Blueprint $table) {
            // Identificador único autoincremental
            $table->id();
            
            // Nombre del presidente
            $table->string('name');
            
            // Email del presidente (único)
            $table->string('email')->unique();
            
            // Teléfono del presidente
            $table->string('phone');
            
            // Timestamps automáticos
            $table->timestamps();
        });
    }

    /**
     * Revertir la migración
     * 
     * Elimina la tabla 'presidents' cuando se deshace la migración
     */
    public function down(): void
    {
        Schema::dropIfExists('presidents');
    }
};
