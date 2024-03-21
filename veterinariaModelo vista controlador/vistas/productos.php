<?php
include '../controladores/Producto.php';
if (isset($_GET["consultar"])) $productoConsulta = $controlador_pro->obtenerProductoPorId($_GET["consultar"]);
$productos = $controlador_pro->mostrarProductos();
$controlador_pro->agregarProducto();
$controlador_pro->modificarProducto();
$controlador_pro->eliminarProducto();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
            text-align: center;
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
            display: inline-block;
            text-align: left;
        }

        form select, form input, form button {
            width: calc(100% - 22px);
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
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: 
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a.button {
            display: inline-block;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        a.button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <h2>Productos</h2>
        <!-- Formulario para agregar o modificar -->

    <form  method="post">
        <input type="hidden" name="action" value="<?php echo isset($productoConsulta) ? "modificarProducto" : "agregarProducto"; ?>">
        <label for="pro_tipo">Tipo:</label>
        <select name="pro_tipo">
            <option value="Alimento" <?php echo (isset($productoConsulta) && $productoConsulta['tipo'] == 'Alimento') ? 'selected' : ''; ?>>Alimento</option>
            <option value="Aseo" <?php echo (isset($productoConsulta) && $productoConsulta['tipo'] == 'Aseo') ? 'selected' : ''; ?>>Aseo</option>
            <option value="Accesorio" <?php echo (isset($productoConsulta) && $productoConsulta['tipo'] == 'Accesorio') ? 'selected' : ''; ?>>Accesorio</option>
        </select><br>
        <input type="text" placeholder="Nombre" value="<?php echo isset($productoConsulta) ? $productoConsulta["nombre"] : ""; ?>" name="pro_nombre" required>
        <input type="number" placeholder="Costo" value="<?php echo isset($productoConsulta) ? $productoConsulta["costo"] : ""; ?>" name="pro_costo" required>
        <input type="number" placeholder="Unidades" value="<?php echo isset($productoConsulta) ? $productoConsulta["unidades"] : ""; ?>" name="pro_unidades" required>
        <input type="number" placeholder="Precio de Venta" value="<?php echo isset($productoConsulta) ? $productoConsulta["precio_venta"] : ""; ?>" name="pro_precio_venta" required>
        <button type="submit"><?php echo isset($productoConsulta) ? "Modificar Producto" : "Agregar Producto"; ?></button>
    </form>
        <!-- Mostrar la tabla de productos -->

    <table border="1">
        
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Costo</th>
                <th>Unidades</th>
                <th>Precio de Venta</th>
                <th>Acciones</th>
            </tr>
        
        
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo $producto['id'] ?></td>
                    <td><?php echo $producto['tipo'] ?></td>
                    <td><?php echo $producto['nombre'] ?></td>
                    <td><?php echo $producto['costo'] ?></td>
                    <td><?php echo $producto['unidades'] ?></td>
                    <td><?php echo $producto['precio_venta'] ?></td>
                    <td >
                        <a href="?consultar=<?php echo $producto['id']; ?>">Consultar</a>
                        <a href="?eliminar=<?php echo $producto['id']; ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        
    </table>
    <a href="http://localhost/parcial-final">regresar</a>
</body>

</html>