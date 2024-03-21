<?php
include '../controladores/Cliente.php';
if (isset($_GET["consultar"])) $clienteConsulta = $controlador_cli->obtenerClientePorId($_GET["consultar"]);
$clientes = $controlador_cli->mostrarClientes();
$controlador_cli->agregarCliente();
$controlador_cli->modificarCliente();
$controlador_cli->eliminarCliente();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
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

        form input {
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
            background-color: #4CAF50;
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
    <h2>Clientes</h2>



    <!-- Formulario para agregar o modificar -->
    <form method="post">
        <input type="hidden" name="action" value="<?php echo isset($clienteConsulta) ? "modificarCliente" : "agregarCliente"; ?>">
        <input type="text" placeholder="Nombre" value="<?php echo isset($clienteConsulta) ? $clienteConsulta["nombre"] : ""; ?>" name="cli_nombre" required>
        <input type="text" placeholder="Celular" value="<?php echo isset($clienteConsulta) ? $clienteConsulta["celular"] : ""; ?>" name="cli_celular" required>
        <input type="text" placeholder="Celular 2" value="<?php echo isset($clienteConsulta) ? $clienteConsulta["celular2"] : ""; ?>" name="cli_celular2">
        <button type="submit"><?php echo isset($clienteConsulta) ? "Modificar Cliente" : "Agregar Cliente"; ?></button>
    </form>
    <!-- Mostrar la tabla de clientes -->


    
    <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Celular 2</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['id'] ?></td>
                    <td><?php echo $cliente['nombre'] ?></td>
                    <td><?php echo $cliente['celular'] ?></td>
                    <td><?php echo $cliente['celular2'] ?></td>
                    <td>
                        <a href="?consultar=<?php echo $cliente['id']; ?>">Consultar</a>
                        <a href="?eliminar=<?php echo $cliente['id']; ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>

    <a href="http://localhost/parcial-final">regresar</a>
</body>
</html>