<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo President (Presidente)
 * 
 * Representa el presidente o director de un equipo de fútbol.
 * Propiedades: id, name, email, phone
 */
class President extends Model
{
    /**
     * Atributos que se pueden asignar de forma masiva
     */
    protected $fillable = [
        'name',
        'email',
        'phone'
    ];

    /**
     * Relación: Un presidente puede dirigir muchos equipos
     * Retorna todos los equipos dirigidos por este presidente
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
