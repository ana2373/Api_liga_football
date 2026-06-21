<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Player (Jugador)
 * 
 * Representa un jugador de fútbol que pertenece a un equipo.
 * Propiedades: id, name, position, team_id
 */
class Player extends Model
{
    /**
     * Atributos que se pueden asignar de forma masiva
     */
    protected $fillable = [
        'name',
        'position',
        'team_id'
    ];

    /**
     * Relación: Un jugador pertenece a un equipo
     * Retorna el equipo del jugador
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Relación: Un jugador puede haber marcado muchos goles
     * Retorna todos los goles del jugador
     */
    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }
}
