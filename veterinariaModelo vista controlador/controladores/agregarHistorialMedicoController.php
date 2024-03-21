<?php
include_once '../modelos/historialMedicoModel.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "veterinariaprime";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$historialMedicoModel = new HistorialMedicoModel($conn);
$mascotas = $historialMedicoModel->obtenerMascotas();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idMascota = $_POST["id_mascota"];
    $fechaConsulta = $_POST["fecha_consulta"];
    $descripcion = $_POST["descripcion"];

    $resultado = $historialMedicoModel->agregarHistorialMedico($idMascota, $fechaConsulta, $descripcion);

    if ($resultado) {
        echo "Historial médico agregado con éxito.";
    } else {
        echo "Error al agregar historial médico: " . $conn->error;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_mascota"])) {
    $idMascotaConsulta = $_GET["id_mascota"];
    $historialMascota = $historialMedicoModel->consultarHistorialMascota($idMascotaConsulta);

  
}

// Mueve la siguiente línea al final del script

?>
