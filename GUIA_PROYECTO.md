# 📚 Guía de la Liga de Fútbol API

## 📋 Descripción General
Sistema Laravel para administrar equipos, jugadores, presidentes y partidos de una liga de fútbol.

---

## 🏗️ Estructura del Proyecto

### 📁 Carpetas Principales

#### `app/Models/`
**Modelos de Datos** - Representan las entidades de la base de datos

| Modelo | Descripción |
|--------|-------------|
| **User** | Usuario del sistema (autenticación) |
| **President** | Presidente/Director de un equipo |
| **Team** | Equipo de fútbol |
| **Player** | Jugador de un equipo |
| **Game** | Partido entre dos equipos |
| **Goal** | Gol marcado en un partido |
| **TeamGame** | Tabla intermedia (Equipo-Partido) |

#### `app/Http/Controllers/`
**Controladores** - Lógica de negocio para cada modelo

Cada controlador implementa:
- `index()`: Lista todos los registros
- `show()`: Obtiene un registro específico
- `store()`: Crea un nuevo registro
- `update()`: Actualiza un registro
- `destroy()`: Elimina un registro

#### `routes/`
**Rutas de la Aplicación**

| Archivo | Tipo | Uso |
|---------|------|-----|
| `web.php` | Rutas Web | Renderiza vistas Blade (HTML) |
| `api.php` | Rutas API | Endpoints REST en JSON |

#### `database/migrations/`
**Migraciones** - Define la estructura de tablas

Las migraciones crean las tablas en este orden:
1. `users_table` - Usuarios del sistema
2. `presidents_table` - Presidentes
3. `teams_table` - Equipos (relacionados con presidentes)
4. `players_table` - Jugadores (relacionados con equipos)
5. `games_table` - Partidos
6. `goals_table` - Goles (relacionados con partidos y jugadores)
7. `team_games_table` - Relación muchos-a-muchos

#### `resources/views/`
**Vistas** - Interfaces HTML con Blade

| Vista | Descripción |
|-------|------------|
| `layouts/home.blade.php` | Página de inicio |
| `equipos.blade.php` | Listado de equipos |
| `jugadores.blade.php` | Listado de jugadores |

---

## 🔗 Relaciones Entre Modelos

```
President (1) ──────────── (N) Team
                              │
                              │
                         (1) ├─ (N) Player
                              │
                              │
                         (N) ├─ (N) Game (mediante TeamGame)
                              │
                              
Player (1) ──────────── (N) Goal (1) ──────────── (1) Game

Game (1) ──────────── (N) Goal
  │
  └─ (N) Team (mediante TeamGame)
```

---

## 📡 Endpoints API Disponibles

### Presidentes
```
GET    /api/presidents          - Listar todos los presidentes
POST   /api/presidents          - Crear un nuevo presidente
GET    /api/presidents/{id}     - Obtener detalles de un presidente
PUT    /api/presidents/{id}     - Actualizar un presidente
DELETE /api/presidents/{id}     - Eliminar un presidente
```

### Equipos
```
GET    /api/teams               - Listar todos los equipos
POST   /api/teams               - Crear un nuevo equipo
GET    /api/teams/{id}          - Obtener detalles de un equipo
PUT    /api/teams/{id}          - Actualizar un equipo
DELETE /api/teams/{id}          - Eliminar un equipo
```

### Jugadores
```
GET    /api/players             - Listar todos los jugadores
POST   /api/players             - Crear un nuevo jugador
GET    /api/players/{id}        - Obtener detalles de un jugador
PUT    /api/players/{id}        - Actualizar un jugador
DELETE /api/players/{id}        - Eliminar un jugador
```

### Partidos
```
GET    /api/games               - Listar todos los partidos
POST   /api/games               - Crear un nuevo partido
GET    /api/games/{id}          - Obtener detalles de un partido
PUT    /api/games/{id}          - Actualizar un partido
DELETE /api/games/{id}          - Eliminar un partido
```

### Goles
```
GET    /api/goals               - Listar todos los goles
POST   /api/goals               - Registrar un nuevo gol
GET    /api/goals/{id}          - Obtener detalles de un gol
PUT    /api/goals/{id}          - Actualizar un gol
DELETE /api/goals/{id}          - Eliminar un gol
```

---

## 🌐 Rutas Web (Interfaz)

| Ruta | Vista | Descripción |
|------|-------|------------|
| `/` | home.blade.php | Página de inicio con navegación |
| `/equipos` | equipos.blade.php | Listado de equipos |
| `/jugadores` | jugadores.blade.php | Listado de jugadores |

---

## 📝 Ejemplo: Crear un Equipo

### Solicitud POST
```bash
curl -X POST http://localhost:8000/api/teams \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Real Madrid",
    "city": "Madrid",
    "stadium": "Santiago Bernabéu",
    "capacity": 81044,
    "year_of_fundation": 1902,
    "president_id": 1
  }'
```

### Respuesta (201 Created)
```json
{
  "id": 1,
  "name": "Real Madrid",
  "city": "Madrid",
  "stadium": "Santiago Bernabéu",
  "capacity": 81044,
  "year_of_fundation": 1902,
  "president_id": 1,
  "created_at": "2026-06-21T10:30:00Z",
  "updated_at": "2026-06-21T10:30:00Z"
}
```

---

## 🛠️ Cómo Implementar Funcionalidades

### 1. Agregar una Nueva Característica

**Paso 1:** Crear la migración
```bash
php artisan make:migration create_nombre_table
```

**Paso 2:** Crear el modelo
```bash
php artisan make:model NombreModelo
```

**Paso 3:** Crear el controlador
```bash
php artisan make:controller NombreController --model=NombreModelo
```

**Paso 4:** Registrar las rutas en `routes/api.php`
```php
Route::apiResource('nombre', NombreController::class);
```

### 2. Implementar Validaciones en un Controller

Ver `TeamController.php` como ejemplo - incluye validaciones en `store()` y `update()`.

### 3. Cargar Relaciones

En los métodos del controlador usa `->load()`:
```php
return response()->json($team->load('players', 'president', 'games'));
```

---

## 🔍 Archivos Comentados

✅ **Modelos** - Todos los modelos tienen comentarios y relaciones definidas
✅ **Controllers** - `TeamController` tiene ejemplos completos de implementación
✅ **Rutas** - `web.php` y `api.php` están documentadas
✅ **Vistas** - `home.blade.php` tiene estructura clara y comentarios

---

## 📚 Próximos Pasos

1. ✅ Revisar y entender los modelos y relaciones
2. 📝 Implementar los otros controladores siguiendo el ejemplo de `TeamController`
3. 🎨 Completar las vistas Blade (`equipos.blade.php`, `jugadores.blade.php`)
4. 🧪 Realizar pruebas con Postman o similar
5. 🚀 Desplegar en servidor

---

**Creado:** 21 de junio de 2026  
**Framework:** Laravel  
**Lenguaje:** PHP + Blade  
**API:** REST JSON
