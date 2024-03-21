<?php
include_once 'Conexion.php';
class ProductoModel {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerProductos() {
        $query = "SELECT * FROM productos where habilitado = '1'";
        $query_resultado = $this->conexion->query($query);

        $productos = array();

        while ($fila = $query_resultado->fetch_assoc()) {
            $productos[] = $fila;
        }

        return $productos;
    }

    public function agregarProducto($tipo, $nombre, $costo, $unidades, $precio_venta){
        $query = "INSERT INTO productos (tipo,nombre,costo, unidades, precio_venta) VALUES ('$tipo', '$nombre', '$costo', '$unidades', '$precio_venta')";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

    public function obtenerProductoPorId($id) {
        $query = "SELECT * FROM productos WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado->fetch_assoc();
    }

    public function eliminarProducto($id) {
        $query = "UPDATE productos SET habilitado = '0' WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }

    public function actualizarProducto($id, $tipo, $nombre, $costo, $unidades, $precio_venta){
        $query = "UPDATE productos SET tipo = '$tipo', nombre = '$nombre', costo = '$costo', unidades = '$unidades', precio_venta = '$precio_venta' WHERE id = '$id'";
        $query_resultado = $this->conexion->query($query);
        return $query_resultado;
    }


}

$pro_modelo = new ProductoModel($conexion);
?>
