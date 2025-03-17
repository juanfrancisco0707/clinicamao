<?php

require_once "conexion.php";

class PeriodosModelo{

    static public function mdlListarPeriodos($id_clinica,$id_expediente){

    $stmt = Conexion::conectar()->prepare("SELECT '' as detalles,
    pp.id,
    pp.id_expediente,
    pp.id_clinica,
    e.NOMBRE,
    pp.fecha_inicial,
    pp.fecha_final,
    pp.pago,
    pp.saldo,
    pp.estatus,   
     '' as acciones
    FROM tblPeriodos_pagos pp INNER JOIN vta_expedientes_pacientes e on (e.id_expediente = pp.id_expediente)
    where pp.id_expediente =:id_expediente and pp.id_clinica = :id_clinica
     order by pp.id,pp.id_expediente desc");
      $stmt -> bindParam(":id_expediente", $id_expediente, PDO::PARAM_STR);   
      $stmt -> bindParam(":id_clinica", $id_clinica, PDO::PARAM_STR);   
      $stmt -> execute();
      return $stmt->fetchAll();
    }
    static public function mdlBuscarExpedientePeriodos($id_clinica,$id_expediente){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM tblperiodos_pagos
        where id_expediente =:id_expediente and id_clinica = :id_clinica and estatus='Pendiente'
       
        ");
            $stmt -> bindParam(":id_expediente", $id_expediente, PDO::PARAM_STR);   
            $stmt -> bindParam(":id_clinica", $id_clinica, PDO::PARAM_STR);   
            // $stmt -> execute();
            $stmt -> execute();
            $count = $stmt->rowCount();
            if($count > 0){ 
                return "ok";
            }
             else {
                return "no";
        }
         //   return $stmt->fetchAll();
        
    }
    static public function mdlBuscarExpediente($id_clinica,$id_expediente){

                 $stmt = Conexion::conectar()->prepare("SELECT * FROM tblingresos_detalles id inner join tblingresos i on i.folio= id.folio_detalle
                 where i.id_expediente =:id_expediente and id.id_clinica = :id_clinica
                
                 ");
          $stmt -> bindParam(":id_expediente", $id_expediente, PDO::PARAM_STR);   
          $stmt -> bindParam(":id_clinica", $id_clinica, PDO::PARAM_STR);   
         // $stmt -> execute();
          if($stmt -> execute()){
           
           $resultado = "ok";
        }
        else
        $resultado ="no";
          return  $resultado; //$stmt->fetchAll();
        }
        

    static public function mdlListarPeriodosCb($id_clinica,$id_expediente){

        $stmt = Conexion::conectar()->prepare("SELECT pp.id  as clave,
        concat (pp.fecha_inicial,' - ', pp.fecha_final) as fecha       
         FROM tblPeriodos_pagos pp INNER JOIN vta_expedientes_pacientes e on (e.id_expediente = pp.id_expediente)
        
        where pp.id_expediente =:id_expediente and pp.id_clinica = :id_clinica and pp.estatus<>'Pagado'
         order by pp.id,pp.id_expediente desc");
          $stmt -> bindParam(":id_expediente", $id_expediente, PDO::PARAM_STR);   
          $stmt -> bindParam(":id_clinica", $id_clinica, PDO::PARAM_STR);   
          $stmt -> execute();
          return $stmt->fetchAll();
          //Asi estaba
//SELECT concat (pp.id_clinica,pp.id_expediente,pp.id ) as clave,
//concat (pp.fecha_inicial,' - ', pp.fecha_final) as fecha       
//FROM tblPeriodos_pagos pp INNER JOIN vta_expedientes_pacientes e on (e.id_expediente = pp.id_expediente)
//where pp.id_expediente =:id_expediente and pp.id_clinica = :id_clinica and pp.estatus<>'Pagado'
//order by pp.id,pp.id_expediente desc

        }


    static public function mdlListarPeriodosAll($id_clinica){

        $stmt = Conexion::conectar()->prepare("SELECT '' as detalles,
        pp.id,
        pp.id_expediente,
        pp.id_clinica,
        e.NOMBRE,
        pp.fecha_inicial,
        pp.fecha_final,
        pp.pago,
        pp.saldo,
        pp.estatus,   
         '' as acciones
        FROM tblPeriodos_pagos pp INNER JOIN vta_expedientes_pacientes e on (e.id_expediente = pp.id_expediente)
        where pp.id_clinica = :id_clinica
         order by pp.id,pp.id_expediente desc");
         
          $stmt -> bindParam(":id_clinica", $id_clinica, PDO::PARAM_STR);   
          $stmt -> execute();
          return $stmt->fetchAll();
        }
    
/*===================================================================
    OBTENER LISTADO TOTAL DE Periodos PARA EL DATATABLE para el administrador
    ====================================================================*/
    static public function mdlListarPeriodosadmin(){
    
    //     $stmt = Conexion::conectar()->prepare('call prc_ListarPeriodos');
    $stmt = Conexion::conectar()->prepare("SELECT '' as detalles, 
            e.id_Periodos,
            e.id_clinica,
            e.id_paciente,
            p.NOMBRE, 
            e.id_representante,
            r.nombre_representante,
            r.telefono,
            e.fecha_ingreso,
            e.hora_ingreso,
            e.fecha_salida,
            e.tiempo_duracion,
            e.firmo_contrato,
            e.cuota_ingreso, 
            e.cuota_semanal,e.extras,
            e.testigo, 
            e.estatus, 
            '' as acciones
    FROM tblPeriodos e INNER JOIN tblpacientes p on (e.id_paciente = p.id  and e.id_clinica  = p.id_empresa)
     inner join tblrepresentantes r on (e.id_representante = r.id and e.id_clinica = r.id_clinica )
     order by e.id_Periodos desc");
    
         $stmt->execute();
     
         return $stmt->fetchAll();
     }
 
 /*===================================================================
    FOLIO DE Periodos POR SUCURSAL
    ====================================================================*/

    static public function mdlListarFolioPeriodos($idclinica){
        $stmt = Conexion::conectar()->prepare("
        select max(id_Periodos) + 1  as folio
        from tblPeriodos p where p.id_clinica=:idclinica
        ");
        $stmt -> bindParam(":idclinica",$idclinica,PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
       
     }

 /*===================================================================
    REGISTRAR Periodos UNO A UNO DESDE EL FORMULARIO DE Periodos
    ====================================================================*/
    static public function mdlRegistrarPeriodos($id,$id_expediente,$id_clinica,$fecha_inicial,$fecha_final,$pago,$saldo,$estatus){        

        try{

            $fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblPeriodos_pagos(
                                                                       id,
                                                                       id_expediente,
                                                                       id_clinica,
                                                                       fecha_inicial,
                                                                       fecha_final,
                                                                       pago,
                                                                       saldo,
                                                                       estatus                                                                       ) 
                                                VALUES (:id,
                                                        :id_expediente, 
                                                        :id_clinica,                                                        
                                                        :fecha_inicial, 
                                                        :fecha_final, 
                                                        :pago,
                                                        :saldo,
                                                        :estatus 
                                                 
                                                        )");      
          $stmt -> bindParam(":id", $id , PDO::PARAM_STR);
          $stmt -> bindParam(":id_expediente", $id_expediente, PDO::PARAM_STR);   
          $stmt -> bindParam(":id_clinica", $id_clinica, PDO::PARAM_STR);   
          $stmt -> bindParam(":fecha_inicial", $fecha_inicial, PDO::PARAM_STR);
          $stmt -> bindParam(":fecha_final", $fecha_final, PDO::PARAM_STR);   
          $stmt -> bindParam(":pago", $pago, PDO::PARAM_STR);
          $stmt -> bindParam(":saldo", $saldo, PDO::PARAM_STR);
          $stmt -> bindParam(":estatus",$estatus, PDO::PARAM_STR);   
        
            if($stmt -> execute()){
                $resultado = "ok";
            }else{
                $resultado = "error";
            }  
        }catch (Exception $e) {
            $resultado = 'Excepción capturada: '.  $e->getMessage(). "\n";
        }
    } 
/*===================================================================
    BUSCAR PRODUCTO POR ID DEL PACIENTE
    ====================================================================*/
    static public function mdlGetDatosPeriodos($id){

        $stmt = Conexion::conectar()->prepare("SELECT e.id_Periodos, p.nombre,
         p.sexo, p.fecha_nacimiento, p.edad, p.direccion, p.estado_civil, 
         p.escolaridad, p.id_ocupacion, p.comorbilidad, p.estatus, 
         p.fecha_creacion FROM tblPeriodos e INNER JOIN tblpacientes p 
         on p.id = e.id_Periodos inner join tblrepresentantes r on r.id = e.id_paciente
         WHERE e.id_Periodos = :id_Periodos");
        
        $stmt -> bindParam(":id",$id,PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }



    static public function mdlActualizarInformacion($table, $data,$id,$nameId0, $id_expediente, $nameId,$id_clinica,$nameId2){

        $set = "";

        foreach ($data as $key => $value) {
            
            $set .= $key." = :".$key.",";
                
        }

        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE $nameId0 = :$nameId0 and $nameId = :$nameId and $nameId2 =:$nameId2");

        foreach ($data as $key => $value) {
            
            $stmt->bindParam(":".$key, $data[$key], PDO::PARAM_STR);
            
        }		
        $stmt->bindParam(":".$nameId0, $id, PDO::PARAM_INT);
        $stmt->bindParam(":".$nameId, $id_expediente, PDO::PARAM_INT);
        $stmt->bindParam(":".$nameId2, $id_clinica, PDO::PARAM_INT);

        if($stmt->execute()){

            return "ok";

        }else{

            return Conexion::conectar()->errorInfo();
        
        }
    }

    /*=============================================
    Peticion DELETE para eliminar datos
    =============================================*/

    static public function mdlEliminarInformacion($table, $id, $nameId,$id_clinica,$nameId2){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $table WHERE $nameId = :$nameId and $nameId2= :$nameId2");

        $stmt -> bindParam(":".$nameId, $id, PDO::PARAM_INT);
        $stmt -> bindParam(":".$nameId2, $id_clinica, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";;
        
        }else{

            return Conexion::conectar()->errorInfo();

        }

    }   

    /*===================================================================
    LISTAR NOMBRE DE PACIENTES PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombrePeriodos(){

        $stmt = Conexion::conectar()->prepare("SELECT Concat(id , ' - ' ,c.nombre_categoria,' - ',descripcion_producto, ' - S./ ' , p.precio_venta_producto)  as descripcion_producto
                                                FROM Pacientes p inner join categorias c on p.id_categoria_producto = c.id_categoria");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

    

 

}    