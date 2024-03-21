<?php
include_once '../modelos/Empleado.php';

class EmpleadoController {
    private $modelo;

    public function __construct() {
        global $emp_modelo;
        $this->modelo = $emp_modelo;
    }

    public function agregarEmpleado(){
        if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === "agregarEmpleado"){
            $emp_nombre = $_POST["emp_nombre"];
            $emp_celular = $_POST["emp_celular"];
            $emp_correo = $_POST["emp_correo"];
            header("Location: empleados.php");
            $this->modelo->agregarEmpleado($emp_nombre, $emp_celular, $emp_correo);
        }
    }

    public function modificarEmpleado(){
        if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === "modificarEmpleado"){
            $id = $_GET["consultar"];
            $emp_nombre = $_POST["emp_nombre"];
            $emp_celular = $_POST["emp_celular"];
            $emp_correo = $_POST["emp_correo"];
            $this->modelo->actualizarEmpleado($id, $emp_nombre, $emp_celular, $emp_correo);
            header("Location: empleados.php");
        }
    }

    public function eliminarEmpleado(){
        if(isset($_GET["eliminar"])){
            $id = $_GET["eliminar"];
            $this->modelo->eliminarEmpleado($id);
            header("Location: empleados.php");
        }
    }

    public function mostrarEmpleados(){
        return $this->modelo->obtenerEmpleados();
    }

    public function obtenerEmpleadoPorId($id) {
        return $this->modelo->obtenerEmpleadoPorId($id);
    }
}

$controlador_emp = new EmpleadoController();
?>