<?php

require_once "conexion.php";

class ServicioAtencionModelo{

static public function mdlListarServicioAtencion($id_clinica){

    $stmt = Conexion::conectar()->prepare("SELECT '' as detalles, 
    e.id_expediente,
    e.id_clinica,
    e.id_paciente,
    p.NOMBRE, 
    e.id_representante,
    left(r.nombre_representante,20),
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
     e.tipo_ingreso,
     e.refiere_institucion,
     e.motivo_ingreso,
     e.folio_mp,
     e.operador_mp,
     e.descripcion_salud,
     e.id_droga,
     d.nombre_droga,
     e.medicamentos,
     e.terapia_individual,
     e.terapia_ocupacional,
     '' as acciones
    FROM tblServicioAtencion e INNER JOIN tblpacientes p on (e.id_paciente = p.id  and e.id_clinica  = p.id_empresa)
     inner join tblrepresentantes r on (e.id_representante = r.id and e.id_clinica = r.id_clinica )
     inner join tbldrogas d on e.id_droga = d.id_droga
      where e.id_clinica=:id_clinica
     order by e.id_expediente desc");
      $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);   
       // $stmt = Conexion::conectar()->prepare('call prc_ListarServicioAtencion');

        $stmt -> execute();
      
        return $stmt->fetchAll();
    }
    // buscar expediente para el reporte de hoja de ingreso
    static public function mdlBuscarServicioAtencion($id_clinica,$id_expediente){

        $stmt = Conexion::conectar()->prepare("SELECT 
        s.id_expediente,
        s.id_clinica,
        s.motivo_atencion,
        p.nombre_paciente, 
        s.reporte_lesion,
        s.diagnostico,
        s.plan_terapeutico,
        s.pronostico,
        s.cedula_medico,
        s.duracion_consulta,
        s.nombre_medico,
        s.fecha_notificacion,
        s.agencia.mp,
        s.domicilio_agencia
      
        FROM tblServicios_Atencion s INNER JOIN vta_pacientes_expedientes_empresa p on (s.id_expediente = p.id  and s.id_clinica  = p.id_empresa)
        
         where s.id_clinica=:id_clinica and p.id_expediente = :id_expediente
         order by s.id_clinica,p.id_expediente desc");
          $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);   
          $stmt -> bindParam(":id_expediente", $id_expediente , PDO::PARAM_STR);   
            $stmt -> execute();
          
            return $stmt->fetchAll();
        }

