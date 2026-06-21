<?php

namespace App\Http\Controllers;

use App\Models\TeamGame;
use Illuminate\Http\Request;

/**
 * Controlador TeamGameController
 * 
 * Maneja la relación muchos-a-muchos entre equipos y partidos.
 * Esta tabla intermedia permite que un equipo participe en múltiples partidos.
 * Métodos:
 * - index():   Obtiene todas las relaciones equipo-partido
 * - store():   Crea una nueva relación equipo-partido
 * - show():    Obtiene los detalles de una relación específica
 * - update():  Actualiza los datos de una relación
 * - destroy(): Elimina una relación
 */
class TeamGameController extends Controller
{
    /**
     * index() - Obtener lista de todas las relaciones equipo-partido
     * 
     * GET /api/team-games
     * 
     * Retorna: JSON con todas las relaciones entre equipos y partidos
     */
    public function index()
    {
        // Obtiene todas las relaciones equipo-partido
        $teamGames = TeamGame::with('team', 'game')->get();
        return response()->json($teamGames);
    }

    /**
     * create() - Mostrar formulario de creación
     * 
     * No se implementa para APIs REST
     */
    public function create()
    {
        // No se implementa para APIs
    }

    /**
     * store() - Crear una nueva relación equipo-partido
     * 
     * POST /api/team-games
     * 
     * Recibe: JSON con datos de la relación
     * {
     *   "team_id": 1,
     *   "game_id": 5,
     *   "goals": 2
     * }
     * 
     * El campo "goals" es opcional y representa los goles de ese equipo en el partido
     * 
     * Retorna: La relación creada con ID (201 Created)
     */
    public function store(Request $request)
    {
        // Valida que los datos requeridos estén presentes
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'game_id' => 'required|exists:games,id',
            'goals' => 'sometimes|integer|min:0',
        ]);

        // Crea la nueva relación
        $teamGame = TeamGame::create($validated);

        // Retorna la relación creada con código 201 (Created)
        return response()->json($teamGame, 201);
    }

    /**
     * show() - Obtener detalles de una relación equipo-partido específica
     * 
     * GET /api/team-games/{id}
     * 
     * Parámetro: id de la relación
     * 
     * Retorna: JSON con los detalles de la relación
     */
    public function show(TeamGame $teamGame)
    {
        // Retorna la relación con sus datos
        return response()->json($teamGame);
    }

    /**
     * edit() - Mostrar formulario de edición
     * 
     * No se implementa para APIs REST
     */
    public function edit(TeamGame $teamGame)
    {
        // No se implementa para APIs
    }

    /**
     * update() - Actualizar una relación equipo-partido
     * 
     * PUT /api/team-games/{id}
     * 
     * Recibe: JSON con datos a actualizar
     * {
     *   "goals": 3
     * }
     * 
     * Retorna: La relación actualizada
     */
    public function update(Request $request, TeamGame $teamGame)
    {
        // Valida los datos a actualizar (todos opcionales)
        $validated = $request->validate([
            'team_id' => 'sometimes|exists:teams,id',
            'game_id' => 'sometimes|exists:games,id',
            'goals' => 'sometimes|integer|min:0',
        ]);

        // Actualiza la relación con los nuevos datos
        $teamGame->update($validated);

        // Retorna la relación actualizada
        return response()->json($teamGame);
    }

    /**
     * destroy() - Eliminar una relación equipo-partido
     * 
     * DELETE /api/team-games/{id}
     * 
     * Parámetro: id de la relación a eliminar
     * 
     * Retorna: Mensaje de confirmación (sin contenido)
     */
    public function destroy(TeamGame $teamGame)
    {
        // Elimina la relación
        $teamGame->delete();

        // Retorna código 204 (No Content) indicando éxito sin datos
        return response()->noContent();
    }
}
