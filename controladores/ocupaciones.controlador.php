<?php

class OcupacionesControlador{

    static public function ctrListarOcupaciones(){
        
        $ocupaciones = OcupacionesModelo::mdlListarOcupaciones();

        return $ocupaciones;

    }
    static public function ctrListarOcupacionescb(){
        
        $Ocupacionescb = OcupacionesModelo::mdlListarOcupacionescb();

        return $Ocupacionescb;

    }

    static public function ctrRegistrarOcupacion($id, $nombre_Ocupacion){
    
        $registroOcupacion = OcupacionesModelo::mdlRegistrarOcupacion($id, $nombre_Ocupacion);
    
        return $registroOcupacion;
    }
    
   
    
    static public function ctrActualizarOcupacion($table, $data, $id, $nameId){
        
        $respuesta = OcupacionesModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
    }
    
    static public function ctrEliminarOcupacion($table, $id, $nameId)
    {
        $respuesta = OcupacionesModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    LISTAR NOMBRE DE Ocupacion PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombreOcupaciones(){
    
       // $Ocupacion = OcupacionesModelo::mdlListarNombreOcupaciones();
    
      //  return $Ocupacion;
    }
    
}