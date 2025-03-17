<?php

require_once "conexion.php";

class OperacionesModelo{

    static public function mdlListarOperaciones(){

        $stmt = Conexion::conectar()->prepare("SELECT  id, nombre
                                                FROM operaciones o 
                                            order BY nombre asc");

        $stmt -> execute();

        return $stmt->fetchAll();
    }


    /*===================================================================
    REGISTRAR OPERACIONES UNO A UNO DESDE EL FORMULARIO DE OPERACIONES
    ====================================================================*/
    static public function mdlRegistrarOperaciones($id, $nombre_ocupacion){        

        try{

            $fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO operaciones(id, 
                                                                       nombre
                                                                       ) 
                                                VALUES (:id, 
                                                        :nombre
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":nombre", $nombre , PDO::PARAM_STR);
        
            if($stmt -> execute()){
                $resultado = "ok";
            }else{
                $resultado = "error";
            }  
        }catch (Exception $e) {
            $resultado = 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
        
        return $resultado;

        $stmt = null;

    }
}