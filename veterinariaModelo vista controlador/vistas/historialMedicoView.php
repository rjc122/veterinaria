<?php
include '../controladores/mascota.php';
include '../controladores/HistorialMedico.php';
// Crea una instancia del controlador de historial médico
$controlador_historial = new HistorialMedicoController();

// Obtén el ID de la mascota desde la URL
$idMascota = $_GET["idMascota"];

// Llama al método obtenerHistorialMedico en el controlador de historial médico
$historialMedico = $controlador_historial->obtenerHistorialMedico($idMascota);

// Resto de tu código para mostrar el historial médico

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Médico</title>
</head>
<body>
    <h2>Historial Médico de la Mascota</h2>

    <?php
    // Obtener el ID de la mascota desde la URL
    $idMascota = $_GET["idMascota"];

    // Obtener el historial médico de la mascota
    $historialMedico = $controlador_mas->obtenerHistorialMedico($idMascota);
    ?>

    <?php if (!empty($historialMedico)): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Fecha de Consulta</th>
                <th>Descripción</th>
            </tr>
            <?php foreach ($historialMedico as $registro): ?>
                <tr>
                    <td><?php echo $registro['id']; ?></td>
                    <td><?php echo $registro['fecha_consulta']; ?></td>
                    <td><?php echo $registro['descripcion']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay historial médico disponible para esta mascota.</p>
    <?php endif; ?>

    <a href="mascotas.php">Volver a la lista de mascotas</a>
</body>
</html>