            // buscar expediente para el reporte de hoja de ingreso
    static public function mdlContarServicioAtencion($id_clinica,$id_paciente){

        $stmt = Conexion::conectar()->prepare("SELECT count(*) as numingprevios from tblServicioAtencion where id_clinica=:id_clinica and id_paciente = :id_paciente" );
          $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);   
          $stmt -> bindParam(":id_paciente", $id_paciente , PDO::PARAM_STR);   
            $stmt -> execute();
            return $stmt->fetchAll();
        }
         // buscar expediente para el reporte de hoja de ingreso
        static public function mdlVistasServicioAtencion($id_clinica,$id_expediente){

            $stmt = Conexion::conectar()->prepare("SELECT * from vta_hoja_ingreso where id_clinica=:id_clinica and id_expediente = :id_expediente" );
              $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);   
              $stmt -> bindParam(":id_expediente", $id_expediente , PDO::PARAM_STR);   
                $stmt -> execute();
                return $stmt->fetchAll();
            }

        static public function mdlBuscarExpedienteXcliente($id_paciente,$id_clinica){

                $stmt = Conexion::conectar()->prepare("SELECT * from tblServicioAtencion 
                where id_clinica=:id_clinica and id_paciente = :id_paciente and estatus ='Activo' " );
                  $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);   
                  $stmt -> bindParam(":id_paciente", $id_paciente , PDO::PARAM_STR);   
                    $stmt -> execute();
                    $count = $stmt->rowCount();
                    if($count > 0){ 
                        return "ok";
                    }
                     else {
                        return "no";
                }
                  //  return $stmt->fetchAll();
                }
                static public function mdlBuscarServicioAtencionX($id_clinica,$id_expediente){

                    $stmt = Conexion::conectar()->prepare("SELECT * from tblServicios_atencion 
                    where id_clinica=:id_clinica and id_expediente = :id_expediente" );
                      $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);   
                      $stmt -> bindParam(":id_expediente", $id_expediente , PDO::PARAM_STR);   
                        $stmt -> execute();
                       // $count = $stmt->rowCount();
                       // if($count > 0){ 
                       //     return "ok";
                       // }
                       //  else {
                       //     return "no";
                   // }
                        return $stmt->fetchAll();
                    }

    static public function mdlListarServicioAtencionEmpresa($id_clinica){

            $stmt = Conexion::conectar()->prepare("SELECT '' as detalles, 
            e.id_expediente,
            e.id_clinica,
            e.id_paciente,
            p.NOMBRE, 
            e.id_representante,
            left(r.nombre_representante,20),
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
            em.direccion
             '' as acciones
            FROM tblServicioAtencion e INNER JOIN tblpacientes p on (e.id_paciente = p.id  and e.id_clinica  = p.id_empresa)
             inner join tblrepresentantes r on (e.id_representante = r.id and e.id_clinica = r.id_clinica )
             inner join tblempresa em on e.id_clinica = em.id  
              where e.id_clinica=:id_clinica
             order by e.id_expediente desc");
              $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);   
               // $stmt = Conexion::conectar()->prepare('call prc_ListarServicioAtencion');
        
                $stmt -> execute();
              
                return $stmt->fetchAll();
            }
            


    /*===================================================================
    OBTENER LISTADO TOTAL DE ServicioAtencion PARA EL DATATABLE para el administrador
    ====================================================================*/
    static public function mdlListarServicioAtencionadmin(){
    
    //     $stmt = Conexion::conectar()->prepare('call prc_ListarServicioAtencion');
        $stmt = Conexion::conectar()->prepare("SELECT '' as detalles, 
            e.id_expediente,
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
            e.tipo_ingreso,
            e.refiere_institucion,
            e.motivo_ingreso,
            e.folio_mp,
            e.operador,
            e.descripcion_salud, 
            '' as acciones
     FROM tblServicioAtencion e INNER JOIN tblpacientes p on (e.id_paciente = p.id  and e.id_clinica  = p.id_empresa)
     inner join tblrepresentantes r on (e.id_representante = r.id and e.id_clinica = r.id_clinica )
     order by e.id_expediente desc");
    
         $stmt->execute();
     
         return $stmt->fetchAll();
     }
 
 /*===================================================================
    FOLIO DE ServicioAtencion POR SUCURSAL
    ====================================================================*/

    static public function mdlListarFolioServicioAtencion($idclinica){
        $stmt = Conexion::conectar()->prepare("
        select max(id_expediente) + 1  as folio
        from tblServicioAtencion p where p.id_clinica=:idclinica
        ");
        $stmt -> bindParam(":idclinica",$idclinica,PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
       
     }

 /*===================================================================
    REGISTRAR ServicioAtencion UNO A UNO DESDE EL FORMULARIO DE ServicioAtencion
    ====================================================================*/
    static public function mdlRegistrarServicioAtencion($id_expediente,$id_clinica,$motivo_atencion, $reporte_lesion,
                                                $diagnostico,$plan_terapeutico,$pronostico,$cedula_medico,
                                                $duracion_consulta,$nombre_medico,$fecha_notificacion,$agencia_mp,$domicilio_agencia){        

        try{

            $fecha = date('Y-m-d');

            $stmt = Conexion::conectar()->prepare("INSERT INTO tblservicios_atencion(
                                                                       id_expediente,
                                                                       id_clinica,
                                                                       motivo_atencion,
                                                                       reporte_lesion,
                                                                       diagnostico,
                                                                       plan_terapeutico,
                                                                       pronostico,
                                                                       cedula_medico,
                                                                       duracion_consulta,
                                                                       nombre_medico,
                                                                       fecha_notificacion,
                                                                       agencia_mp,
                                                                       domicilio_agencia
                                                                       ) 
                                                VALUES (:id_expediente,
                                                                      :id_clinica,
                                                                       :motivo_atencion,
                                                                       :reporte_lesion,
                                                                       :diagnostico,
                                                                       :plan_terapeutico,
                                                                       :pronostico,
                                                                       :cedula_medico,
                                                                       :duracion_consulta,
                                                                       :nombre_medico,
                                                                       :fecha_notificacion,
                                                                       :agencia_mp,
                                                                       :domicilio_agencia
                                                        )");      
            $stmt -> bindParam(":id_expediente", $id_expediente , PDO::PARAM_STR);
            $stmt -> bindParam(":id_clinica", $id_clinica , PDO::PARAM_STR);
            $stmt -> bindParam(":motivo_atencion", $motivo_atencion , PDO::PARAM_STR);           
            $stmt -> bindParam(":reporte_lesion", $reporte_lesion, PDO::PARAM_STR);
            $stmt -> bindParam(":diagnostico", $diagnostico , PDO::PARAM_STR);
            $stmt -> bindParam(":plan_terapeutico", $plan_terapeutico , PDO::PARAM_STR);
            $stmt -> bindParam(":pronostico", $pronostico , PDO::PARAM_STR);
            $stmt -> bindParam(":cedula_medico", $cedula_medico , PDO::PARAM_STR);
            $stmt -> bindParam(":duracion_consulta", $duracion_consulta , PDO::PARAM_STR);                                                    
            $stmt -> bindParam(":nombre_medico", $nombre_medico, PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_notificacion", $fecha_notificacion , PDO::PARAM_STR);
            $stmt -> bindParam(":agencia_mp", $agencia_mp, PDO::PARAM_STR);
            $stmt -> bindParam(":domicilio_agencia", $domicilio_agencia , PDO::PARAM_STR);
          
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
    BUSCAR EXPEDIENTE POR ID DEL PACIENTE
    ====================================================================*/
    static public function mdlGetDatosExpediente($id){

        $stmt = Conexion::conectar()->prepare("SELECT e.id_expediente, p.nombre,
         p.sexo, p.fecha_nacimiento, p.edad, p.direccion, p.estado_civil, 
         p.escolaridad, p.id_ocupacion, p.comorbilidad, p.estatus, 
         p.fecha_creacion FROM tblServicioAtencion e INNER JOIN tblpacientes p 
         on p.id = e.id_expediente inner join tblrepresentantes r on r.id = e.id_paciente
         WHERE e.id_expediente = :id_expediente");
        
        $stmt -> bindParam(":id",$id,PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }



    static public function mdlActualizarInformacion($table, $data, $id, $nameId,$id_clinica,$nameId2){

        $set = "";

        foreach ($data as $key => $value) {
            
            $set .= $key." = :".$key.",";
                
        }

        $set = substr($set, 0, -1);

        $stmt = Conexion::conectar()->prepare("UPDATE $table SET $set WHERE $nameId = :$nameId and $nameId2 =:$nameId2");

        foreach ($data as $key => $value) {
            
            $stmt->bindParam(":".$key, $data[$key], PDO::PARAM_STR);
            
        }		

        $stmt->bindParam(":".$nameId, $id, PDO::PARAM_INT);
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
    static public function mdlListarNombreServicioAtencion(){

        $stmt = Conexion::conectar()->prepare("SELECT Concat(id , ' - ' ,c.nombre_categoria,' - ',descripcion_producto, ' - S./ ' , p.precio_venta_producto)  as descripcion_producto
                                                FROM Pacientes p inner join categorias c on p.id_categoria_producto = c.id_categoria");

        $stmt -> execute();

        return $stmt->fetchAll();
    }

    

 

}    