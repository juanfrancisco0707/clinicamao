<?php

require_once "conexion.php";

class GastosModelo{

    static public function mdlListarGastos(){

        $stmt = Conexion::conectar()->prepare("SELECT  id, id_usuario, fecha, id_proveedor, estatus
                                                FROM tblgastos g 
                                            order BY id_usuario asc");

        $stmt -> execute();

        return $stmt->fetchAll();
    }


    /*===================================================================
    REGISTRAR GASTOS UNO A UNO DESDE EL FORMULARIO DE GASTOS
    ====================================================================*/
    static public function mdlRegistrarGastos($id, $id_usuario,$fecha,$id_proveedor,
                                                $estatus){        

        try{

            $fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblgastos(id, 
                                                                       id_usuario,
                                                                       fecha,
                                                                       id_proveedor,
                                                                       estatus
                                                                       ) 
                                                VALUES (:id, 
                                                        :id_usuario, 
                                                        :fecha, 
                                                        :id_proveedor, 
                                                        :estatus
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":id_usuario", $id_usuario , PDO::PARAM_STR);
            $stmt -> bindParam(":fecha", $fecha , PDO::PARAM_STR);
            $stmt -> bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_STR);
            $stmt -> bindParam(":estatus", $estatus , PDO::PARAM_STR);
           
            if($stmt -> execute()){
                $resultado = "ok";
            }else{
                $resultado = "error";
            }  
        }catch (Exception $e) {
            $resultado = 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    }    
}