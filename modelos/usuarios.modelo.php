<?php

require_once "conexion.php";

class UsuariosModelo{

    static public function mdlListarUsuarios(){

      /*  $stmt = Conexion::conectar()->prepare("SELECT  u.usu_id, u.usu_nombre,
         u.usu_correo, u.usu_contrasena, u.rol_id,
        r.nombre_rol FROM usuarios u inner join rol r on r.id = u.rol_id
        order BY u.usu_nombre asc");*/
        $stmt = Conexion::conectar()->prepare('call prc_ListarUsuarios');

        $stmt -> execute();

        return $stmt->fetchAll();
    }
    static public function mdlListarUsuarioscb(){

         $stmt = Conexion::conectar()->prepare("SELECT  u.usu_id, u.usu_nombre,
           u.usu_correo, u.usu_contrasena, u.rol_id,
          r.nombre_rol FROM usuarios u inner join rol r on r.id = u.rol_id
          order BY u.usu_nombre asc");
          $stmt -> execute();
  
          return $stmt->fetchAll();
      }
/*===================================================================
    OBTENER LISTADO TOTAL DE USUARIOS ACTIVOS INDIVIDUALES
    ====================================================================*/
    static public function mdlListarUsuarioActivo($id){        
        $stmt = Conexion::conectar()->prepare("select * from usuarios e  where e.estatus ='Activo' and usu_id=:id"); 
        $stmt -> bindParam(":id", $id , PDO::PARAM_STR);                                        
       // $stmt->execute();
        //return $stmt->fetchAll();
        if($stmt -> execute()){

            return "ok";
        
        }else{

            return "no";//Conexion::conectar()->errorInfo();

        }

    }
    /*===================================================================
    OBTENER LISTADO TOTAL DE USUARIOS PARA MODIFICAR EL PERFIL
    ====================================================================*/
    static public function mdlListarUsuarioPerfil($id){        
        $stmt = Conexion::conectar()->prepare("select * from usuarios where usu_id=:id"); 
        $stmt -> bindParam(":id", $id , PDO::PARAM_STR);                                        
         $stmt->execute();
        return $stmt->fetchAll();
    }
      /*===================================================================
    OBTENER LISTADO TOTAL DE USUARIOS PARA MODIFICAR EL PERFIL
    ====================================================================*/
    static public function mdlListarUsuarioLogin($usu_nombre){        
        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios u inner join rol r ON u.rol_id = r.id 
        inner join tblempresa e ON u.usu_clinica = e.id
        where usu_nombre = :usu_nombre"); 
        $stmt -> bindParam(":usu_nombre", $usu_nombre , PDO::PARAM_STR);  
         $stmt->execute();
        return $stmt->fetchAll();
    }
/*===================================================================
    OBTENER LISTADO TOTAL DE USUARIOS ACTIVOS INDIVIDUALES
    ====================================================================*/
    static public function mdlVerificarContra($contra_actual,$contra_paso){  

       // $stmt = Conexion::conectar()->prepare("select * from usuarios e  where e.estatus ='Activo' and usu_id=:id"); 
       // $stmt -> bindParam(":id", $id , PDO::PARAM_STR);                                        
      //  $stmt->execute();
        //return $stmt->fetchAll();
         $passactual=  $contra_actual; //password_hash($contra_actual,PASSWORD_DEFAULT,['cost'=>10]);
         $passpaso = $contra_paso; //password_hash($contra_nueva,PASSWORD_DEFAULT,['cost'=>10]);
         if(password_verify($passactual, $passpaso))
         {
            return "ok";
        
        }else{
            return "no";//Conexion::conectar()->errorInfo();
        }

    }


    /*===================================================================
    REGISTRAR USUARIOS UNO A UNO DESDE EL FORMULARIO DE USUARIOS
    ====================================================================*/
    static public function mdlRegistrarUsuario($usu_id, $usu_nombre,
    $usu_contrasena,$rol_id,$usu_estatus,$usu_correo,$usu_nombre_completo,$usu_clinica){        
        try{

            $fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(usu_id, 
                                                                       usu_nombre,
                                                                       usu_contrasena,
                                                                       rol_id,
                                                                       usu_estatus,
                                                                       usu_correo,
                                                                       usu_nombre_completo,
                                                                       usu_clinica
                                                                       ) 
                                                VALUES (:usu_id, 
                                                        :usu_nombre, 
                                                        :usu_contrasena,
                                                        :rol_id,
                                                        :usu_estatus,
                                                        :usu_correo, 
                                                        :usu_nombre_completo, 
                                                        :usu_clinica 
                                                        )");      
                                                        
            $stmt -> bindParam(":usu_id", $usu_id , PDO::PARAM_STR);
            $stmt -> bindParam(":usu_nombre", $usu_nombre , PDO::PARAM_STR);
            $stmt -> bindParam(":usu_contrasena", $usu_contrasena , PDO::PARAM_STR);
            $stmt -> bindParam(":rol_id", $rol_id, PDO::PARAM_STR);
            $stmt -> bindParam(":usu_estatus", $usu_estatus , PDO::PARAM_STR);
            $stmt -> bindParam(":usu_correo", $usu_correo , PDO::PARAM_STR);
            
            $stmt -> bindParam(":usu_nombre_completo", $usu_nombre_completo , PDO::PARAM_STR);
            $stmt -> bindParam(":usu_clinica", $usu_clinica , PDO::PARAM_STR);


             //$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            if($stmt -> execute()){
                $resultado = "ok";
            }
            //else{
            //    $resultado = "error";
            //}  
       
        }catch (PDOException $e) {
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
    BUSCAR USUARIO POR SU ID 
    ====================================================================*/
    static public function mdlGetDatosUsuario($id){
        $stmt = Conexion::conectar()->prepare("SELECT   '' as detalles,
        u.usu_id,
        u.usu_nombre_completo,
        u.usu_nombre,
        u.usu_contrasena,
        u.usu_correo,
        u.rol_id,
        r.nombre_rol,
        u.usu_estatus,
        u.usu_clinica,
        e.nombre,
        '' as acciones                                   
        from usuarios u 
        INNER JOIN rol r ON u.rol_id=r.id
        INNER JOIN tblempresa e on u.usu_clinica = e.id WHERE u.usu_id = :usu_id");
        
        $stmt -> bindParam(":usu_id",$id,PDO::PARAM_INT);

        $stmt -> execute();
        return $stmt->fetchAll();
       // return $stmt->fetch(PDO::FETCH_OBJ);
    }
    /*===================================================================
    LISTAR NOMBRE DE REPRESENTANTES PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
  /*  static public function mdlListarNombreRepresentantes(){

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM tblrepresentantes");

        $stmt -> execute();

        return $stmt->fetchAll();
    }*/




}