<?php

require_once "conexion.php";

class ModulosModelo{

    static public function mdlListarModulos(){

        $stmt = Conexion::conectar()->prepare("SELECT  id, nombre_modulo
                                                FROM modulos m 
                                            order BY nombre_modulo asc");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
}