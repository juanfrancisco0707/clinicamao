<?php

require_once "conexion.php";

class PlanTerapeuticoModelo{

    
    /*===================================================================
    OBTENER LISTADO TOTAL DE PlanTerapeutico PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarPlanTerapeuticoCb(){
        $stmt = Conexion::conectar()->prepare("SELECT  id, nombre
                                                FROM tblPlan_Terapeutico
                                            order BY nombre asc");
        $stmt -> execute();
        return $stmt->fetchAll();
    }
    
    static public function mdlListarPlanTerapeutico(){
        $stmt = Conexion::conectar()->prepare('call prc_ListarPlanTerapeutico');
        $stmt -> execute();
        return $stmt->fetchAll();

    }
    /*===================================================================
    REGISTRAR PlanTerapeutico UNO A UNO DESDE EL FORMULARIO DE PlanTerapeutico
    ====================================================================*/
    static public function mdlRegistrarDroga($id_droga, $nombre_droga){        

        try{

            //$fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblPlanTerapeutico(id_droga, nombre_Droga
                                    
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
    LISTAR NOMBRE DE PlanTerapeutico PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombrePlanTerapeutico(){

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM tblPlanTerapeutico");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
}