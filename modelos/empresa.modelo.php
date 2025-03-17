<?php

require_once "conexion.php";

class EmpresaModelo{

    static public function mdlListarEmpresa(){

  
   $stmt = Conexion::conectar()->prepare('call prc_ListarEmpresa');

        $stmt -> execute();

        return $stmt->fetchAll();
    }
    /*===================================================================
    OBTENER LISTADO TOTAL DE representantes PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarEmpresacb($idclinica,$idrol){
    
        if($idrol==1){
        $stmt = Conexion::conectar()->prepare('SELECT  id, nombre
                                                FROM tblempresa  order BY nombre asc'); 
         $stmt -> bindParam(":idclinica",$idclinica,PDO::PARAM_STR); 
         }
    else
    {
        $stmt = Conexion::conectar()->prepare('SELECT  id, nombre
                                               FROM tblempresa where id = :idclinica  order BY nombre asc'); 
        $stmt -> bindParam(":idclinica",$idclinica,PDO::PARAM_STR); 
    }                                                                                
         $stmt->execute();
         return $stmt->fetchAll();
     }
    
    /*===================================================================
    REGISTRAR EMPRESA UNO A UNO DESDE EL FORMULARIO DE CLINICAS
    ====================================================================*/
    static public function mdlRegistrarEmpresa($id, $nombre, $direccion, $telefono,
     $representante_legal,$fecha){        

        try{

            $fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblEmpresa(id, nombre, direccion, telefono, representante_legal,cedula_legal,
            fecha ) 
                                                VALUES (:id, 
                                                :nombre,
                                                 :direccion,
                                                  :telefono,
                                                   :representante_legal,
                                                   :cedula_legal,
                                                    :fecha
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt -> bindParam(":direccion", $direccion, PDO::PARAM_STR);
            $stmt -> bindParam(":telefono", $telefono, PDO::PARAM_STR);  
            $stmt -> bindParam(":representante_legal", $representante_legal, PDO::PARAM_STR);
            $stmt -> bindParam(":cedula_legal", $cedula_legal, PDO::PARAM_STR);
            $stmt -> bindParam(":fecha", $fecha, PDO::PARAM_STR); 
//$stmt -> bindParam(":logo", $logo, PDO::PARAM_STR);
        
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
    LISTAR NOMBRE DE EMPRESA PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombreEmpresa(){

        $stmt = Conexion::conectar()->prepare("SELECT * from tblempresa");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
/*===================================================================
    BUSCAR PRODUCTO POR ID DEL PACIENTE
    ====================================================================*/
    static public function mdlGetDatosEmpresa($id){

        $stmt = Conexion::conectar()->prepare("select * from tblempresa WHERE id = :id");
        
        $stmt -> bindParam(":id",$id,PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
 
    
    
} 
                                                                                         