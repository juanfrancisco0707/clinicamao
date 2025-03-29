<?php

class ServicioControlador{

    /*===================================================================
    OBTENER LISTADO TOTAL DE Servicios
    ====================================================================*/
    static public function ctrListarServicios(){
        
        $servicios = ServicioModelo::mdlListarServicios();

        return $servicios;

    }

    /*===================================================================
    REGISTRAR Servicio
    ====================================================================*/
    static public function ctrRegistrarServicio($id_servicio, $nombre_servicio, $descripcion, $precio){
    
        $registroServicio = ServicioModelo::mdlRegistrarServicio($id_servicio, $nombre_servicio, $descripcion, $precio);
    
        return $registroServicio;
    }
    
    /*===================================================================
    ACTUALIZAR Servicio
    ====================================================================*/
    static public function ctrActualizarServicio($table, $data, $id, $nameId){
        
        $respuesta = ServicioModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    ELIMINAR Servicio
    ====================================================================*/
    static public function ctrEliminarServicio($table, $id, $nameId)
    {
        $respuesta = ServicioModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    LISTAR NOMBRE DE Servicios PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombreServicios(){
    
        $servicios = ServicioModelo::mdlListarNombreServicios();
    
        return $servicios;
    }
    
    /*===================================================================
    OBTENER UN SERVICIO POR ID
    ====================================================================*/
    static public function ctrObtenerServicioPorId($id_servicio){
        $servicio = ServicioModelo::mdlObtenerServicioPorId($id_servicio);
        return $servicio;
    }
}
