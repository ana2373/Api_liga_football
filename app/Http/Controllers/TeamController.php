<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

/**
 * Controlador TeamController
 * 
 * Maneja todas las operaciones CRUD (Create, Read, Update, Delete) para los equipos.
 * Métodos:
 * - index():   Obtiene la lista de todos los equipos
 * - create():  Muestra formulario para crear (no se usa en API)
 * - store():   Guarda un nuevo equipo en la base de datos
 * - show():    Obtiene los detalles de un equipo específico
 * - edit():    Muestra formulario para editar (no se usa en API)
 * - update():  Actualiza la información de un equipo
 * - destroy(): Elimina un equipo de la base de datos
 */
class TeamController extends Controller
{
    /**
     * index() - Obtener lista de todos los equipos
     * 
     * GET /api/teams
     * 
     * Retorna: JSON con lista de todos los equipos
     * Ejemplo respuesta:
     * [
     *   { "id": 1, "name": "Real Madrid", "city": "Madrid", ... },
     *   { "id": 2, "name": "Barcelona", "city": "Barcelona", ... }
     * ]
     */
    public function index()
    {
        // Obtiene todos los equipos de la base de datos
        $teams = Team::all();
        return response()->json($teams);
    }

    /**
     * create() - Mostrar formulario de creación
     * 
     * GET /api/teams/create
     * 
     * Nota: Este método NO se usa en APIs REST,
     * solo en aplicaciones web tradicionales.
     */
    public function create()
    {
        // No se implementa para APIs
    }

    /**
     * store() - Crear un nuevo equipo
     * 
     * POST /api/teams
     * 
     * Recibe: JSON con datos del equipo
     * {
     *   "name": "Real Madrid",
     *   "city": "Madrid",
     *   "stadium": "Santiago Bernabéu",
     *   "capacity": 81044,
     *   "year_of_fundation": 1902,
     *   "president_id": 1
     * }
     * 
     * Retorna: El equipo creado con ID
     */
    public function store(Request $request)
    {
        // Valida que los datos requeridos estén presentes
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'stadium' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'year_of_fundation' => 'required|year',
            'president_id' => 'required|exists:presidents,id',
        ]);

        // Crea el nuevo equipo
        $team = Team::create($validated);

        // Retorna el equipo creado con código 201 (Created)
        return response()->json($team, 201);
    }

    /**
     * show() - Obtener detalles de un equipo específico
     * 
     * GET /api/teams/{id}
     * 
     * Parámetro: id del equipo
     * 
     * Retorna: JSON con los detalles del equipo, incluyendo jugadores
     * Ejemplo:
     * {
     *   "id": 1,
     *   "name": "Real Madrid",
     *   "players": [...]
     * }
     */
    public function show(Team $team)
    {
        // Retorna el equipo con sus relaciones cargadas
        return response()->json($team->load('players', 'president'));
    }

    /**
     * edit() - Mostrar formulario de edición
     * 
     * GET /api/teams/{id}/edit
     * 
     * Nota: Este método NO se usa en APIs REST,
     * solo en aplicaciones web tradicionales.
     */
    public function edit(Team $team)
    {
        // No se implementa para APIs
    }

    /**
     * update() - Actualizar un equipo
     * 
     * PUT /api/teams/{id}
     * 
     * Recibe: JSON con datos a actualizar
     * {
     *   "name": "Real Madrid CF",
     *   "capacity": 81044
     * }
     * 
     * Retorna: El equipo actualizado
     */
    public function update(Request $request, Team $team)
    {
        // Valida los datos a actualizar (todos opcionales)
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'stadium' => 'sometimes|string|max:255',
            'capacity' => 'sometimes|integer|min:1',
            'year_of_fundation' => 'sometimes|year',
            'president_id' => 'sometimes|exists:presidents,id',
        ]);

        // Actualiza el equipo con los nuevos datos
        $team->update($validated);

        // Retorna el equipo actualizado
        return response()->json($team);
    }

    /**
     * destroy() - Eliminar un equipo
     * 
     * DELETE /api/teams/{id}
     * 
     * Parámetro: id del equipo a eliminar
     * 
     * Nota: Gracias a onDelete('cascade') en la migración,
     * también elimina todos los jugadores del equipo
     * 
     * Retorna: Mensaje de confirmación (sin contenido)
     */
    public function destroy(Team $team)
    {
        // Elimina el equipo (y sus relaciones en cascada)
        $team->delete();

        // Retorna código 204 (No Content) indicando éxito sin datos
        return response()->noContent();
    }
}
