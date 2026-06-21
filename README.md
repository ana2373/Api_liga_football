# ⚽ Football League API

Sistema completo de gestión de liga de fútbol desarrollado con **Laravel 11** y **PHP**.

## 📋 Descripción

Aplicación web y API REST para administrar:
- ✅ **Equipos** - Información completa de cada equipo
- ✅ **Jugadores** - Registro de jugadores por equipo
- ✅ **Presidentes** - Directores/presidentes de equipos
- ✅ **Partidos** - Calendario y resultados
- ✅ **Goles** - Registro de anotaciones

## 🚀 Características

- **API REST** con endpoints completos
- **Interfaz web** con Blade templates
- **Base de datos** relacional con migraciones
- **Validación** de datos en todos los endpoints
- **Bootstrap 5** para estilos responsivos
- **Código comentado** y bien organizado

## 📦 Tecnologías

| Tecnología | Versión | Uso |
|-----------|---------|-----|
| Laravel | 11.x | Framework backend |
| PHP | 8.2+ | Lenguaje de programación |
| MySQL | 8.0+ | Base de datos |
| Bootstrap | 5.3.3 | Framework CSS |
| Blade | - | Motor de templates |

## 🔧 Instalación

### 1. Clonar el repositorio
```bash
git clone <url-del-repositorio>
cd football-league
```

### 2. Instalar dependencias
```bash
composer install
```

### 3. Configurar archivo `.env`
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar base de datos
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=football_league
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Ejecutar migraciones
```bash
php artisan migrate
```

### 6. Iniciar servidor
```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

## 📡 Endpoints de la API

### Base URL
```
http://localhost:8000/api
```

### Presidentes
```
GET    /api/presidents           - Listar todos
POST   /api/presidents           - Crear
GET    /api/presidents/{id}      - Ver detalles
PUT    /api/presidents/{id}      - Actualizar
DELETE /api/presidents/{id}      - Eliminar
```

### Equipos
```
GET    /api/teams                - Listar todos
POST   /api/teams                - Crear
GET    /api/teams/{id}           - Ver detalles
PUT    /api/teams/{id}           - Actualizar
DELETE /api/teams/{id}           - Eliminar
```

### Jugadores
```
GET    /api/players              - Listar todos
POST   /api/players              - Crear
GET    /api/players/{id}         - Ver detalles
PUT    /api/players/{id}         - Actualizar
DELETE /api/players/{id}         - Eliminar
```

### Partidos
```
GET    /api/games                - Listar todos
POST   /api/games                - Crear
GET    /api/games/{id}           - Ver detalles
PUT    /api/games/{id}           - Actualizar
DELETE /api/games/{id}           - Eliminar
```

### Goles
```
GET    /api/goals                - Listar todos
POST   /api/goals                - Crear
GET    /api/goals/{id}           - Ver detalles
PUT    /api/goals/{id}           - Actualizar
DELETE /api/goals/{id}           - Eliminar
```

## 📚 Ejemplos de Solicitudes

### Crear un Equipo
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

### Crear un Jugador
```bash
curl -X POST http://localhost:8000/api/players \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Vinícius Jr.",
    "position": "Extremo",
    "team_id": 1
  }'
```

### Registrar un Gol
```bash
curl -X POST http://localhost:8000/api/goals \
  -H "Content-Type: application/json" \
  -d '{
    "game_id": 1,
    "player_id": 5,
    "minute": 45
  }'
```

## 🗄️ Estructura de la Base de Datos

```
presidents
├─ id (PK)
├─ name
├─ email
├─ phone
└─ timestamps

teams
├─ id (PK)
├─ name
├─ city
├─ stadium
├─ capacity
├─ year_of_fundation
├─ president_id (FK → presidents)
└─ timestamps

players
├─ id (PK)
├─ name
├─ position
├─ team_id (FK → teams)
└─ timestamps

games
├─ id (PK)
├─ date
├─ status
└─ timestamps

goals
├─ id (PK)
├─ player_id (FK → players)
├─ game_id (FK → games)
├─ minute
└─ timestamps

team_games (Tabla intermedia)
├─ id (PK)
├─ team_id (FK → teams)
├─ game_id (FK → games)
├─ goals
└─ timestamps
```

## 🌐 Rutas Web

| Ruta | Descripción |
|------|------------|
| `/` | Página de inicio |
| `/equipos` | Listado de equipos |
| `/jugadores` | Listado de jugadores |

## 📁 Estructura del Proyecto

```
football-league/
├── app/
│   ├── Http/
│   │   └── Controllers/      # Controladores CRUD
│   └── Models/               # Modelos de datos
├── database/
│   ├── migrations/           # Migraciones de BD
│   └── seeders/              # Seeders (datos iniciales)
├── resources/
│   ├── views/                # Vistas Blade
│   ├── css/                  # Estilos CSS
│   └── js/                   # Scripts JavaScript
├── routes/
│   ├── api.php               # Rutas de API
│   └── web.php               # Rutas web
└── config/                   # Configuración de la app
```

## 🧪 Testing

Prueba los endpoints con herramientas como:
- **Postman** - https://www.postman.com
- **Insomnia** - https://insomnia.rest
- **Thunder Client** (VS Code)
- **cURL** (línea de comandos)

## 📚 Documentación

Véase [GUIA_PROYECTO.md](./GUIA_PROYECTO.md) para:
- Descripción detallada de modelos
- Relaciones entre entidades
- Ejemplos de uso completos
- Próximos pasos

## ✨ Características Implementadas

- ✅ Validación de datos en todos los endpoints
- ✅ Relaciones eloquent entre modelos
- ✅ Eliminación en cascada (cascade delete)
- ✅ Respuestas JSON estructuradas
- ✅ Código comentado en español
- ✅ Vistas con Bootstrap 5
- ✅ Fetch API para comunicación con backend

## 🔒 Seguridad

- Validación de entrada en todos los formularios
- Relaciones protegidas con claves foráneas
- Eliminación en cascada configurada
- CSRF protection en formularios

## 📝 Licencia

Este proyecto está bajo licencia MIT. Ver el archivo LICENSE para más detalles.

## 👥 Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📞 Soporte

Para reportar problemas o sugerencias, crea un issue en el repositorio.

---

**Desarrollado por:** SENA ADSO 2026  
**Última actualización:** 21 de junio de 2026  
**Versión:** 1.0.0

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
