<?php
require_once "conexion.php";
class CategoriasDiagnosticoModelo{
    /*===================================================================
    OBTENER LISTADO TOTAL DE CategoriasDiagnostico PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarCategoriasDiagnostico(){
        $stmt = Conexion::conectar()->prepare("SELECT id_categoria_diagnostico, nombre_categoria, descripcion_categoria
                                                FROM CategoriasDiagnostico
                                                ORDER BY nombre_categoria ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /*===================================================================
    REGISTRAR CategoriasDiagnostico UNO A UNO DESDE EL FORMULARIO
    ====================================================================*/
    static public function mdlRegistrarCategoriaDiagnostico($nombre_categoria, $descripcion_categoria){        
        try{
            $stmt = Conexion::conectar()->prepare("INSERT INTO CategoriasDiagnostico(nombre_categoria, descripcion_categoria) 
                                                    VALUES (:nombre_categoria, :descripcion_categoria)");      
            $stmt->bindParam(":nombre_categoria", $nombre_categoria, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_categoria", $descripcion_categoria, PDO::PARAM_STR);

            if($stmt->execute()){
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

    /*===================================================================
    ACTUALIZAR INFORMACION DE CategoriasDiagnostico
    ====================================================================*/
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
    PETICION DELETE PARA ELIMINAR DATOS DE CategoriasDiagnostico
    =============================================*/
    static public function mdlEliminarInformacion($table, $id, $nameId){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE $nameId = :$nameId");
        $stmt->bindParam(":".$nameId, $id, PDO::PARAM_INT);
        if($stmt->execute()){
            return "ok";
        }else{
            return Conexion::conectar()->errorInfo();
        }
    }   

    /*===================================================================
    LISTAR NOMBRES DE CategoriasDiagnostico PARA INPUT DE AUTOCOMPLETADO (si es necesario)
    ====================================================================*/
    static public function mdlListarNombreCategoriasDiagnostico(){
        $stmt = Conexion::conectar()->prepare("SELECT id_categoria_diagnostico, nombre_categoria FROM CategoriasDiagnostico");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
