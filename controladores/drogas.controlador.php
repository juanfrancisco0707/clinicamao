<?php

class DrogasControlador{

    static public function ctrListarDrogas(){
        
        $Drogas = DrogasModelo::mdlListarDrogas();

        return $Drogas;

    }
    static public function ctrListarDrogascb(){
        
        $Drogascb = DrogasModelo::mdlListarDrogascb();

        return $Drogascb;

    }

    static public function ctrRegistrarDrogas($id_droga, $nombre_droga){
    
        $registroDrogas = DrogasModelo::mdlRegistrarDroga($id_droga, $nombre_droga);
    
        return $registroDrogas;
    }
    
   
    
    static public function ctrActualizarDrogas($table, $data, $id, $nameId){
        
        $respuesta = DrogasModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
    }
    
    static public function ctrEliminarDrogas($table, $id, $nameId)
    {
        $respuesta = DrogasModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    LISTAR NOMBRE DE Drogas PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombreDrogas(){
    
       // $Drogas = DrogasModelo::mdlListarNombreDrogas();
    
      //  return $Drogas;
    }
    
}