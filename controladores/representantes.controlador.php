<?php

class RepresentantesControlador{

    static public function ctrListarRepresentantes($id_clinica){
        
        $representantes = RepresentantesModelo::mdlListarRepresentantes($id_clinica);

        return $representantes;

    }
    static public function ctrListarRepresentantesadmin(){

        $representantes = RepresentantesModelo::mdlListarrepresentantesadmin();
    
        return $representantes;
    
    }
    static public function ctrListarFolioRepresentantes($idclinica){
        
        $representantes = RepresentantesModelo::mdlListarFolioRepresentantes($idclinica);

        return $representantes;

    }
    static public function ctrListarRepresentantescb($idclinica){
        
        $representantescb = RepresentantesModelo::mdlListarRepresentantescb($idclinica);

        return $representantescb;

    }

    static public function ctrRegistrarRepresentante($id, $nombre_representante, $parentesco,
    $telefono,$id_clinica, $estatus,$direccion,$edad,$id_ocupacion){
    
        $registroRepresentante = RepresentantesModelo::mdlRegistrarRepresentante($id, $nombre_representante, $parentesco, $telefono,$id_clinica, $estatus,$direccion,$edad,$id_ocupacion);
    
        return $registroRepresentante;
    }
    
   
    
    static public function ctrActualizarRepresentante($table, $data, $id, $id_clinica,$nameId){
        
        $respuesta = RepresentantesModelo::mdlActualizarInformacion($table, $data, $id, $id_clinica, $nameId);
        
        return $respuesta;
    }
    
    static public function ctrEliminarRepresentante($table, $id, $nameId,$id_clinica,$nameId2)
    {
        $respuesta = RepresentantesModelo::mdlEliminarInformacion($table, $id, $nameId,$id_clinica,$nameId2);
        
        return $respuesta;
    }
    
    /*===================================================================
    LISTAR NOMBRE DE REPRESENTANTE PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombreRepresentantes(){
    
        $representante = RepresentantesModelo::mdlListarNombreRepresentantes();
    
        return $representante;
    }
    
    /*===================================================================
    BUSCAR REPRESENTANTE POR SU ID
    ====================================================================
    static public function ctrGetDatosRepresentante($id){
            
        $representante = RepresentanteModelo::mdlGetDatosRepresentante($id);
    
        return $representante;
    
    }
    */
    
    
    

}