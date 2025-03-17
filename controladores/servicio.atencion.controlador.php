<?php

class ServicioAtencionControlador{

    static public function ctrListarServicioAtencion($id_clinica){
        
        $ServicioAtencion = ServicioAtencionModelo::mdlListarServicioAtencion($id_clinica);
        return $ServicioAtencion;

    }
    static public function ctrBuscarServicioAtencion($id_clinica,$id_expediente){
        
        $ServicioAtencion = ServicioAtencionModelo::mdlBuscarServicioAtencion($id_clinica,$id_expediente);
        return $ServicioAtencion;

    }
    static public function ctrBuscarServicioAtencionXe($id_clinica,$id_expediente){
        
        $ServicioAtencion = ServicioAtencionModelo:: mdlBuscarServicioAtencionX($id_clinica,$id_expediente);
        return $ServicioAtencion;

    }
    static public function ctrContarServicioAtencion($id_clinica,$id_paciente){
        
        $ServicioAtencion = ServicioAtencionModelo::mdlContarServicioAtencion($id_clinica,$id_paciente);
        return $ServicioAtencion;

    }
    static public function ctrVistasServicioAtencion($id_clinica,$id_expediente){
        
        $ServicioAtencion = ServicioAtencionModelo::mdlVistasServicioAtencion($id_clinica,$id_expediente);
        return $ServicioAtencion;

    }
    static public function ctrBuscarExpedienteXcliente($id_paciente,$id_clinica){
        
        $ServicioAtencion = ServicioAtencionModelo::mdlBuscarExpedienteXcliente($id_paciente,$id_clinica);
        return $ServicioAtencion;

    }

    static public function ctrListarFolioServicioAtencion($idclinica){
        
        $ServicioAtencion = ServicioAtencionModelo::mdlListarFolioServicioAtencion($idclinica);
    
        return $ServicioAtencion;
    
    }
    static public function ctrListarServicioAtencionadmin(){

    $ServicioAtencion = ServicioAtencionModelo::mdlListarServicioAtencionadmin();

    return $ServicioAtencion;
    }
    static public function ctrRegistrarServicioAtencion($id_expediente,$id_clinica,$motivo_atencion,
    $reporte_lesion,$diagnostico,$plan_terapeutico,$pronostico,$cedula_medico, $duracion_consulta,$nombre_medico,
    $fecha_notificacion,$agencia_mp,$domicilio_agencia){

    $registroExpediente = ServicioAtencionModelo::mdlRegistrarservicioAtencion($id_expediente,$id_clinica,$motivo_atencion,
    $reporte_lesion,$diagnostico,$plan_terapeutico,$pronostico,$cedula_medico, $duracion_consulta,$nombre_medico,
    $fecha_notificacion,$agencia_mp,$domicilio_agencia);

    return $registroExpediente;
}

static public function ctrActualizarStock($table, $data, $id, $nameId){
    
    $respuesta = ServicioAtencionModelo::mdlActualizarInformacion($table, $data, $id, $nameId,1,2);
    
    return $respuesta;
}

static public function ctrActualizarExpediente($table, $data, $id, $nameId,$id_clinica,$nameId2){
    
    $respuesta = ServicioAtencionModelo::mdlActualizarInformacion($table, $data, $id, $nameId,$id_clinica,$nameId2);
    
    return $respuesta;
}

static public function ctrEliminarExpediente($table, $id, $nameId,$id_clinica,$nameId2)
{
    $respuesta = ServicioAtencionModelo::mdlEliminarInformacion($table, $id, $nameId,$id_clinica,$nameId2);
    
    return $respuesta;
}

/*===================================================================
LISTAR NOMBRE DE ServicioAtencion PARA INPUT DE AUTO COMPLETADO
====================================================================*/
static public function ctrListarNombreServicioAtencion(){

    $Expediente = ServicioAtencionModelo::mdlListarNombreServicioAtencion();

    return $Expediente;
}

/*===================================================================
BUSCAR Expediente POR SU id
====================================================================*/
static public function ctrGetDatosExpediente($codigo_Expediente){
        
    $Expediente = ServicioAtencionModelo::mdlGetDatosExpediente($codigo_Expediente);

    return $Expediente;

}

}