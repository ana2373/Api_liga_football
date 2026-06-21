<?php

namespace App\Http\Controllers;

use App\Models\President;
use Illuminate\Http\Request;

/**
 * Controlador PresidentController
 * 
 * Maneja todas las operaciones CRUD para los presidentes de equipos.
 * Métodos:
 * - index():   Obtiene la lista de todos los presidentes
 * - store():   Guarda un nuevo presidente en la base de datos
 * - show():    Obtiene los detalles de un presidente específico
 * - update():  Actualiza la información de un presidente
 * - destroy(): Elimina un presidente de la base de datos
 */
class PresidentController extends Controller
{
    /**
     * index() - Obtener lista de todos los presidentes
     * 
     * GET /api/presidents
     * 
     * Retorna: JSON con lista de todos los presidentes con sus equipos
     */
    public function index()
    {
        // Obtiene todos los presidentes con información de sus equipos
        $presidents = President::with('teams')->get();
        return response()->json($presidents);
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
     * store() - Crear un nuevo presidente
     * 
     * POST /api/presidents
     * 
     * Recibe: JSON con datos del presidente
     * {
     *   "name": "Juan Pérez",
     *   "email": "juan@example.com",
     *   "phone": "+34 612345678"
     * }
     * 
     * Retorna: El presidente creado con ID (201 Created)
     */
    public function store(Request $request)
    {
        // Valida que los datos requeridos estén presentes
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:presidents,email',
            'phone' => 'required|string|max:20',
        ]);

        // Crea el nuevo presidente
        $president = President::create($validated);

        // Retorna el presidente creado con código 201 (Created)
        return response()->json($president, 201);
    }

    /**
     * show() - Obtener detalles de un presidente específico
     * 
     * GET /api/presidents/{id}
     * 
     * Parámetro: id del presidente
     * 
     * Retorna: JSON con los detalles del presidente, incluyendo sus equipos
     */
    public function show(President $president)
    {
        // Retorna el presidente con sus relaciones cargadas
        return response()->json($president->load('teams'));
    }

    /**
     * edit() - Mostrar formulario de edición
     * 
     * No se implementa para APIs REST
     */
    public function edit(President $president)
    {
        // No se implementa para APIs
    }

    /**
     * update() - Actualizar un presidente
     * 
     * PUT /api/presidents/{id}
     * 
     * Recibe: JSON con datos a actualizar
     * {
     *   "name": "Juan Carlos Pérez",
     *   "email": "juancarlos@example.com",
     *   "phone": "+34 612345679"
     * }
     * 
     * Retorna: El presidente actualizado
     */
    public function update(Request $request, President $president)
    {
        // Valida los datos a actualizar (todos opcionales)
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:presidents,email,' . $president->id,
            'phone' => 'sometimes|string|max:20',
        ]);

        // Actualiza el presidente con los nuevos datos
        $president->update($validated);

        // Retorna el presidente actualizado
        return response()->json($president);
    }

    /**
     * destroy() - Eliminar un presidente
     * 
     * DELETE /api/presidents/{id}
     * 
     * Parámetro: id del presidente a eliminar
     * 
     * Nota: Gracias a onDelete('cascade') en la migración,
     * también elimina todos los equipos asociados al presidente
     * 
     * Retorna: Mensaje de confirmación (sin contenido)
     */
    public function destroy(President $president)
    {
        // Elimina el presidente (y sus equipos en cascada)
        $president->delete();

        // Retorna código 204 (No Content) indicando éxito sin datos
        return response()->noContent();
    }
}
