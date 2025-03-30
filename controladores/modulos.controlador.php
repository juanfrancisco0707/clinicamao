<?php

class ModulosControlador{

    static public function ctrListarModulos(){
        
        $modulos = ModulosModelo::mdlListarModulos();

        return $modulos;

    }
    /*
    static public function ctrListarModuloscb(){
        
        $Moduloscb = ModulosModelo::mdlListarModuloscb();

        return $Moduloscb;

    }
    */

    static public function ctrRegistrarModulo($id, $nombre_modulo){
    
        $registroModulo = ModulosModelo::mdlRegistrarModulo($id, $nombre_modulo);
    
        return $registroModulo;
    }
    
   
    
    static public function ctrActualizarModulo($table, $data, $id, $nameId){
        
        $respuesta = ModulosModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
    }
    
    static public function ctrEliminarModulo($table, $id, $nameId)
    {
        $respuesta = ModulosModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    LISTAR NOMBRE DE Modulos PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombreModulos(){
    
        $Modulos = ModulosModelo::mdlListarNombreModulos();
    
        return $Modulos;
    }
    
}
