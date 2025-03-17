<?php

require_once "conexion.php";

class ingresosDetallesModelo{

    
    /*===================================================================
    OBTENER LISTADO TOTAL DE ingresosDetalles PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListaringresosDetallesCb(){
        $stmt = Conexion::conectar()->prepare("SELECT  *
                                                FROM tblingresos_Detalles
                                            order BY id asc");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
    
    static public function mdlListaringresosDetalles(){
        $stmt = Conexion::conectar()->prepare('call prc_ListaringresosDetalles');
        $stmt -> execute();

        return $stmt->fetchAll();

    }
    /*===================================================================
    REGISTRAR ingresosDetalles UNO A UNO DESDE EL FORMULARIO DE ingresosDetalles
    ====================================================================*/
    static public function mdlRegistraringresos_detalles($id, $folio_detalle,$id_concepto,$cantidad, $precio, $importe){        

        try{

            //$fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblingresos_Detalles(id,folio_detalle, id_concepto,cantidad,precio,importe    ) 
                                                VALUES (:id, 
                                                        :folio_detalle,:id_concepto,:cantidad,:precio, :importe
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":folio_detalle", $folio_detalle, PDO::PARAM_STR);
            $stmt -> bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
            $stmt -> bindParam(":precio", $precio, PDO::PARAM_STR);
            $stmt -> bindParam(":importe", $importe, PDO::PARAM_STR);
        
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
    LISTAR NOMBRE DE ingresosDetalles PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombreingresosDetalles(){
                    
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM tblingresos_Detalle");

        $stmt -> execute();

        return $stmt->fetchAll();
    }


    /*===================================================================
    BUSCAR POR ID DEL DETALLE DEL PAGO
    ====================================================================*/
    static public function mdlGetDatosingresosDetalles($id){

        $stmt = Conexion::conectar()->prepare("SELECT 
        p.id, p.nombre, p.sexo, p.fecha_nacimiento, p.edad, p.direccion,
        p.estado_civil, p.escolaridad, p.id_ocupacion, left(o.nombre_ocupacion,20) as nombre_ocupacion,
        p.id_nacionalidad, n.gentilicio_nac, p.comorbilidad, p.estatus,
        p.fecha_creacion, p.id_empresa, e.nombre as nombre_clinica                                                  
    FROM tblpacientes p INNER JOIN tblocupaciones o on p.id_ocupacion = o.id 
    inner join tblnacionalidad n on p.id_nacionalidad = n.id
    inner join tblempresa e on p.id_empresa = e.id WHERE p.id = :id");
        
        $stmt -> bindParam(":id",$id,PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}