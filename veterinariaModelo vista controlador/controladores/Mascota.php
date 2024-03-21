<?php
include_once '../modelos/Mascota.php';

class MascotaController {
    private $modelo;

    public function __construct() {
        global $mas_modelo;
        $this->modelo = $mas_modelo;
    }

    public function agregarMascota(){
        if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === "agregarMascota"){
            $mas_nombre = $_POST["mas_nombre"];
            $mas_tipo = $_POST["mas_tipo"];
            $mas_raza = $_POST["mas_raza"];
            $mas_sexo = $_POST["mas_sexo"];
            $mas_peso = $_POST["mas_peso"];
            $mas_tamano = $_POST["mas_tamano"];
            $mas_descripcion_social = $_POST["mas_descripcion_social"];
            $mas_edad = $_POST["mas_edad"];
            $mas_dueno = $_POST["mas_dueno"];
            header("Location: mascotas.php");
            $this->modelo->agregarMascota($mas_nombre, $mas_tipo, $mas_raza, $mas_sexo, $mas_peso, $mas_tamano, $mas_descripcion_social, $mas_edad, $mas_dueno);
        }
    }

    public function modificarMascota(){
        if($_SERVER["REQUEST_METHOD"] === "POST" && $_POST["action"] === "modificarMascota"){
            $id = $_GET["consultar"];
            $mas_nombre = $_POST["mas_nombre"];
            $mas_tipo = $_POST["mas_tipo"];
            $mas_raza = $_POST["mas_raza"];
            $mas_sexo = $_POST["mas_sexo"];
            $mas_peso = $_POST["mas_peso"];
            $mas_tamano = $_POST["mas_tamano"];
            $mas_descripcion_social = $_POST["mas_descripcion_social"];
            $mas_edad = $_POST["mas_edad"];
            $mas_dueno = $_POST["mas_dueno"];
            $this->modelo->actualizarMascota($id, $mas_nombre, $mas_tipo, $mas_raza, $mas_sexo, $mas_peso, $mas_tamano, $mas_descripcion_social, $mas_edad, $mas_dueno);
            header("Location: mascotas.php");
        }
    }

    public function eliminarMascota(){
        if(isset($_GET["eliminar"])){
            $id = $_GET["eliminar"];
            $this->modelo->eliminarMascota($id);
            header("Location: mascotas.php");
        }
    }

    public function mostrarMascotas(){
        return $this->modelo->obtenerMascotas();
    }

    public function obtenerMascotaPorId($id) {
        return $this->modelo->obtenerMascotaPorId($id);
    }




    
}



$controlador_mas = new MascotaController();
?>