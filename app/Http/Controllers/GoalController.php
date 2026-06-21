<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;

/**
 * Controlador GoalController
 * 
 * Maneja todas las operaciones CRUD para los goles marcados en partidos.
 * Métodos:
 * - index():   Obtiene la lista de todos los goles
 * - store():   Guarda un nuevo gol en la base de datos
 * - show():    Obtiene los detalles de un gol específico
 * - update():  Actualiza la información de un gol
 * - destroy(): Elimina un gol de la base de datos
 */
class GoalController extends Controller
{
    /**
     * index() - Obtener lista de todos los goles
     *
     * GET /api/goals
     *
     * Retorna: JSON con lista de todos los goles con información del jugador y partido
     */
    public function index()
    {
        // Obtiene todos los goles con información del jugador y partido
        $goals = Goal::with('player', 'game')->get();
        return response()->json($goals);
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
     * store() - Registrar un nuevo gol
     * 
     * POST /api/goals
     * 
     * Recibe: JSON con datos del gol
     * {
     *   "game_id": 1,
     *   "player_id": 5,
     *   "minute": 45
     * }
     * 
     * Retorna: El gol registrado con ID (201 Created)
     */
    public function store(Request $request)
    {
        // Valida que los datos requeridos estén presentes
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'player_id' => 'required|exists:players,id',
            'minute' => 'required|integer|min:1|max:120',
        ]);

        // Crea el nuevo gol
        $goal = Goal::create($validated);

        // Retorna el gol creado con código 201 (Created)
        return response()->json($goal->load('player', 'game'), 201);
    }

    /**
     * show() - Obtener detalles de un gol específico
     * 
     * GET /api/goals/{id}
     * 
     * Parámetro: id del gol
     * 
     * Retorna: JSON con los detalles del gol, jugador y partido
     */
    public function show(Goal $goal)
    {
        // Retorna el gol con sus relaciones cargadas
        return response()->json($goal->load('player', 'game'));
    }

    /**
     * edit() - Mostrar formulario de edición
     * 
     * No se implementa para APIs REST
     */
    public function edit(Goal $goal)
    {
        // No se implementa para APIs
    }

    /**
     * update() - Actualizar un gol
     * 
     * PUT /api/goals/{id}
     * 
     * Recibe: JSON con datos a actualizar
     * {
     *   "minute": 47,
     *   "player_id": 6
     * }
     * 
     * Retorna: El gol actualizado
     */
    public function update(Request $request, Goal $goal)
    {
        // Valida los datos a actualizar (todos opcionales)
        $validated = $request->validate([
            'game_id' => 'sometimes|exists:games,id',
            'player_id' => 'sometimes|exists:players,id',
            'minute' => 'sometimes|integer|min:1|max:120',
        ]);

        // Actualiza el gol con los nuevos datos
        $goal->update($validated);

        // Retorna el gol actualizado
        return response()->json($goal);
    }

    /**
     * destroy() - Eliminar un gol
     * 
     * DELETE /api/goals/{id}
     * 
     * Parámetro: id del gol a eliminar
     *
     * Retorna: Mensaje de confirmación (sin contenido)
     */
    public function destroy(Goal $goal)
    {
        // Elimina el gol
        $goal->delete();

        // Retorna código 204 (No Content) indicando éxito sin datos
        return response()->noContent();
    }
}
