<?php
include_once 'Conexion.php';
include_once 'Cliente.php';
class MascotaModel {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }


    public function obtenerMascotas() {
        global $modelo_cli;
        $query = "SELECT * FROM mascotas where habilitado = '1'";
        $query_resultado = $this->conexion->query($query);

        $mascotas = array();

        while ($fila = $query_resultado->fetch_assoc()) {
            $dueno_id = $fila["dueno_id"];
            $dueno = $modelo_cli->obtenerClientePorId($dueno_id);
            $fila["dueno"] = $dueno["nombre"];

            $mascotas[] = $fila;
        }

        return $mascotas;
    }
    

    public function agregarMascota($nombre, $tipo, $raza, $sexo, $peso, $tamano, $descripcion_social, $edad, $dueno){
        $query = "INSERT INTO mascotas (nombre, tipo, raza, sexo, peso, tamano, descripcion_social, edad, dueno_id) VALUES ('$nombre', '$tipo', '$raza', '$sexo', '$peso', '$tamano', '$descripcion_social', '$edad', '$dueno')";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

    public function obtenerMascotaPorId($id) {
        $query = "SELECT * FROM mascotas WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado->fetch_assoc();
    }

    public function eliminarMascota($id) {
        $query = "UPDATE mascotas SET habilitado = '0' WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

    public function actualizarMascota($id, $nombre, $tipo, $raza, $sexo, $peso, $tamano, $descripcion_social, $edad, $dueno){
        $query = "UPDATE mascotas SET nombre = '$nombre', tipo = '$tipo', raza = '$raza', sexo = '$sexo', peso = '$peso', tamano = '$tamano', descripcion_social = '$descripcion_social', edad = '$edad', dueno_id = '$dueno' WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

    public function obtenerHistorialMedico($idMascota) {
        // Supongamos que hay una relación entre mascotas e historial_medico mediante la columna "id_mascota"
        $query = "SELECT * FROM historial_medico WHERE id_mascota = $idMascota";
        $result = $this->conn->query($query);

        $historialMedico = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $historialMedico[] = $row;
            }
        }

        return $historialMedico;
    }


}

$mas_modelo = new MascotaModel($conexion);
?>
