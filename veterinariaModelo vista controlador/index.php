<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menú de Navegación</title>
        
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <nav>
            <a href="">Inicio</a>
            <a href="vistas/clientes.php">Clientes</a>
            <a href="vistas/mascotas.php">Mascotas</a>
            <a href="vistas/servicios.php">Servicios</a>
            <a href="vistas/empleados.php">Empleados</a>
            <a href="vistas/productos.php">Productos</a>
            <a href="vistas/agregarHistorialMedicoView.php">historial medico</a>
            <a href="vistas/factura.php">facturas</a>
        </nav>

        <div style="padding: 20px;">
            <?php
            // Determina qué sección cargar según la solicitud
            if (isset($_GET['seccion'])) {
                $seccion = $_GET['seccion'];
                include "$seccion.php";
            } else {
                echo '<h2> aplicación de gestión datos de la veterinaria</h2>';
                echo '<p>Selecciona una opción del menú para comenzar.</p>';
            }
            ?>
        </div>
    </body>
</html>
