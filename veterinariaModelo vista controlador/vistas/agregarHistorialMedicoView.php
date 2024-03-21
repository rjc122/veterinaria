<?php
include '../controladores/agregarHistorialMedicoController.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar y Consultar Historial Médico</title>
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

        form label {
            display: block;
            margin-bottom: 10px;
        }

        form select, form input, form textarea, form button {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        form button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #2980b9;
        }

        hr {
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        h3 {
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
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
        #hm{
            border: black solid 1px;
            color: black;
            transition: 0.5s;
            border-radius: 10px;
        }
        #hm:hover{
            background-color: #4CAF50;
            border: none;
            color: #fff;
        }
    </style>
</head>
<body>
<a href="http://localhost/parcial-final">Regresar</a>
<h2>Agregar y Consultar Historial Médico</h2>

<!-- Formulario para agregar historial médico -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="id_mascota">Selecciona una mascota:</label>
    <select name="id_mascota">
        <?php
        while ($row = $mascotas->fetch_assoc()) {
            echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
        }
        ?>
    </select><br><br>

    <label for="fecha_consulta">Fecha de consulta:</label>
    <input type="date" name="fecha_consulta" required><br><br>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" rows="4" cols="50" required></textarea><br><br>

    <input type="submit" value="Agregar Historial Médico" id="hm">
</form>

<hr> <!-- Línea separadora -->

<?php
// Muestra el historial médico consultado si existe
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_mascota"])) {
    $idMascotaConsulta = $_GET["id_mascota"];
    $historialMascota = $historialMedicoModel->consultarHistorialMascota($idMascotaConsulta);

    if ($historialMascota->num_rows > 0) {
        echo "<h3>Historial Médico de la Mascota</h3>";
        echo "<ul>";
        while ($row = $historialMascota->fetch_assoc()) {
            echo "<li>Fecha de Consulta: " . $row["fecha_consulta"] . ", Descripción: " . $row["descripcion"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>La mascota no tiene historial médico registrado.</p>";
    }
}
?>

<!-- Formulario para consultar historial médico -->
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="id_mascota_consulta">Selecciona una mascota:</label>
    <select name="id_mascota">
        <?php
        // Muestra las opciones de mascotas nuevamente para la consulta
        $mascotas->data_seek(0);
        while ($row = $mascotas->fetch_assoc()) {
            echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
        }
        ?>
    </select>
    <input type="submit" value="Consultar Historial Médico">
</form>



</body>
</html>