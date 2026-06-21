<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

/**
 * Controlador PlayerController
 * 
 * Maneja todas las operaciones CRUD (Create, Read, Update, Delete) para los jugadores.
 * Métodos:
 * - index():   Obtiene la lista de todos los jugadores
 * - store():   Guarda un nuevo jugador en la base de datos
 * - show():    Obtiene los detalles de un jugador específico
 * - update():  Actualiza la información de un jugador
 * - destroy(): Elimina un jugador de la base de datos
 */
class PlayerController extends Controller
{
    /**
     * index() - Obtener lista de todos los jugadores
     * 
     * GET /api/players
     * 
     * Retorna: JSON con lista de todos los jugadores con sus relaciones
     */
    public function index()
    {
        // Obtiene todos los jugadores con información del equipo
        $players = Player::with('team', 'goals')->get();
        return response()->json($players);
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
     * store() - Crear un nuevo jugador
     * 
     * POST /api/players
     * 
     * Recibe: JSON con datos del jugador
     * {
     *   "name": "Cristiano Ronaldo",
     *   "position": "Delantero",
     *   "team_id": 1
     * }
     * 
     * Retorna: El jugador creado con ID (201 Created)
     */
    public function store(Request $request)
    {
        // Valida que los datos requeridos estén presentes
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:100',
            'team_id' => 'required|exists:teams,id',
        ]);

        // Crea el nuevo jugador
        $player = Player::create($validated);

        // Retorna el jugador creado con código 201 (Created)
        return response()->json($player->load('team'), 201);
    }

    /**
     * show() - Obtener detalles de un jugador específico
     * 
     * GET /api/players/{id}
     * 
     * Parámetro: id del jugador
     * 
     * Retorna: JSON con los detalles del jugador, incluyendo equipo y goles
     */
    public function show(Player $player)
    {
        // Retorna el jugador con sus relaciones cargadas
        return response()->json($player->load('team', 'goals'));
    }

    /**
     * edit() - Mostrar formulario de edición
     * 
     * No se implementa para APIs REST
     */
    public function edit(Player $player)
    {
        // No se implementa para APIs
    }

    /**
     * update() - Actualizar un jugador
     * 
     * PUT /api/players/{id}
     * 
     * Recibe: JSON con datos a actualizar
     * {
     *   "name": "CR7",
     *   "position": "Extremo",
     *   "team_id": 2
     * }
     * 
     * Retorna: El jugador actualizado
     */
    public function update(Request $request, Player $player)
    {
        // Valida los datos a actualizar (todos opcionales)
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'position' => 'sometimes|string|max:100',
            'team_id' => 'sometimes|exists:teams,id',
        ]);

        // Actualiza el jugador con los nuevos datos
        $player->update($validated);

        // Retorna el jugador actualizado
        return response()->json($player);
    }

    /**
     * destroy() - Eliminar un jugador
     * 
     * DELETE /api/players/{id}
     * 
     * Parámetro: id del jugador a eliminar
     * 
     * Retorna: Mensaje de confirmación (sin contenido)
     */
    public function destroy(Player $player)
    {
        // Elimina el jugador
        $player->delete();

        // Retorna código 204 (No Content) indicando éxito sin datos
        return response()->noContent();
    }
}
