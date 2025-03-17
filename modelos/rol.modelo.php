<?php

require_once "conexion.php";

class RolesModelo{

    static public function mdlListarRoles(){

      
       $stmt = Conexion::conectar()->prepare('call prc_ListarRol');
        $stmt -> execute();

        return $stmt->fetchAll();
    }
/*===================================================================
    OBTENER LISTADO TOTAL DE ROLES PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarrolescb(){
    
        // $stmt = Conexion::conectar()->prepare('call prc_Listarroles');
        $stmt = Conexion::conectar()->prepare('SELECT  id, nombre_rol
        FROM rol r 
    order BY nombre_rol asc');                                        
         $stmt->execute();
     
         return $stmt->fetchAll();
     }
/*===================================================================
    REGISTRAR ROLES UNO A UNO DESDE EL FORMULARIO DE ROLES
    ====================================================================*/
    static public function mdlRegistrarRoles($id, $nombre_rol){        

        try{

            $fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO rol(id, 
                                                                       nombre_rol
                                                                       ) 
                                                VALUES (:id, 
                                                        :nombre_rol
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":nombre_rol", $nombre_rol , PDO::PARAM_STR);
           
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
    static public function mdlActualizarInformacion($table, $data, $id, $nameId){

        $set = "";

        foreach ($data as $key => $value) {
            
            $set .= $key." = :".$key.",";
                
        }

        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId");

        foreach ($data as $key => $value) {
            
            $stmt->bindParam(":".$key, $data[$key], PDO::PARAM_STR);
            
        }		

        $stmt->bindParam(":".$nameId, $id, PDO::PARAM_INT);

        if($stmt->execute()){

            return "ok";

        }else{

            return Conexion::conectar()->errorInfo();
        
        }
    }

    /*=============================================
    Peticion DELETE para eliminar datos
    =============================================*/

    static public function mdlEliminarInformacion($table, $id, $nameId){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE $nameId = :$nameId");

        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";;
        
        }else{

            return Conexion::conectar()->errorInfo();

        }

    }   

    /*===================================================================
    LISTAR NOMBRE DE REPRESENTANTES PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombreRoles(){

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM rol");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

    
}
