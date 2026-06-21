<!DOCTYPE html>
<html lang="es">

<!-- ===== ENCABEZADO (HEAD) ===== -->
<!-- Define metadatos, estilos y configuración del documento -->
<head>
    <!-- Codificación de caracteres -->
    <meta charset="UTF-8">
    
    <!-- Viewport: Responsive design para dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Título de la página (aparece en la pestaña del navegador) -->
    <title>Football League</title>

    <!-- ===== ESTILOS EXTERNOS ===== -->
    
    <!-- Framework Bootstrap 5.3.3 - Estilos responsivos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados del proyecto -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- ===== ESTILOS INTERNOS ===== -->
    <!-- Estilos CSS específicos para este layout -->
    <style>
        /* Fondo gris claro para toda la página */
        body {
            background-color: #f8f9fa;
        }

        /* Barra de navegación: Fondo azul oscuro */
        .navbar-custom {
            background-color: #0d1b2a;
        }

        /* Sección Hero (inicio): Fondo azul marino con texto blanco */
        .hero {
            background-color: #1b263b;
            color: white;
            padding: 80px;
            border-radius: 15px;
        }

        /* Tarjetas personalizadas: Efecto hover de escala */
        .card-custom {
            transition: 0.3s;
        }

        .card-custom:hover {
            transform: scale(1.05);  /* Aumenta tamaño al pasar el mouse */
        }

        /* Footer: Barra inferior oscura */
        footer {
            background-color: #0d1b2a;
            color: white;
            padding: 20px;
            margin-top: 50px;
        }
    </style>

</head>

<!-- ===== CUERPO (BODY) ===== -->
<body>

    <!-- ===== NAVEGACIÓN ===== -->
    <!-- Barra de navegación superior con enlaces principales -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            
            <!-- Logo/Marca de la aplicación -->
            <a class="navbar-brand fw-bold" href="/">
                ⚽ Football League
            </a>

            <!-- Botón toggle para menú en dispositivos móviles -->
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú de navegación -->
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    
                    <!-- Enlace: Inicio -->
                    <li class="nav-item">
                        <a class="nav-link" href="/">Inicio</a>
                    </li>

                    <!-- Enlace: Equipos -->
                    <li class="nav-item">
                        <a class="nav-link" href="/equipos">Equipos</a>
                    </li>

                    <!-- Enlace: Jugadores -->
                    <li class="nav-item">
                        <a class="nav-link" href="/jugadores">Jugadores</a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <!-- Contenedor que carga el contenido específico de cada página -->
    <!-- Las vistas extendidas reemplazan @yield('content') con su propio contenido -->
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- ===== FOOTER ===== -->
    <!-- Pie de página con información del proyecto -->
    <footer class="text-center">
        <h5>Football League</h5>

        <!-- Descripción del sistema -->
        <p>
            Sistema de Gestión de Liga de Fútbol
        </p>

        <!-- Información de la institución y año -->
        <p>
            SENA ADSO 2026
        </p>
    </footer>

    <!-- ===== SCRIPTS EXTERNOS ===== -->
    <!-- JavaScript de Bootstrap: Funcionalidad interactiva (menú responsive, etc) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>