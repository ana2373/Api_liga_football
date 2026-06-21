<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo Goal (Gol)
 * 
 * Representa un gol marcado en un partido por un jugador.
 * Propiedades: id, game_id, player_id, minute
 */
class Goal extends Model
{
    /**
     * Atributos que se pueden asignar de forma masiva
     */
    protected $fillable = [
        'game_id',
        'player_id',
        'minute'
    ];

    /**
     * Relación: Un gol pertenece a un partido
     * Retorna el partido en el que se marcó el gol
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Relación: Un gol fue marcado por un jugador
     * Retorna el jugador que marcó el gol
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
}
