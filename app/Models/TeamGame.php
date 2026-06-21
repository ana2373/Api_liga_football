<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo TeamGame (Equipo-Partido)
 * 
 * Tabla intermedia que relaciona los equipos con los partidos.
 * Permite manejar la relación muchos-a-muchos entre equipos y partidos.
 * Propiedades: id, team_id, game_id, goals
 */
class TeamGame extends Model
{
    /**
     * Nombre de la tabla en la base de datos
     */
    protected $table = 'team_games';

    /**
     * Atributos que se pueden asignar de forma masiva
     */
    protected $fillable = [
        'team_id',
        'game_id',
        'goals'
    ];
}
