<?php
include_once 'Conexion.php';
class ServicioModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerServicios() {
        $query = "SELECT * FROM servicios where habilitado = '1'";
        $query_resultado = $this->conexion->query($query);

        $servicios = array();

        while ($fila = $query_resultado->fetch_assoc()) {
            $servicios[] = $fila;
        }

        return $servicios;
    }

    public function agregarServicio($nombre){
        $query = "INSERT INTO servicios (nombre) VALUES ('$nombre')";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

    public function obtenerServicioPorId($id) {
        $query = "SELECT * FROM servicios WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado->fetch_assoc();
    }

    public function eliminarServicio($id) {
        $query = "UPDATE servicios SET habilitado = '0' WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

    public function actualizarServicio($id, $nombre){
        $query = "UPDATE servicios SET nombre = '$nombre', id = '$id' WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

}

$ser_modelo = new ServicioModel($conexion);
?>
