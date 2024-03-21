<?php
include_once '../modelos/Servicio.php';

class ServicioController {
    private $modelo;

    public function __construct() {
        global $ser_modelo;
        $this->modelo = $ser_modelo;
    }

    public function agregarServicio(){
        if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === "agregarServicio"){
            $ser_nombre = $_POST["ser_nombre"];
            header("Location: servicios.php");
            $this->modelo->agregarServicio($ser_nombre);
        }
    }

    public function modificarServicio(){
        if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === "modificarServicio"){
            $id = $_GET["consultar"];
            $ser_nombre = $_POST["ser_nombre"];
            $this->modelo->actualizarServicio($id, $ser_nombre);
            header("Location: servicios.php");
        }
    }

    public function eliminarServicio(){
        if(isset($_GET["eliminar"])){
            $id = $_GET["eliminar"];
            $this->modelo->eliminarServicio($id);
            header("Location: servicios.php");
        }
    }

    public function mostrarServicios(){
        return $this->modelo->obtenerServicios();
    }

    public function obtenerServicioPorId($id) {
        return $this->modelo->obtenerServicioPorId($id);
    }
}

$controlador_ser = new ServicioController();
?>