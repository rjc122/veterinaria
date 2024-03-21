<?php

class Conexion {
    private $host;
    private $usuario;
    private $contrasena;
    private $nombreDB;
    private $conexion;

    public function __construct($host, $usuario, $contrasena, $nombreDB) {
        $this->host = $host;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
        $this->nombreDB = $nombreDB;
    }

    public function query($sql) {
        return $this->conexion->query($sql);
    }

    public function conectar() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->nombreDB);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
        return true;
    }

    public function desconectar() {
        if ($this->conexion) {
            $this->conexion->close();
            return true;
        }
    }
}

$conexion = new Conexion("localhost", "root", "", "veterinariaprime");
$conexion->conectar();
?>