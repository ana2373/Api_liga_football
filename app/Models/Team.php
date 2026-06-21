<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo Team (Equipo)
 * 
 * Representa un equipo de fútbol con su información básica.
 * Propiedades: id, name, city, stadium, capacity, year_of_fundation, president_id
 */
class Team extends Model
{
    /**
     * Atributos que se pueden asignar de forma masiva
     */
    protected $fillable = [
        'name',
        'city',
        'stadium',
        'capacity',
        'year_of_fundation',
        'president_id'
    ];

    /**
     * Relación: Un equipo pertenece a un presidente
     * Retorna el presidente responsable del equipo
     */
    public function president(): BelongsTo
    {
        return $this->belongsTo(President::class);
    }

    /**
     * Relación: Un equipo tiene muchos jugadores
     * Retorna todos los jugadores del equipo
     */
    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    /**
     * Relación: Un equipo tiene muchos partidos (a través de tabla intermedia)
     */
    public function games()
    {
        return $this->belongsToMany(Game::class, 'team_games');
    }
}
