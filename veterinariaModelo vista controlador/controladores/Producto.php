<?php
include_once '../modelos/Producto.php';

class ProductoController {
    private $modelo;

    public function __construct() {
        global $pro_modelo;
        $this->modelo = $pro_modelo;
    }

    public function agregarProducto(){
        if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === "agregarProducto"){
            $pro_tipo = $_POST["pro_tipo"];
            $pro_nombre = $_POST["pro_nombre"];
            $pro_costo = $_POST["pro_costo"];
            $pro_unidades = $_POST["pro_unidades"];
            $pro_precio_venta = $_POST["pro_precio_venta"];
            header("Location: productos.php");
            $this->modelo->agregarProducto($pro_tipo, $pro_nombre, $pro_costo, $pro_unidades, $pro_precio_venta);
        }
    }

    public function modificarProducto(){
        if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === "modificarProducto"){
            $id = $_GET["consultar"];
            $pro_tipo = $_POST["pro_tipo"];
            $pro_nombre = $_POST["pro_nombre"];
            $pro_costo = $_POST["pro_costo"];
            $pro_unidades = $_POST["pro_unidades"];
            $pro_precio_venta = $_POST["pro_precio_venta"];
            $this->modelo->actualizarProducto($id, $pro_tipo, $pro_nombre, $pro_costo, $pro_unidades, $pro_precio_venta);
            header("Location: productos.php");
        }
    }

    public function eliminarProducto(){
        if(isset($_GET["eliminar"])){
            $id = $_GET["eliminar"];
            $this->modelo->eliminarProducto($id);
            header("Location: productos.php");
        }
    }

    public function mostrarProductos(){
        return $this->modelo->obtenerProductos();
    }

    public function obtenerProductoPorId($id) {
        return $this->modelo->obtenerProductoPorId($id);
    }
}

$controlador_pro = new ProductoController();
?>