<?php

require_once "conexion.php";

class Roles_operacionesModelo{

    static public function mdlListarRoles_operacion(){

        $stmt = Conexion::conectar()->prepare("SELECT  id, id_rol, id_operacion
                                                FROM roles_operaciones r 
                                            order BY id_rol asc");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

/*===================================================================
    REGISTRAR ROLES_OPERACIONES UNO A UNO DESDE EL FORMULARIO DE ROLES_OPERACIONES
    ====================================================================*/
    static public function mdlRegistrarRoles_operaciones($id, $id_rol,$id_operacion){        

        try{

            $fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO roles_operaciones(id, 
                                                                       id_rol,
                                                                       id_operacion
                                                                       ) 
                                                VALUES (:id, 
                                                        :id_rol, 
                                                        :id_operacion
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":id_rol", $id_rol , PDO::PARAM_STR);
            $stmt -> bindParam(":id_operacion", $id_operacion , PDO::PARAM_STR);
        
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