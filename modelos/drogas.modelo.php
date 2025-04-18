<?php

require_once "conexion.php";

class DrogasModelo{

    
    /*===================================================================
    OBTENER LISTADO TOTAL DE Drogas PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarDrogasCb(){
        $stmt = Conexion::conectar()->prepare("SELECT  id_droga, nombre_droga
                                                FROM tblDrogas
                                            order BY nombre_droga asc");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
    
    static public function mdlListarDrogas(){
        $stmt = Conexion::conectar()->prepare('call prc_ListarDrogas');
        $stmt -> execute();

        return $stmt->fetchAll();

    }
    /*===================================================================
    REGISTRAR Drogas UNO A UNO DESDE EL FORMULARIO DE Drogas
    ====================================================================*/
    static public function mdlRegistrarDroga($id_droga, $nombre_droga){        

        try{

            //$fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblDrogas(id_droga, nombre_Droga
                                    
                                                                       ) 
                                                VALUES (:id_droga, 
                                                        :nombre_droga
                                                        )");      
                                                        
            $stmt -> bindParam(":id_droga", $id_droga , PDO::PARAM_STR);
            $stmt -> bindParam(":nombre_droga", $nombre_droga, PDO::PARAM_STR);

        
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
    LISTAR NOMBRE DE Drogas PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombreDrogas(){

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM tblDrogas");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
}