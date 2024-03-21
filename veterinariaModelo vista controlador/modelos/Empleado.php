<?php
include_once 'Conexion.php';
class EmpleadoModel {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerEmpleadoPorId($id) {
        $query = "SELECT * FROM empleados WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado->fetch_assoc();
    }

    public function agregarEmpleado($nombre, $celular, $correo){
        $query = "INSERT INTO empleados (nombre,celular,correo) VALUES ('$nombre', '$celular', '$correo')";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

    public function obtenerEmpleados() {
        $query = "SELECT * FROM empleados where habilitado = '1'";
        $query_resultado = $this->conexion->query($query);

        $empleados = array();

        while ($fila = $query_resultado->fetch_assoc()) {
            $empleados[] = $fila;
        }

        return $empleados;
    }
    
    public function eliminarEmpleado($id) {
        $query = "UPDATE empleados SET habilitado = '0' WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }


    public function actualizarEmpleado($id, $nombre, $celular, $correo){
        $query = "UPDATE empleados SET nombre = '$nombre', celular = '$celular', correo = '$correo' WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }


}

$emp_modelo = new EmpleadoModel($conexion);
?>
