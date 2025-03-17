<?php

require_once "conexion.php";

class NacionalidadesModelo{

    static public function mdlListarNacionalidades(){

        $stmt = Conexion::conectar()->prepare("SELECT  id, gentilicio_nac
                                                FROM tblnacionalidad o 
                                            order BY gentilicio_nac asc");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
}