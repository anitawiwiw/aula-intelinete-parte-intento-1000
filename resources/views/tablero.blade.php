<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard </title>
    <style>
        /* Reset y estilos base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        body {
            color: #e0e0e0;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Estructura del dashboard */
        .dashboard {
            display: grid;
            grid-template-columns: 240px 1fr;
            grid-template-rows: 70px 1fr;
            min-height: 100vh;
        }
        
        /* Barra superior */
        .top-bar {
            grid-column: 1 / 3;
            background-color: rgba(50, 45, 60, 0.85);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 25px;
            border-bottom: 1px solid #282828;
            z-index: 10;
            position: sticky;
            top: 0;
        }
        
        .logo {
            height: 50px;
            object-fit: contain;
        }
        
        .nav-buttons {
            display: flex;
            gap: 20px;
        }
        
        .nav-button {
            background: none;
            border: none;
            color: #b3b3b3;
            font-size: 14px;
            cursor: pointer;
            transition: color 0.2s;
            font-family: inherit;
        }
        
        .nav-button:hover {
            color: #cacacaff;
        }
        
        /* Panel lateral */
        .side-panel {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 25px;
            border-right: 1px solid #28282838;
            position: sticky;
            top: 70px;
            height: calc(100vh - 70px);
            overflow-y: auto;
            backdrop-filter: blur(5px);
        }
        
        .panel-item {
            color: #bbb3c9ff;
            padding: 12px 0;
            cursor: pointer;
            transition: color 0.2s;
            font-size: 15px;
            display: block;
            text-decoration: none;
        }
        
        .panel-item:hover {
            color: #ffffff;
        }
        
        /* Contenido principal */
        .main-content {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url("/images/boliviainteligente-QPu42AAJ5ZY-unsplash.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 30px;
            overflow-y: auto;
            min-height: calc(100vh - 70px);
        }
        
        .welcome-message {
            color: #ffffff;
            margin: 20px 0 60px 25px;
            font-size: 28px;
            font-weight: 500;
        }
        
        /* Tarjetas */
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 25px;
            padding: 0 25px;
            margin-top: 30px;
        }
        
        .card {
            background: rgba(40, 40, 40, 0.6);
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            aspect-ratio: 1/1.3;
            text-decoration: none;
            display: block;
        }
        
        .card:hover {
            background: rgba(60, 60, 60, 0.8);
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        
        .card-image {
            width: 100%;
            height: 70%;
            object-fit: cover;
        }
        
        .card-title {
            padding: 18px;
            color: #ffffff;
            font-size: 17px;
            font-weight: bold;
        }
        
        .card-subtitle {
            padding: 0 18px 18px;
            color: #b3b3b3;
            font-size: 14px;
        }
        
        /* Icono de análisis */
        .analytics-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            vertical-align: middle;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
                grid-template-rows: 70px auto 1fr;
            }
            
            .top-bar {
                grid-column: 1;
            }
            
            .side-panel {
                grid-row: 2;
                height: auto;
                position: static;
                display: flex;
                justify-content: center;
                border-right: none;
                border-bottom: 1px solid #282828;
            }
            
            .main-content {
                grid-row: 3;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Barra superior -->
        <header class="top-bar">
            <img src="https://esim.edu.ar/web/wp-content/uploads/2021/08/innovacion.png" alt="Logo" class="logo">
            <div class="nav-buttons">
                <button class="nav-button">Cerrar Sesión</button>
                <button class="nav-button">Tablero</button>
            </div>
        </header>
        
        <!-- Panel lateral -->
        <aside class="side-panel">
            <a href="#" class="panel-item">
                <img src="/images/analisis.png" alt="Analisis" class="analytics-icon">
                Crear Reserva
            </a>
            <!-- Más elementos de navegación pueden ir aquí -->
        </aside>
        
        <!-- Contenido principal -->
        <main class="main-content">
            <h1 class="welcome-message">Bienvenido, <?php echo Auth::user()->name; ?></h1>
            
            <div class="cards-container">
                <!-- Tarjeta 1: Reservas -->
                <a href="#" class="card">
                    <img src="/images/reservas-card.jpg" alt="Reservas" class="card-image">
                    <div class="card-title">Mis Reservas</div>
                    <div class="card-subtitle">Ver todas tus reservas</div>
                </a>
                
                <!-- Tarjeta 2: Materias -->
                <a href="#" class="card">
                    <img src="/images/materias-card.jpg" alt="Materias" class="card-image">
                    <div class="card-title">Materias</div>
                    <div class="card-subtitle">Explora las materias</div>
                </a>
                
                <!-- Tarjeta 3: Horarios -->
                <a href="#" class="card">
                    <img src="/images/horarios-card.jpg" alt="Horarios" class="card-image">
                    <div class="card-title">Horarios</div>
                    <div class="card-subtitle">Consulta los horarios</div>
                </a>
            </div>
        </main>
    </div>

    <script>
        // Funcionalidad básica
        document.addEventListener('DOMContentLoaded', function() {
            // Ejemplo: Manejar clic en "Cerrar Sesión"
            document.querySelectorAll('.nav-button')[0].addEventListener('click', function() {
                if(confirm('¿Estás seguro de que quieres cerrar sesión?')) {
                    // Aquí iría la lógica para cerrar sesión
                    window.location.href = '/logout';
                }
            });
            
            // Ejemplo: Manejar clic en "Crear Reserva"
            document.querySelector('.panel-item').addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = '/reservas/crear';
            });
            
            // Ejemplo: Hacer que las tarjetas sean clickeables
            document.querySelectorAll('.card').forEach(card => {
                card.addEventListener('click', function(e) {
                    e.preventDefault();
                    const title = this.querySelector('.card-title').textContent;
                    // Redirigir según la tarjeta
                    if(title.includes('Reservas')) {
                        window.location.href = '/reservas';
                    } else if(title.includes('Materias')) {
                        window.location.href = '/materias';
                    } else if(title.includes('Horarios')) {
                        window.location.href = '/horarios';
                    }
                });
            });
        });
    </script>
</body></html>