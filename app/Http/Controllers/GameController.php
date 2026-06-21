<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

/**
 * Controlador GameController
 * 
 * Maneja todas las operaciones CRUD para los partidos de fútbol.
 * Métodos:
 * - index():   Obtiene la lista de todos los partidos
 * - store():   Guarda un nuevo partido en la base de datos
 * - show():    Obtiene los detalles de un partido específico
 * - update():  Actualiza la información de un partido
 * - destroy(): Elimina un partido de la base de datos
 */
class GameController extends Controller
{
    /**
     * index() - Obtener lista de todos los partidos
     *
     * GET /api/games
     *
     * Retorna: JSON con lista de todos los partidos con sus equipos y goles
     */
    public function index()
    {
        // Obtiene todos los partidos con información de equipos y goles
        $games = Game::with('teams', 'goals')->get();
        return response()->json($games);
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
     * store() - Crear un nuevo partido
     * 
     * POST /api/games
     * 
     * Recibe: JSON con datos del partido
     * {
     *   "date": "2026-07-15 20:00:00",
     *   "home_team_id": 1,
     *   "away_team_id": 2,
     *   "status": "scheduled"
     * }
     * 
     * Estados: "scheduled", "in_progress", "finished", "postponed"
     * 
     * Retorna: El partido creado con ID (201 Created)
     */
    public function store(Request $request)
    {
        // Valida que los datos requeridos estén presentes
        $validated = $request->validate([
            'date' => 'required|date_format:Y-m-d H:i:s|after:now',
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id|different:home_team_id',
            'status' => 'sometimes|in:scheduled,in_progress,finished,postponed',
        ]);

        // Crea el nuevo partido
        $game = Game::create($validated);

        // Retorna el partido creado con código 201 (Created)
        return response()->json($game->load('teams', 'goals'), 201);
    }

    /**
     * show() - Obtener detalles de un partido específico
     *
     * GET /api/games/{id}
     *
     * Parámetro: id del partido
     *
     * Retorna: JSON con los detalles del partido, incluyendo equipos, goles y jugadores
     */
    public function show(Game $game)
    {
        // Retorna el partido con sus relaciones cargadas
        return response()->json($game->load('teams', 'goals.player'));
    }

    /**
     * edit() - Mostrar formulario de edición
     *
     * No se implementa para APIs REST
     */
    public function edit(Game $game)
    {
        // No se implementa para APIs
    }

    /**
     * update() - Actualizar un partido
     *
     * PUT /api/games/{id}
     *
     * Recibe: JSON con datos a actualizar
     * {
     *   "status": "finished",
     *   "date": "2026-07-15 21:30:00"
     * }
     *
     * Retorna: El partido actualizado
     */
    public function update(Request $request, Game $game)
    {
        // Valida los datos a actualizar (todos opcionales)
        $validated = $request->validate([
            'date' => 'sometimes|date_format:Y-m-d H:i:s',
            'home_team_id' => 'sometimes|exists:teams,id',
            'away_team_id' => 'sometimes|exists:teams,id|different:home_team_id',
            'status' => 'sometimes|in:scheduled,in_progress,finished,postponed',
        ]);

        // Actualiza el partido con los nuevos datos
        $game->update($validated);

        // Retorna el partido actualizado
        return response()->json($game);
    }

    /**
     * destroy() - Eliminar un partido
     *
     * DELETE /api/games/{id}
     *
     *Parámetro: id del partido a eliminar
     *
     * Nota: Gracias a onDelete('cascade') en la migración,
     * también elimina todos los goles registrados en el partido
     *
     * Retorna: Mensaje de confirmación (sin contenido)
     */
    public function destroy(Game $game)
    {
        // Elimina el partido (y sus goles en cascada)
        $game->delete();

        // Retorna código 204 (No Content) indicando éxito sin datos
        return response()->noContent();
    }
}
