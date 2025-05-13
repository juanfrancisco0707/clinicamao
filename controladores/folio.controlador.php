<?php

class FoliosControlador{

    static public function ctrListarFolios(){
        
        $Folios = FoliosModelo::mdlListarFolios();

        return $Folios;

    }
    static public function ctrListarFolioEntidad($entidad, $id_empresa){

        return FoliosModelo::mdlListarFolioEntidad($entidad, $id_empresa);
    
    }
    static public function ctrListarFolioscb(){
        
        $Folioscb = FoliosModelo::mdlListarFolioscb();

        return $Folioscb;

    }

    static public function ctrRegistrarFolios($id_droga, $nombre_droga){
    
        $registroFolios = FoliosModelo::mdlRegistrarDroga($id_droga, $nombre_droga);
    
        return $registroFolios;
    }
    
   
    
    static public function ctrActualizarFolios($table, $data, $id, $nameId){
        
        $respuesta = FoliosModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
    }
    
    static public function ctrEliminarFolios($table, $id, $nameId)
    {
        $respuesta = FoliosModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    LISTAR NOMBRE DE Folios PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombreFolios(){
    
       // $Folios = FoliosModelo::mdlListarNombreFolios();
    
      //  return $Folios;
    }
    
}