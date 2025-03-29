<?php

require_once "conexion.php";

class ServicioModelo{

    /*===================================================================
    OBTENER LISTADO TOTAL DE Servicios PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarServicios(){
        $stmt = Conexion::conectar()->prepare("SELECT  id_servicio, nombre_servicio, descripcion, precio
                                                FROM tblmao_servicio
                                            order BY nombre_servicio asc");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
    
    /*===================================================================
    REGISTRAR Servicio UNO A UNO DESDE EL FORMULARIO DE Servicios
    ====================================================================*/
    static public function mdlRegistrarServicio($id_servicio, $nombre_servicio, $descripcion, $precio){        

        try{

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblmao_servicio(id_servicio, nombre_servicio, descripcion, precio) 
                                                VALUES (:id_servicio, :nombre_servicio, :descripcion, :precio)");      
                                                        
            $stmt -> bindParam(":id_servicio", $id_servicio , PDO::PARAM_INT);
            $stmt -> bindParam(":nombre_servicio", $nombre_servicio, PDO::PARAM_STR);
            $stmt -> bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt -> bindParam(":precio", $precio, PDO::PARAM_STR);

        
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
    LISTAR NOMBRE DE Servicios PARA INPUT DE AUTO COMPLETADO (si es necesario)
    ====================================================================*/
    static public function mdlListarNombreServicios(){

        $stmt = Conexion::conectar()->prepare("SELECT id_servicio, nombre_servicio
                                                FROM tblmao_servicio");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
    
    /*===================================================================
    OBTENER UN SERVICIO POR ID
    ====================================================================*/
    static public function mdlObtenerServicioPorId($id_servicio){
        $stmt = Conexion::conectar()->prepare("SELECT  id_servicio, nombre_servicio, descripcion, precio
                                                FROM tblmao_servicio
                                                WHERE id_servicio = :id_servicio");
        $stmt->bindParam(":id_servicio", $id_servicio, PDO::PARAM_INT);
        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
