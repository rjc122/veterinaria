<?php
include '../controladores/Servicio.php';
if(isset($_GET["consultar"])) $servicioConsulta = $controlador_ser->obtenerServicioPorId($_GET["consultar"]);
$servicios = $controlador_ser->mostrarServicios();
$controlador_ser->agregarServicio();
$controlador_ser->modificarServicio();
$controlador_ser->eliminarServicio();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        form button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #4CAF50
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            color: #3498db;
        }

        a:hover {
            background-color: #f5f5f5;
        }

        /* Estilo para el enlace de regresar */
        a.regresar {
            display: block;
            margin-top: 20px;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        a.regresar:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h2>Servicios</h2>
            <!-- Formulario para agregar o modificar -->
    <form  method="post">
        <input type="hidden" name="action" value="<?php echo isset($servicioConsulta) ? "modificarServicio" : "agregarServicio"; ?>">  
        <input type="text" placeholder="Nombre del Servicio" value="<?php echo isset($servicioConsulta) ? $servicioConsulta["nombre"] : ""; ?>" name="ser_nombre" required>      
        <button type="submit"><?php echo isset($servicioConsulta) ? "Modificar Servicio" : "Agregar Servicio"; ?></button>
    </form>
            <!-- Mostrar la tabla de servicios -->
    <table border="1">
        
            <tr>
                <th>ID</th>
                <th>Nombre del Servicio</th>
                <th>Acciones</th>
            </tr>
        
        
            <?php foreach ($servicios as $servicio): ?>
                <tr>
                    <td><?php echo $servicio['id'] ?></td>
                    <td><?php echo $servicio['nombre'] ?></td>
                    <td >
                        <a href="?consultar=<?php echo $servicio['id']; ?>">Consultar</a>
                        <a href="?eliminar=<?php echo $servicio['id']; ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        
    </table>
    <a href="http://localhost/parcial-final">regresar</a>
</body>
</html>