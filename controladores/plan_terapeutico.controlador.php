<?php

class PlanTerapeuticoControlador{

    static public function ctrListarPlanTerapeutico(){
        
        $Plan_Terapeutico = PlanTerapeuticoModelo::mdlListarPlanTerapeutico();

        return $Plan_Terapeutico;

    }
    static public function ctrListarPlanTerapeuticocb(){
        
        $Plan_Terapeuticocb = PlanTerapeuticoModelo::mdlListarPlanTerapeuticocb();

        return $Plan_Terapeuticocb;

    }

    static public function ctrRegistrarPlanTerapeutico($id_droga, $nombre_droga){
    
        $registroPlan_Terapeutico = PlanTerapeuticoModelo::mdlRegistrarDroga($id_droga, $nombre_droga);
    
        return $registroPlan_Terapeutico;
    }
    
   
    
    static public function ctrActualizarPlanTerapeutico($table, $data, $id, $nameId){
        
        $respuesta = PlanTerapeuticoModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
    }
    
    static public function ctrEliminarPlanTerapeutico($table, $id, $nameId)
    {
        $respuesta = PlanTerapeuticoModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    LISTAR NOMBRE DE Plan_Terapeutico PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombrePlanTerapeutico(){
    
       // $Plan_Terapeutico = Plan_TerapeuticoModelo::mdlListarNombrePlan_Terapeutico();
    
      //  return $Plan_Terapeutico;
    }
    
}