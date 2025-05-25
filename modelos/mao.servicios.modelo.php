<?php

require_once "conexion.php";
class ModeloServicios{
    /*=============================================
    OBTENER SIGUIENTE ID DE SERVICIO
    =============================================*/
    static public function mdlObtenerSiguienteIdServicio($tabla){
        // Asegúrate que $tabla sea el nombre correcto de tu tabla de servicios.
        // Usaré 'tblmao_servicio' basado en tu mdlMostrarServicios, ajusta si es necesario.
        $stmt = Conexion::conectar()->prepare("SELECT IFNULL(MAX(id_servicio), 0) + 1 as siguiente_id FROM $tabla");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }


    /*=============================================
    MOSTRAR SERVICIOS
    =============================================*/
    static public function mdlMostrarServicios($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT  s.id_servicio ,  s.nombre_servicio,
             s.descripcion, s.precio, s.id_categoria,
              c.nombre_categoria FROM tblmao_servicio s LEFT JOIN
               tblmao_categoria_servicios c ON s.id_categoria=c.id");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }
        

        $stmt -> close();

        $stmt = null;

    }
    /*=============================================
    MOSTRAR categorias
    =============================================*/
    static public function mdlMostrarCategoriaServicios($tabla)
    {
          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    /*=============================================
    REGISTRO DE SERVICIO
    =============================================*/
    static public function mdlIngresarServicio($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_servicio, nombre_servicio, descripcion, precio, id_categoria) VALUES (:id_servicio, :nombre_servicio, :descripcion, :precio, :id_categoria)");

        $stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_servicio", $datos["nombre_servicio"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        
        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    EDITAR SERVICIO
    =============================================*/
    static public function mdlEditarServicio($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_servicio = :nombre_servicio, descripcion = :descripcion, precio = :precio, id_categoria = :id_categoria WHERE id_servicio = :id_servicio");

        $stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_servicio", $datos["nombre_servicio"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        
        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    BORRAR SERVICIO
    =============================================*/

    static public function mdlBorrarServicio($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_servicio = :id_servicio");

        $stmt -> bindParam(":id_servicio", $datos, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";
        
        }else{

            return "error";    

        }

        $stmt -> close();

        $stmt = null;

    }
}
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
    static public function mdlRegistrarServicio($id_servicio, $nombre_servicio, $descripcion, $precio, $id_categoria){        

        try{

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblmao_servicio(id_servicio, nombre_servicio, descripcion, precio, id_categoria) 
                                                VALUES (:id_servicio, :nombre_servicio, :descripcion, :precio, :id_categoria)");      
                                                        
            $stmt -> bindParam(":id_servicio", $id_servicio , PDO::PARAM_INT);
            $stmt -> bindParam(":nombre_servicio", $nombre_servicio, PDO::PARAM_STR);
            $stmt -> bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt -> bindParam(":precio", $precio, PDO::PARAM_STR);
            $stmt->bindParam(":id_categoria", $id_categoria, PDO::PARAM_INT);

        
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
