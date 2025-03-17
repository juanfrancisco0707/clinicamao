<?php

class ExpedientesControlador{

    static public function ctrListarExpedientes($id_clinica){
        
        $expedientes = expedientesModelo::mdlListarExpedientes($id_clinica);
        return $expedientes;

    }
    static public function ctrBuscarExpedientes($id_clinica,$id_expediente){
        
        $expedientes = expedientesModelo::mdlBuscarExpedientes($id_clinica,$id_expediente);
        return $expedientes;

    }
   
    static public function ctrContarExpedientes($id_clinica,$id_paciente){
        
        $expedientes = expedientesModelo::mdlContarExpedientes($id_clinica,$id_paciente);
        return $expedientes;

    }
    static public function ctrVistasExpedientes($id_clinica,$id_expediente){
        
        $expedientes = expedientesModelo::mdlVistasExpedientes($id_clinica,$id_expediente);
        return $expedientes;

    }
    static public function ctrBuscarExpedienteXcliente($id_paciente,$id_clinica){
        
        $expedientes = expedientesModelo::mdlBuscarExpedienteXcliente($id_paciente,$id_clinica);
        return $expedientes;

    }

    static public function ctrListarFolioExpedientes($idclinica){
        
        $expedientes = ExpedientesModelo::mdlListarFolioExpedientes($idclinica);
    
        return $expedientes;
    
    }
    static public function ctrListarExpedientesadmin(){

    $expedientes = ExpedientesModelo::mdlListarExpedientesadmin();

    return $expedientes;
    }
    static public function ctrRegistrarExpediente($id_expediente,$id_clinica, $id_paciente, $id_representante, $fecha_ingreso, $fecha_salida,
    $firmo_contrato, $tiempo_duracion, $hora_ingreso,$cuota_ingreso,$extra,
$cuota_semanal,$testigo, $estatus,$tipo_ingreso,$refiere_institucion,$motivo_inghreso,$folio_mp,$operador_mp,$descripcion_salud,
$id_droga,$medicamento,$terapia_individual,$terapia_ocupacional){

    $registroExpediente = ExpedientesModelo::mdlRegistrarExpediente($id_expediente,$id_clinica, $id_paciente, $id_representante, $fecha_ingreso, $fecha_salida,
    $firmo_contrato, $tiempo_duracion, $hora_ingreso,$cuota_ingreso,$extra,
$cuota_semanal,$testigo, $estatus,$tipo_ingreso,$refiere_institucion,$motivo_inghreso,
$folio_mp,$operador_mp,$descripcion_salud,$id_droga,$medicamento,$terapia_individual,$terapia_ocupacional);

    return $registroExpediente;
}

static public function ctrActualizarStock($table, $data, $id, $nameId){
    
    $respuesta = ExpedientesModelo::mdlActualizarInformacion($table, $data, $id, $nameId,1,2);
    
    return $respuesta;
}

static public function ctrActualizarExpediente($table, $data, $id, $nameId,$id_clinica,$nameId2){
    
    $respuesta = ExpedientesModelo::mdlActualizarInformacion($table, $data, $id, $nameId,$id_clinica,$nameId2);
    
    return $respuesta;
}

static public function ctrEliminarExpediente($table, $id, $nameId,$id_clinica,$nameId2)
{
    $respuesta = ExpedientesModelo::mdlEliminarInformacion($table, $id, $nameId,$id_clinica,$nameId2);
    
    return $respuesta;
}

/*===================================================================
LISTAR NOMBRE DE Expedientes PARA INPUT DE AUTO COMPLETADO
====================================================================*/
static public function ctrListarNombreExpedientes(){

    $Expediente = ExpedientesModelo::mdlListarNombreExpedientes();

    return $Expediente;
}

/*===================================================================
BUSCAR Expediente POR SU id
====================================================================*/
static public function ctrGetDatosExpediente($codigo_Expediente){
        
    $Expediente = ExpedientesModelo::mdlGetDatosExpediente($codigo_Expediente);

    return $Expediente;

}

}