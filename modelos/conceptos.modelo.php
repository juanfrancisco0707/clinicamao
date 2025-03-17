<?php

require_once "conexion.php";

class ConceptosModelo{

    static public function mdlListarConceptos(){

      //  $stmt = Conexion::conectar()->prepare("SELECT  id, descripcion, tipo
      //                                          FROM tblconceptos c 
     //                                       order BY descripcion asc");

        $stmt = Conexion::conectar()->prepare('call prc_ListarConceptos');
        $stmt -> execute();
        return $stmt->fetchAll();
    }
    static public function mdlListarConceptosCb(){
    
        $stmt = Conexion::conectar()->prepare("SELECT  id, descripcion, tipo
        FROM tblconceptos where tipo = 'Ingresos' order BY descripcion asc");                                        
         $stmt->execute();
         return $stmt->fetchAll();
     }
     // Este llena el combo para los conceptos de Gastos
     static public function mdlListarConceptosCbgastos(){
         
    
        $stmt = Conexion::conectar()->prepare("SELECT  id, descripcion, tipo
        FROM tblconceptos where tipo = 'Gastos' order BY descripcion asc");                                        
         $stmt->execute();
         return $stmt->fetchAll();
     }

    /*===================================================================
    REGISTRAR CONCEPTOS UNO A UNO DESDE EL FORMULARIO DE CONCEPTOS
    ====================================================================*/
    static public function mdlRegistrarConcepto($id, $descripcion,$tipo){        

        try{
            $stmt = Conexion::conectar()->prepare("INSERT INTO tblconceptos(id, 
                                                                       descripcion,
                                                                       tipo
                                                                       ) 
                                                VALUES (:id, 
                                                        :descripcion, 
                                                        :tipo
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":descripcion", $descripcion , PDO::PARAM_STR);
            $stmt -> bindParam(":tipo", $tipo , PDO::PARAM_STR);
        
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
    LISTAR NOMBRE DE Conceptos PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombreConceptos(){

        $stmt = Conexion::conectar()->prepare("SELECT Concat(id , ' - ' ,descripcion)  as descripcion_concepto
                                                FROM tblConceptos c");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

    /*===================================================================
    BUSCAR concepto POR SU CODIGO DE BARRAS
    ====================================================================*/
    static public function mdlGetDatosconcepto($id){

        $stmt = Conexion::conectar()->prepare("SELECT   id,
                                                        descripcion,
                                                        tipo FROM tblConceptos
                                                        WHERE id = :id
                                                ");
        
        $stmt -> bindParam(":id",$id,PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }



}