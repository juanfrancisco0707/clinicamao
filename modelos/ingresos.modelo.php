<?php

require_once "conexion.php";

class IngresosModelo{


    static public function mdlListarIngresos($fechaDesde,$fechaHasta,$id_clinica,$rol){
        //concat('$ ',round(i.total,2)) as total_Pago,
        try {
            if($rol==1){
                //no recuerdo el objetivo de concatenar el periodo con el folio y el numero de 
                $stmt = Conexion::conectar()->prepare("SELECT  Concat('Folio Nro:  ',v.folio_detalle,'    - Total Pago: $ ',Round(i.total,2),' - ',i.nombre) as nro_folio,
                v.folio_detalle,
                c.descripcion,  v.cantidad, 
                concat('$ ',round(v.precio,2)) as precio,
                concat('$ ',round(v.importe,2)) as importe,
                i.fecha_pago
                FROM tblingresos_detalles v inner join tblconceptos c on v.id_concepto = c.id
                                    inner join vta_expedientes_pacientes_ingresos i on i.folio = v.folio_detalle
        where (DATE(i.fecha_pago) >= date(:fechaDesde) and DATE(i.fecha_pago) <= date(:fechaHasta) )
        order by v.folio_detalle asc");
                $stmt -> bindParam(":fechaDesde",$fechaDesde,PDO::PARAM_STR);
                $stmt -> bindParam(":fechaHasta",$fechaHasta,PDO::PARAM_STR);
            }
            else{
                    $stmt = Conexion::conectar()->prepare("SELECT Concat('Folio Nro:  ',v.folio_detalle,'    - Total Pago: $ ',Round(i.total,2),' - ',i.nombre) as nro_folio,
                    v.folio_detalle,
                    v.descripcion_detalle,  v.cantidad, 
                    concat('$ ',round(v.precio,2)) as precio,
                    concat('$ ',round(v.importe,2)) as importe,
                    i.fecha_pago
                    FROM tblingresos_detalles v inner join tblconceptos c on v.id_concepto = c.id
                                        inner join vta_expedientes_pacientes_ingresos i on i.folio = v.folio_detalle
            where (DATE(i.fecha_pago) >= date(:fechaDesde) and DATE(i.fecha_pago) <= date(:fechaHasta) ) and i.id_clinica = :id_clinica
            order by v.folio_detalle asc");
                    $stmt -> bindParam(":id_clinica",$id_clinica,PDO::PARAM_STR);
                    $stmt -> bindParam(":fechaDesde",$fechaDesde,PDO::PARAM_STR);
                    $stmt -> bindParam(":fechaHasta",$fechaHasta,PDO::PARAM_STR);
            }
            $stmt -> execute();

            return $stmt->fetchAll();
            
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
        

        $stmt = null;
    }


    static public function mdlListarIngresosf($fechaDesde,$fechaHasta,$paciente,$folio,$id_clinica,$rol){
        //concat('$ ',round(i.total,2)) as total_Pago,
        try {
            if($rol==1){
                //no recuerdo el objetivo de concatenar el periodo con el folio y el numero de 
                $stmt = Conexion::conectar()->prepare("SELECT  Concat('Folio Nro:  ',v.folio_detalle,'    - Total Pago: $ ',Round(i.total,2),' - ',i.nombre) as nro_folio,
                v.folio_detalle,
                c.descripcion,  v.cantidad, 
                concat('$ ',round(v.precio,2)) as precio,
                concat('$ ',round(v.importe,2)) as importe,
                i.fecha_pago
                FROM tblingresos_detalles v inner join tblconceptos c on v.id_concepto = c.id
                                    inner join vta_expedientes_pacientes_ingresos i on i.folio = v.folio_detalle
        where (DATE(i.fecha_pago) >= date(:fechaDesde) and DATE(i.fecha_pago) <= date(:fechaHasta) CONCAT('%', :paciente, '%'))
        order by v.folio_detalle asc");
                $stmt -> bindParam(":fechaDesde",$fechaDesde,PDO::PARAM_STR);
                $stmt -> bindParam(":fechaHasta",$fechaHasta,PDO::PARAM_STR);
                $stmt -> bindParam(":paciente",$paciente,PDO::PARAM_STR);
            }
            else{
                if($folio>0){
                    $stmt = Conexion::conectar()->prepare("SELECT Concat('Folio Nro:  ',v.folio_detalle,'    - Total Pago: $ ',Round(i.total,2),' - ',i.nombre) as nro_folio,
                    v.folio_detalle,
                    v.descripcion_detalle,  v.cantidad, 
                    concat('$ ',round(v.precio,2)) as precio,
                    concat('$ ',round(v.importe,2)) as importe,
                    i.fecha_pago
                    FROM tblingresos_detalles v inner join tblconceptos c on v.id_concepto = c.id
                                        inner join vta_expedientes_pacientes_ingresos i on i.folio = v.folio_detalle
            where (DATE(i.fecha_pago) >= date(:fechaDesde) and DATE(i.fecha_pago) <= date(:fechaHasta) and i.nombre 
            like CONCAT('%', :paciente, '%') and v.folio_detalle= :folio) and i.id_clinica = :id_clinica
            order by v.folio_detalle asc");
                    $stmt -> bindParam(":id_clinica",$id_clinica,PDO::PARAM_STR);
                    $stmt -> bindParam(":fechaDesde",$fechaDesde,PDO::PARAM_STR);
                    $stmt -> bindParam(":fechaHasta",$fechaHasta,PDO::PARAM_STR);
                    $stmt -> bindParam(":paciente",$paciente,PDO::PARAM_STR);
                    $stmt -> bindParam(":folio",$folio,PDO::PARAM_STR);

                }
                else{
                    $stmt = Conexion::conectar()->prepare("SELECT Concat('Folio Nro:  ',v.folio_detalle,'    - Total Pago: $ ',Round(i.total,2),' - ',i.nombre) as nro_folio,
                    v.folio_detalle,
                    v.descripcion_detalle,  v.cantidad, 
                    concat('$ ',round(v.precio,2)) as precio,
                    concat('$ ',round(v.importe,2)) as importe,
                    i.fecha_pago
                    FROM tblingresos_detalles v inner join tblconceptos c on v.id_concepto = c.id
                                        inner join vta_expedientes_pacientes_ingresos i on i.folio = v.folio_detalle
            where (DATE(i.fecha_pago) >= date(:fechaDesde) and DATE(i.fecha_pago) <= date(:fechaHasta) and i.nombre 
            like CONCAT('%', :paciente, '%')) and i.id_clinica = :id_clinica
            order by v.folio_detalle asc");
                    $stmt -> bindParam(":id_clinica",$id_clinica,PDO::PARAM_STR);
                    $stmt -> bindParam(":fechaDesde",$fechaDesde,PDO::PARAM_STR);
                    $stmt -> bindParam(":fechaHasta",$fechaHasta,PDO::PARAM_STR);
                    $stmt -> bindParam(":paciente",$paciente,PDO::PARAM_STR);


                }
            }
            $stmt -> execute();

            return $stmt->fetchAll();
            
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
        

        $stmt = null;
    }

    static public function mdlImprimirTicket($folio){
        //concat('$ ',round(i.total,2)) as total_Pago,
        try {
          
                $stmt = Conexion::conectar()->prepare("SELECT h.nombre_clinica,h.direccion_clinica,
                h.telefono_clinica, Concat('Folio Nro: ',v.folio_detalle,' - Total Pago: $ ',Round(i.total,2),' - ',i.nombre) as nro_folio,
                v.folio_detalle,
                v.descripcion_detalle,  v.cantidad, 
                concat('$ ',round(v.precio,2)) as precio,
                concat('$ ',round(v.importe,2)) as importe,
                ing.fecha_pago,i.nombre
               from tblingresos ing inner join tblingresos_detalles v on ing.folio = v.folio_detalle
							inner join vta_hoja_ingreso h on ing.id_expediente = h.id_expediente
                            inner join vta_expedientes_pacientes_ingresos i on i.folio = v.folio_detalle where ing.folio =:folio
        order by v.id asc");
                $stmt -> bindParam(":folio",$folio,PDO::PARAM_STR);
               
            
            $stmt -> execute();

            return $stmt->fetchAll();
            
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
        

        $stmt = null;
    }


    static public function mdlImprimirInformacion($folio, $id_clinica){
        //concat('$ ',round(i.total,2)) as total_Pago,
        try {
          
                $stmt = Conexion::conectar()->prepare("SELECT Concat('Folio Nro: ',v.folio_detalle,' - Total Pago: $ ',Round(i.total,2),' - ',i.nombre) as nro_folio,
                v.folio_detalle,
                v.descripcion_detalle,  v.cantidad, 
                concat('$ ',round(v.precio,2)) as precio,
                concat('$ ',round(v.importe,2)) as importe,
                i.fecha_pago
                FROM tblingresos_detalles v inner join tblconceptos c on v.id_concepto = c.id
                                    inner join vta_expedientes_pacientes_ingresos i on i.folio = v.folio_detalle
        where folio =:folio
        order by v.folio_detalle asc");
                $stmt -> bindParam(":folio",$folio,PDO::PARAM_STR);
                $stmt -> bindParam(":id_clinica",$id_clinica,PDO::PARAM_STR);
            
            $stmt -> execute();

            return $stmt->fetchAll();
            
        } catch (Exception $e) {
            return 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
        

        $stmt = null;
    }
    static public function mdlBuscarPagoCuotaIngreso($id_expediente,$id_clinica){

        $stmt = Conexion::conectar()->prepare(" SELECT * FROM tblingresos_detalles id
         inner join tblingresos i on i.folio= id.folio_detalle 
        where id.id_clinica=:id_clinica and i.id_expediente = :id_expediente and id.id_concepto = 1" );
          $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);   
          $stmt -> bindParam(":id_expediente", $id_expediente , PDO::PARAM_STR);   
          if($stmt->execute()>0){
            $nr = $stmt->rowCount();
            if($nr>0){ 
                return "ok";
            }
            else
            {
                return "no";
            }
            
        }
        else
        return "no";
        }


   
    static public function mdlObtenerFolioIngreso($clinica){

        $stmt = Conexion::conectar()->prepare("
        select IFNULL(LPAD(max(c.folio_pago)+1,6,'0'),'000001') as folio_pago
         from TBLempresa c where c.nombre =:clinica
        ");
        $stmt -> bindParam(":clinica",$clinica,PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
       // return $stmt->fetchAll();
    }

  /*===================================================================
    REGISTRAR Ingresos UNO A UNO DESDE EL FORMULARIO DE Ingresos
    ====================================================================*/
    static public function mdlRegistrarIngresos($datos,$folio,$id_clinica, $id_expediente,$fecha_pago,$total,$descripcion){        
        
        try{
                     $fecha = date('Y-m-d');
                    $stmt = Conexion::conectar()->prepare("INSERT INTO tblingresos(
                    folio, 
                    id_clinica,
                    id_expediente,
                    fecha_pago,
                    total,
                    descripcion,
                    estatus
                    ) 
            VALUES (
            :folio,
            :id_clinica,
            :id_expediente, 
            :fecha_pago, 
            :total, 
            :descripcion, 
            'A'
            )");      

            $stmt -> bindParam(":folio", $folio , PDO::PARAM_STR);
            $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);
            $stmt -> bindParam(":id_expediente", $id_expediente , PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_pago", $fecha_pago , PDO::PARAM_STR);
            $stmt -> bindParam(":total", $total , PDO::PARAM_STR);
            $stmt -> bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            //$stmt -> bindParam(":estatus", 'A');


            if($stmt -> execute()){
            
            $stmt = null;

            $stmt = Conexion::conectar()->prepare("UPDATE tblempresa SET folio_pago = folio_pago + 1 where id= :id_clinica");
            $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);
            if($stmt -> execute()){

                $listaConceptos = [];
                $c = 1;
                for ($i = 0; $i < count($datos); ++$i){
                    $c=$c + $i;
                    $listaConceptos = explode(",",$datos[$i]);
        
                    $stmt = Conexion::conectar()->prepare("INSERT INTO tblingresos_detalles(id,folio_detalle,id_clinica,id_periodo_pago,id_concepto,descripcion_detalle, cantidad,precio,importe) 
                                                        VALUES(:id,:folio_detalle,:id_clinica,:id_periodo_pago,:id_concepto,:descripcion_detalle,:cantidad,:precio,:importe)");
                   // if($listaConceptos[1])
                    $stmt -> bindParam(":id", $c , PDO::PARAM_STR);
                    $stmt -> bindParam(":folio_detalle", $folio , PDO::PARAM_STR);
                    $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);
                    $stmt -> bindParam(":id_periodo_pago", $listaConceptos[1] , PDO::PARAM_STR);
                    $stmt -> bindParam(":id_concepto", $listaConceptos[2] , PDO::PARAM_STR);
                    $stmt -> bindParam(":descripcion_detalle", $listaConceptos[3] , PDO::PARAM_STR);
                    $stmt -> bindParam(":cantidad", $listaConceptos[4] , PDO::PARAM_STR);
                    $stmt -> bindParam(":precio", $listaConceptos[5] , PDO::PARAM_STR);
                    $stmt -> bindParam(":importe", $listaConceptos[6] , PDO::PARAM_STR);
                    if($stmt -> execute()){
                       // Actualizo el estatus en el periodo de pago
                    }
                }
                        $stmt = null;
                        $listaConceptos1 = [];
                        $c = 1;
                        for ($i = 0; $i < count($datos); ++$i){
                            $c=$c + $i;
                            $listaConceptos1 = explode(",",$datos[$i]);
                
                            $stmt = Conexion::conectar()->prepare("update tblperiodos_pagos set pago=:precio,saldo=0,estatus='pagado'
                               where id=:id_periodo_pago and id_expediente=:id_expediente and id_clinica=:id_clinica
                                                               ");
                            if($listaConceptos1[2]==2){
                           
                                $stmt -> bindParam(":id_expediente", $id_expediente , PDO::PARAM_STR);
                                $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);
                                $stmt -> bindParam(":id_periodo_pago", $listaConceptos1[1] , PDO::PARAM_STR);
                                $stmt -> bindParam(":precio", $listaConceptos1[5] , PDO::PARAM_STR);
                              
                                if($stmt -> execute()){
                                    $stmt = null;
                                    $resultado = "Se registró el Pago correctamente.";                      
                                }else{
                                    $resultado = "Error al registrar el Pago";
                                }
                            }   
                }
        
                 return $resultado;
        
                 $stmt = null;
            }
            
         }else{
            $resultado = "error";
        }  

        } catch (Exception $e) {
        $resultado = 'Excepción capturada: '.  $e->getMessage(). "\n";
    }

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

    static public function mdlEliminarInformacion($folio, $id_clinica){
        try{
            $stmt = Conexion::conectar()->prepare("delete from tblingresos where folio = :folio and id_clinica=:id_clinica");

            $stmt -> bindParam(":folio", $folio, PDO::PARAM_INT);
            $stmt -> bindParam(":id_clinica", $id_clinica, PDO::PARAM_INT);
          
            if($stmt -> execute()){
                 
            $stmt = null;
            $stmt = Conexion::conectar()->prepare("delete from tblingresos_detalles where folio_detalle = :folio and id_clinica=:id_clinica");
            $stmt -> bindParam(":folio", $folio, PDO::PARAM_INT);
            $stmt -> bindParam(":id_clinica", $id_clinica, PDO::PARAM_INT);
                
            if($stmt -> execute()){
                $stmt = null;
                $resultado = "Se eliminó el Pago correctamente.";                      
            }else{
                $resultado = "Error al eliminar el Pago";
            }   
            return $resultado;
            $stmt = null;

            }
    }   catch (Exception $e) {
        $resultado = 'Excepción capturada: '.  $e->getMessage(). "\n";
    }

    }



}