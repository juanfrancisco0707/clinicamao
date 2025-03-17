<?php

require_once "conexion.php";

class permisosModelo{
 
    /*===================================================================
    OBTENER LISTADO TOTAL DE permisos PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarpermisos(){
    
        $stmt = Conexion::conectar()->prepare('call prc_Listarpermisos');
                                           
        $stmt->execute();
    
        return $stmt->fetchAll();
    }

    /*===================================================================
    BUSCAR EL ID DE UN ROL DENTRO DE PERMISOS
    ====================================================================*/
    static public function mdlGetDatosPermiso($id_rol){

        $stmt = Conexion::conectar()->prepare("SELECT p.id,p.id_rol,r.nombre_rol, p.id_modulo,m.nombre_modulo, p.consultar,p.grabar,p.actualizar,p.borrar                             
        from permisos  p Inner JOIN modulos m on m.id = p.id_modulo INNER JOIN rol r on r.id = p.id_rol where p.id_rol = :id_rol");
        $stmt -> bindParam(":id_rol", $id_rol,PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }
    /*===================================================================
    OBTENER LISTADO TOTAL DE permisos PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarpermisoscb(){
      
        $stmt = Conexion::conectar()->prepare('SELECT  *
        FROM permisos r 
                    order BY id asc');                                        
         $stmt->execute();
     
         return $stmt->fetchAll();
     }
    /*===================================================================
    REGISTRAR permisos UNO A UNO DESDE EL FORMULARIO DE permisos
    ====================================================================*/
    static public function mdlRegistrarPermiso($id, $id_rol, $id_modulo, $consultar,
                                                $grabar,$actualizar,$borrar){        

        try{

            //$fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO permisos(id, id_rol,id_modulo,
                                                consultar,grabar,actualizar,borrar
                                                                       ) 
                                                VALUES (:id, 
                                                        :id_rol, 
                                                        :id_modulo, 
                                                        :consultar, 
                                                        :grabar,
                                                        :actualizar,
                                                        :borrar
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":id_rol", $id_rol, PDO::PARAM_STR);
            $stmt -> bindParam(":id_modulo", $id_modulo, PDO::PARAM_STR);
            $stmt -> bindParam(":consultar", $consultar, PDO::PARAM_STR);      
            $stmt -> bindParam(":grabar", $grabar, PDO::PARAM_STR);
            $stmt -> bindParam(":actualizar", $actualizar, PDO::PARAM_STR);
            $stmt -> bindParam(":borrar", $borrar, PDO::PARAM_STR);
        
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
    /*===================================================================
    BUSCAR PERMISO  id rol y id módulo
    ====================================================================*/
    static public function mdlGetDatosPermisos($id_rol,$id_modulo){

        $stmt = Conexion::conectar()->prepare("SELECT p.id,p.id_rol,r.nombre_rol, 
        p.id_modulo,m.nombre_modulo,
         p.consultar,p.grabar,p.actualizar,p.borrar                            
        from permisos  p Inner JOIN modulos m on
         m.id = p.id_modulo INNER JOIN rol r on r.id = p.id_rol
         WHERE p.id_rol=:id_rol and p.id_modulo=:id_modulo");
        
        $stmt -> bindParam(":id_rol",$id_rol,PDO::PARAM_INT);
        $stmt -> bindParam(":id_modulo",$id_modulo,PDO::PARAM_INT);

        if($stmt -> execute()){
            $count = $stmt->rowCount();
            if($count > 0){ return "ok";} else {return "no";}
        }else{
            return Conexion::conectar()->errorInfo();
        }

       // return $stmt->fetch(PDO::FETCH_OBJ);
    }

/*===================================================================
    BUSCAR PERMISO POR ID 
    ====================================================================*/
    static public function mdlGetDatosPermisosId($id){

        $stmt = Conexion::conectar()->prepare("SELECT p.id,p.id_rol,r.nombre_rol, 
        p.id_modulo,m.nombre_modulo,
         p.consultar,p.grabar,p.actualizar,p.borrar                            
        from permisos  p Inner JOIN modulos m on
         m.id = p.id_modulo INNER JOIN rol r on r.id = p.id_rol
         WHERE p.id=:id");
        
        $stmt -> bindParam(":id",$id,PDO::PARAM_INT);
        

        if($stmt -> execute()){
            $count = $stmt->rowCount();
            if($count > 0){ 
                return "ok";
            }
             else {
                 return "no";
            }
        }else{
            return Conexion::conectar()->errorInfo();
        }

       // return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /*=============================================
    Peticion DELETE para eliminar datos
    =============================================*/

    static public function mdlEliminarInformacion($table, $id, $nameId){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE $nameId = :$nameId");

        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";
        
        }else{

            return Conexion::conectar()->errorInfo();

        }

    }   

    /*===================================================================
    LISTAR NOMBRE DE permisos PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombrepermisos(){

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM permisos");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

    
}