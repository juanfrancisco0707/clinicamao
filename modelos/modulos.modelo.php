<?php

require_once "conexion.php";

class ModulosModelo{

    
    /*===================================================================
    OBTENER LISTADO TOTAL DE Modulos PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarModulos(){
        $stmt = Conexion::conectar()->prepare("SELECT  id, nombre_modulo
                                                FROM modulos
                                            order BY nombre_modulo asc");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
    
    /*===================================================================
    REGISTRAR Modulos UNO A UNO DESDE EL FORMULARIO DE Modulos
    ====================================================================*/
    static public function mdlRegistrarModulo($id, $nombre_modulo){        

        try{

            //$fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO modulos(id, nombre_modulo) 
                                                VALUES (:id, :nombre_modulo)");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_INT);
            $stmt -> bindParam(":nombre_modulo", $nombre_modulo, PDO::PARAM_STR);

        
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
    LISTAR NOMBRE DE Modulos PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombreModulos(){

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM modulos");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
}
