<?php

class EstadosCitasControlador{

    /*===================================================================
    OBTENER LISTADO TOTAL DE Estados de Citas
    ====================================================================*/
    static public function ctrListarEstadosCitas(){
        
        $EstadosCitas = EstadosCitasModelo::mdlListarEstadosCitas();

        return $EstadosCitas;

    }

    /*==================================================================
    REGISTRAR Estado de Cita
    ====================================================================*/
    static public function ctrRegistrarEstadoCita($id_estado, $nombre_estado){
    
        $registroEstadoCita = EstadosCitasModelo::mdlRegistrarEstadoCita($id_estado, $nombre_estado);
    
        return $registroEstadoCita;
    }
    
    /*===================================================================
    ACTUALIZAR Estado de Cita
    ====================================================================*/
    static public function ctrActualizarEstadoCita($table, $data, $id, $nameId){
        
        $respuesta = EstadosCitasModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    ELIMINAR Estado de Cita
    ====================================================================*/
    static public function ctrEliminarEstadoCita($table, $id, $nameId)
    {
        $respuesta = EstadosCitasModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    LISTAR NOMBRE DE Estados de Citas PARA INPUT DE AUTO COMPLETADO
    =====================================================================*/
    static public function ctrListarNombreEstadosCitas(){
    
        $EstadosCitas = EstadosCitasModelo::mdlListarNombreEstadosCitas();
    
        return $EstadosCitas;
    }
    
}
