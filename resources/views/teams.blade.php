<!-- Página alternativa para listar equipos -->
<!-- Nota: Esta página no extiende el layout app.blade.php, tiene su propio HTML -->

<!DOCTYPE html>
<html>
<head>
    <!-- Metadatos del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Título de la página -->
    <title>Football League - Equipos</title>

    <!-- ===== ESTILOS EXTERNOS ===== -->
    <!-- Framework Bootstrap 5.3.3 para estilos responsivos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- ===== CONTENIDO PRINCIPAL ===== -->
<div class="container mt-5">

    <!-- Encabezado: Título de la página -->
    <h1 class="text-center mb-4">
        Equipos de Fútbol
    </h1>

    <!-- Tabla: Muestra la lista de todos los equipos -->
    <table class="table table-bordered">
        <!-- Encabezado de tabla -->
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>Estadio</th>
            </tr>
        </thead>

        <!-- Cuerpo de tabla: Se llena dinámicamente con JavaScript -->
        <tbody id="teamsTable">
            <!-- Los equipos se insertan aquí vía JavaScript -->
        </tbody>

    </table>

</div>

<!-- ===== SCRIPT: Obtiene y muestra los datos de la API ===== -->
<script>
    /**
     * Función para cargar y mostrar todos los equipos
     * 
     * 1. Realiza una solicitud GET a /api/teams
     * 2. Convierte la respuesta JSON en un objeto JavaScript
     * 3. Itera sobre cada equipo y lo agrega a la tabla
     */
    
    // Paso 1: Realiza la solicitud a la API
    fetch('/api/teams')
        // Paso 2: Convierte la respuesta a JSON
        .then(response => response.json())
        // Paso 3: Procesa los datos recibidos
        .then(data => {
            // Obtiene la referencia a la tabla
            let table = document.getElementById('teamsTable');

            // Itera sobre cada equipo en el array de datos
            data.forEach(team => {
                // Crea una fila HTML con los datos del equipo
                table.innerHTML += `
                    <tr>
                        <td>${team.name}</td>
                        <td>${team.city}</td>
                        <td>${team.stadium}</td>
                    </tr>
                `;
            });
        });
</script>

</body>
</html>