<?php
include_once '../modelos/Cliente.php';

class ClienteController {
    private $modelo;

    public function __construct() {
        global $modelo_cli;
        $this->modelo = $modelo_cli;
    }

    public function agregarCliente(){
        if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === "agregarCliente"){
            $cli_nombre = $_POST["cli_nombre"];
            $cli_celular = $_POST["cli_celular"];
            $cli_celular2 = $_POST["cli_celular2"];
            header("Location: clientes.php");
            $this->modelo->agregarCliente($cli_nombre, $cli_celular, $cli_celular2);
        }
    }

    public function modificarCliente(){
        if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === "modificarCliente"){
            $id = $_GET["consultar"];
            $cli_nombre = $_POST["cli_nombre"];
            $cli_celular = $_POST["cli_celular"];
            $cli_celular2 = $_POST["cli_celular2"];
            $this->modelo->actualizarCliente($id, $cli_nombre, $cli_celular, $cli_celular2);
            header("Location: clientes.php");
        }
    }

    public function eliminarCliente(){
        if(isset($_GET["eliminar"])){
            $id = $_GET["eliminar"];
            $this->modelo->eliminarCliente($id);
            header("Location: clientes.php");
        }
    }

    public function mostrarClientes(){
        return $this->modelo->obtenerClientes();
    }

    public function obtenerClientePorId($id) {
        return $this->modelo->obtenerClientePorId($id);
    }
}

$controlador_cli = new ClienteController();
?>