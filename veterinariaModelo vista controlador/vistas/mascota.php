?>                                                                                                                                                                                                                       vistas/mascotas.php  <?php
include '../controladores/Mascota.php';
include '../controladores/Cliente.php';
if (isset($_GET["consultar"])) $mascotaConsulta = $controlador_mas->obtenerMascotaPorId($_GET["consultar"]);
$mascotas = $controlador_mas->mostrarMascotas();
$controlador_mas->agregarMascota();
$controlador_mas->modificarMascota();
$controlador_mas->eliminarMascota();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mascotas</title>  
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
    <h2>Mascotas</h2>

    <!-- Formulario para agregar o modificar -->
    <form  method="post">
        <input type="hidden" name="action" value="<?php echo isset($mascotaConsulta) ? "modificarMascota" : "agregarMascota"; ?>">
        <label for="mas_nombre">Nombre:</label>
        <input type="text" placeholder="Nombre" value="<?php echo isset($mascotaConsulta) ? $mascotaConsulta["nombre"] : ""; ?>" name="mas_nombre" required> <br>
        <label for="mas_tipo">Tipo:</label>
        <select name="mas_tipo">
            <option value="Perro" <?php echo (isset($mascotaConsulta) && $mascotaConsulta['tipo'] == 'Perro') ? 'selected' : ''; ?>>Perro</option>
            <option value="Gato" <?php echo (isset($mascotaConsulta) && $mascotaConsulta['tipo'] == 'Gato') ? 'selected' : ''; ?>>Gato</option>
            <option value="Hamster" <?php echo (isset($mascotaConsulta) && $mascotaConsulta['tipo'] == 'Hamster') ? 'selected' : ''; ?>>Hamster</option>
            <option value="Conejo" <?php echo (isset($mascotaConsulta) && $mascotaConsulta['tipo'] == 'Conejo') ? 'selected' : ''; ?>>Conejo</option>
            <option value="Loro" <?php echo (isset($mascotaConsulta) && $mascotaConsulta['tipo'] == 'Loro') ? 'selected' : ''; ?>>Loro</option>
            <option value="Pez" <?php echo (isset($mascotaConsulta) && $mascotaConsulta['tipo'] == 'Pez') ? 'selected' : ''; ?>>Pez</option>
        </select><br>
        <label for="mas_raza">Raza:</label>
        <input type="text" placeholder="Raza" value="<?php echo isset($mascotaConsulta) ? $mascotaConsulta["raza"] : ""; ?>" name="mas_raza" required> <br>
        <label for="mas_peso">Peso:</label>
        <input type="number" placeholder="Peso" value="<?php echo isset($mascotaConsulta) ? $mascotaConsulta["peso"] : ""; ?>" name="mas_peso" required> <br>
        <label for="mas_sexo">Sexo:</label>

        <select name="mas_sexo">
            <option value="m" <?php echo (isset($mascotaConsulta) && $mascotaConsulta['sexo'] == 'm') ? 'selected' : ''; ?>>Macho</option>
            <option value="h" <?php echo (isset($mascotaConsulta) && $mascotaConsulta['sexo'] == 'h') ? 'selected' : ''; ?>>Hembra</option>
        </select> <br>
        <label for="mas_tamano">Tamaño:</label>

        <input type="number" placeholder="Tamaño" value="<?php echo isset($mascotaConsulta) ? $mascotaConsulta["tamano"] : ""; ?>" name="mas_tamano" required> <br>
        <label for="mas_des_social">Descripción social:</label>

        <input type="text" placeholder="Descripción social" value="<?php echo isset($mascotaConsulta) ? $mascotaConsulta["descripcion_social"] : ""; ?>" name="mas_descripcion_social" required> <br>
        <label for="mas_edad">Edad:</label>

        <input type="number" placeholder="Edad" value="<?php echo isset($mascotaConsulta) ? $mascotaConsulta["edad"] : ""; ?>" name="mas_edad" required> <br>
        <label for="mas_dueno">Dueño:</label>
        <select name="mas_dueno">
            <?php
            $clientes = $controlador_cli->mostrarClientes();
            foreach ($clientes as $cliente) {
                echo "<option value=\"{$cliente['id']}\"";
                if (isset($mascotaConsulta) && $mascotaConsulta['dueno_id'] == $cliente['id']) {
                    echo ' selected';
                }
                echo ">{$cliente['nombre']}</option>";
            }
            ?>
        </select> <br>
        <button type="submit"><?php echo isset($mascotaConsulta) ? "Modificar Mascota" : "Agregar Mascota"; ?></button>
    </form>

    <!-- Mostrar la tabla de mascotas -->
    <table border="1">
        
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Raza</th>
                <th>Peso</th>
                <th>Sexo</th>
                <th>Tamaño</th>
                <th>Descripción social</th>
                <th>Edad</th>
                <th>Dueño</th>
                <th>Acciones</th>
            </tr>
        
        
            <?php foreach ($mascotas as $mascota): ?>
                <tr>
                    <td><?php echo $mascota['id'] ?></td>
                    <td><?php echo $mascota['nombre'] ?></td>
                    <td><?php echo $mascota['tipo'] ?></td>
                    <td><?php echo $mascota['raza'] ?></td>
                    <td><?php echo $mascota['peso'] ?></td>
                    <td><?php echo $mascota['sexo'] ?></td>
                    <td><?php echo $mascota['tamano'] ?></td>
                    <td><?php echo $mascota['descripcion_social'] ?></td>
                    <td><?php echo $mascota['edad'] ?></td>
                    <td><?php echo $mascota['dueno'] ?></td>
                    <td >
                        <a href="?consultar=<?php echo $mascota['id']; ?>">Consultar</a>
                        <a href="?eliminar=<?php echo $mascota['id']; ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                        <a href="historialMedico.php?idMascota=<?php echo $mascota['id']; ?>">Consultar Historial</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        
    </table>
    <a href="http://localhost/parcial-final">regresar</a>
</body>
