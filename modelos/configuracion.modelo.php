<?php

require_once "conexion.php";

class ConfiguracionModelo{

    static public function mdlGetDatosConfiguracion($id){
        $stmt = Conexion::conectar()->prepare("SELECT p.id_rol,id_modulo,nombre_modulo, 
        consultar,grabar,actualizar,borrar from vtapermisosrolesmodulos p
        INNER JOIN usuarios u on p.id_rol = u.rol_id where usu_id = :usu_id");
        
        $stmt -> bindParam(":usu_id",$id,PDO::PARAM_INT);

        $stmt -> execute();
        return $stmt->fetchAll();
       // return $stmt->fetch(PDO::FETCH_OBJ);
    }
   

    static public function mdlGetDatosConfiguracionx(){

        $stmt = Conexion::conectar()->prepare('call prc_ObtenerDatosConfiguracion()');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
      
    }

    static public function mdlGetVentasMesActual(){

        $stmt = Conexion::conectar()->prepare('call prc_ObtenerVentasMesActual');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlProductosMasVendidos(){
    
        $stmt = Conexion::conectar()->prepare('call prc_ListarProductosMasVendidos()');
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlProductosPocoStock(){
    
        $stmt = Conexion::conectar()->prepare('call prc_ListarProductosPocoStock');
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}
