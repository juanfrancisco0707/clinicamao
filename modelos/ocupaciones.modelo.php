<?php

require_once "conexion.php";

class OcupacionesModelo{

    
    /*===================================================================
    OBTENER LISTADO TOTAL DE OCUPACIONES PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarOcupacionesCb(){
        $stmt = Conexion::conectar()->prepare("SELECT  id, nombre_ocupacion
                                                FROM tblocupaciones
                                            order BY nombre_ocupacion asc");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
    
    static public function mdlListarOcupaciones(){
        $stmt = Conexion::conectar()->prepare('call prc_ListarOcupaciones');
        $stmt -> execute();

        return $stmt->fetchAll();

    }
    /*===================================================================
    REGISTRAR OCUPACIONES UNO A UNO DESDE EL FORMULARIO DE Ocupaciones
    ====================================================================*/
    static public function mdlRegistrarOcupacion($id, $nombre_ocupacion){        

        try{

            //$fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblOcupaciones(id, nombre_ocupacion
                                    
                                                                       ) 
                                                VALUES (:id, 
                                                        :nombre_ocupacion
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":nombre_ocupacion", $nombre_ocupacion, PDO::PARAM_STR);

        
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
    LISTAR NOMBRE DE Ocupaciones PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombreOcupacioness(){

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM tblOcupaciones");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
}