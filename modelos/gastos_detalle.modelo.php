<?php

require_once "conexion.php";

class Gastos_detalleModelo{

    static public function mdlListarGastos_detalle(){

        $stmt = Conexion::conectar()->prepare("SELECT  id, cantidad, id_concepto,
        Round(importe,2) as importe, 
        Round (subtotal,2) as subtotal, folio_detalle
                                                FROM  tblgastos_detalle g
                                            order BY id asc");

        $stmt -> execute();

        return $stmt->fetchAll();

    }

  /*===================================================================
    REGISTRAR GASTOS_DETALLE UNO A UNO DESDE EL FORMULARIO DE GASTOS_DETALLE
    ====================================================================*/
    static public function mdlRegistrarGastos_detalle($id, $cantidad,$id_concepto,$importe,
                                                $subtotal,$folio_detalle){        

        try{

            $fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblgastos_detalle(id, 
                                                                       cantidad,
                                                                       id_concepto,
                                                                       importe,
                                                                       subtotal,
                                                                       folio_detalle
                                                                       ) 
                                                VALUES (:id, 
                                                        :cantidad, 
                                                        :id_concepto, 
                                                        :importe, 
                                                        :subtotal,
                                                        :folio_detalle 
                                                        )");      
                                                        
            $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
            $stmt -> bindParam(":cantidad", $cantidad , PDO::PARAM_STR);
            $stmt -> bindParam(":id_concepto", $id_concepto , PDO::PARAM_STR);
            $stmt -> bindParam(":importe", $importe, PDO::PARAM_STR);
            $stmt -> bindParam(":subtotal", $subtotal , PDO::PARAM_STR);
            $stmt -> bindParam(":folio_detalle", $folio_detalle , PDO::PARAM_STR);
           
        
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
}