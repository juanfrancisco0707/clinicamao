<?php

require_once "conexion.php";

class EstadosCitasModelo{

    /*==================================================================
    OBTENER LISTADO TOTAL DE Estados de Citas PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarEstadosCitas(){
        $stmt = Conexion::conectar()->prepare("SELECT  id_estado, nombre_estado
                                                FROM tblmao_estadoscitas
                                            order BY nombre_estado asc");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
    
    /*===================================================================
    REGISTRAR Estado de Cita UNO A UNO DESDE EL FORMULARIO 
    ====================================================================*/
    static public function mdlRegistrarEstadoCita($id_estado, $nombre_estado){        

        try{

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblmao_estadoscitas(id_estado, nombre_estado) 
                                                VALUES (:id_estado, :nombre_estado)");      
                                                        
            $stmt -> bindParam(":id_estado", $id_estado , PDO::PARAM_INT);
            $stmt -> bindParam(":nombre_estado", $nombre_estado, PDO::PARAM_STR);

        
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

    /*=================================================================
    LISTAR NOMBRE DE Estados de Citas PARA INPUT DE AUTO COMPLETADO
    ===================================================================*/
    static public function mdlListarNombreEstadosCitas(){

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM tblmao_estadoscitas");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
}
