<?php
include_once 'Conexion.php';
class ClienteModel {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerClientePorId($id) {
        $query = "SELECT * FROM clientes WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado->fetch_assoc();
    }

    public function agregarCliente($nombre, $celular, $celular2){
        $query = "INSERT INTO clientes (nombre,celular,celular2) VALUES ('$nombre', '$celular', '$celular2')";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

    public function eliminarCliente($id) {
        $query = "UPDATE clientes SET habilitado = '0' WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

    public function obtenerClientes() {
        $query = "SELECT * FROM clientes where habilitado = '1'";
        $query_resultado = $this->conexion->query($query);

        $clientes = array();

        while ($fila = $query_resultado->fetch_assoc()) {
            $clientes[] = $fila;
        }

        return $clientes;
    }


    public function actualizarCliente($id, $nombre, $celular, $celular2){
        $query = "UPDATE clientes SET nombre = '$nombre', celular = '$celular', celular2 = '$celular2' WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

}

$modelo_cli = new ClienteModel($conexion);
?>
