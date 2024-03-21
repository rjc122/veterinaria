<?php
class HistorialMedicoModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerMascotas() {
        $query = "SELECT id, nombre FROM mascotas";
        $result = $this->conn->query($query);
        return $result;
    }

    public function agregarHistorialMedico($idMascota, $fechaConsulta, $descripcion) {
        $insertQuery = "INSERT INTO historial_medico (id_mascota, fecha_consulta, descripcion) VALUES ('$idMascota', '$fechaConsulta', '$descripcion')";
        return $this->conn->query($insertQuery);
    }

    public function consultarHistorialMascota($idMascota) {
        $query = "SELECT fecha_consulta, descripcion FROM historial_medico WHERE id_mascota = '$idMascota'";
        $result = $this->conn->query($query);
        return $result;
    }
}
?>