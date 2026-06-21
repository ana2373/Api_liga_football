<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modelo Game (Partido)
 * 
 * Representa un partido de fútbol entre dos equipos.
 * Propiedades: id, date, home_team_id, away_team_id, status
 */
class Game extends Model
{
    /**
     * Atributos que se pueden asignar de forma masiva
     */
    protected $fillable = [
        'date',
        'home_team_id',
        'away_team_id',
        'status'
    ];

    /**
     * Relación: Un partido tiene muchos goles
     * Retorna todos los goles marcados en el partido
     */
    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }

    /**
     * Relación: Un partido involucra muchos equipos (a través de tabla intermedia)
     * Retorna los equipos que juegan en el partido
     */
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_games');
    }
}
