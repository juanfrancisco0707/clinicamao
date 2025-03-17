<?php

require_once "conexion.php";

class representantesModelo{
 
    /*===================================================================
    OBTENER LISTADO TOTAL DE representantes PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarrepresentantes($id_clinica){
    
       // $stmt = Conexion::conectar()->prepare('call prc_Listarrepresentantes');
       $stmt = Conexion::conectar()->prepare(" SELECT   
       '' as detalles, 
       r.id,
       r.nombre_representante,
       r.direccion,
       r.edad,
       r.parentesco,
       r.telefono,
       r.id_ocupacion,
       o.NOMBRE_OCUPACION,
       r.id_clinica,
       e.nombre,
       r.estatus,       
       '' as acciones                                               
           FROM tblrepresentantes r 
           INNER JOIN tblempresa e on e.id = r.id_clinica
           INNER JOIN tblocupaciones o on r.id_ocupacion = o.id
            where r.id_clinica = :id_clinica
           order by r.id DESC   ");
        $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);            
        $stmt->execute();
    
        return $stmt->fetchAll();
    }
    static public function mdlListarFolioRepresentantes($idclinica){
        $stmt = Conexion::conectar()->prepare("
        select max(id) + 1 as folio
        from tblrepresentantes r where r.id_clinica=:idclinica
        ");
        $stmt -> bindParam(":idclinica",$idclinica,PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
       
     }

    static public function mdlListarrepresentantesadmin(){
    
        // $stmt = Conexion::conectar()->prepare('call prc_Listarrepresentantes');
        $stmt = Conexion::conectar()->prepare(" SELECT  
         '' as detalles, 
       r.id,
       r.nombre_representante,
       r.direccion,
       r.edad,
       r.parentesco,
       r.telefono,
       r.id_ocupacion,
       o.NOMBRE_OCUPACION,
       r.id_clinica,
       e.nombre,
       r.estatus,       
       '' as acciones                                             
            FROM tblrepresentantes r 
            INNER JOIN tblempresa e on e.id = r.id_clinica
            INNER JOIN tblocupaciones o on r.id_ocupacion = o.id
            order by r.id DESC   ");


         $stmt->execute();
     
         return $stmt->fetchAll();
     }
/*===================================================================
    OBTENER LISTADO TOTAL DE representantes PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarrepresentantescb($idclinica){
    
        // $stmt = Conexion::conectar()->prepare('call prc_Listarrepresentantes');
        $stmt = Conexion::conectar()->prepare('SELECT  id, nombre_representante
        FROM tblrepresentantes r where r.id_clinica = :idclinica
    order BY nombre_representante asc');
     $stmt -> bindParam(":idclinica",$idclinica,PDO::PARAM_STR);
         $stmt->execute();
     
         return $stmt->fetchAll();
     }
    /*===================================================================
    REGISTRAR REPRESENTANTES UNO A UNO DESDE EL FORMULARIO DE REPRESENTANTES
    ====================================================================*/
    static public function mdlRegistrarRepresentante($id, $nombre_representante, $parentesco,
                                                     $telefono, $id_clinica, $estatus,$direccion,$edad,$id_ocupacion){        

        try{

            //$fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblrepresentantes(id, nombre_representante,
                                                                       parentesco,
                                                                       telefono,id_clinica,
                                                                       estatus,direccion,edad,id_ocupacion
                                                                       ) 
                                                VALUES (:id, 
                                                        :nombre_representante, 
                                                        :parentesco, 
                                                        :telefono,
                                                        :id_clinica, 
                                                        :estatus,
                                                        :direccion,
                                                        :edad,
                                                        :id_ocupacion
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":nombre_representante", $nombre_representante, PDO::PARAM_STR);
            $stmt -> bindParam(":parentesco", $parentesco, PDO::PARAM_STR);
            $stmt -> bindParam(":telefono", $telefono, PDO::PARAM_STR);     
            $stmt -> bindParam(":id_clinica", $id_clinica, PDO::PARAM_STR);      
            $stmt -> bindParam(":estatus", $estatus, PDO::PARAM_STR);
            $stmt -> bindParam(":direccion", $direccion, PDO::PARAM_STR);
            $stmt -> bindParam(":edad", $edad, PDO::PARAM_STR);
            $stmt -> bindParam(":id_ocupacion", $id_ocupacion, PDO::PARAM_STR);
        
        
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

    static public function mdlActualizarInformacion($table, $data, $id, $id_clinica, $nameId){

        $set = "";

        foreach ($data as $key => $value) {
            
            $set .= $key." = :".$key.",";
                
        }

        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId and id_clinica=:id_clinica");

        foreach ($data as $key => $value) {
            
            $stmt->bindParam(":".$key, $data[$key], PDO::PARAM_STR);
            
        }		

        $stmt->bindParam(":".$nameId, $id, PDO::PARAM_INT);
        $stmt->bindParam(":".$id_clinica, $id_clinica, PDO::PARAM_INT);

        if($stmt->execute()){

            return "ok";

        }else{

            return Conexion::conectar()->errorInfo();
        
        }
    }

    /*=============================================
    Peticion DELETE para eliminar datos
    =============================================*/

    static public function mdlEliminarInformacion($table, $id, $nameId, $id_clinica, $nameId2){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE 
                                        $nameId = $id and $nameId2=$id_clinica");

        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_INT);
        $stmt -> bindParam(":".$nameId2, $id_clinica, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";;
        
        }else{

            return Conexion::conectar()->errorInfo();

        }

    }   

    /*===================================================================
    LISTAR NOMBRE DE REPRESENTANTES PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombreRepresentantes(){

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM tblrepresentantes");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

    
}