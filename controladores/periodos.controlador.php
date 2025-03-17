<?php

class PeriodosControlador{

    static public function ctrListarPeriodos($id_clinica,$id_expediente){
        
        $Periodos = PeriodosModelo::mdlListarPeriodos($id_clinica,$id_expediente);
        return $Periodos;

    }
    static public function ctrBuscarExpediente($id_clinica,$id_expediente){
        
        $expediente = PeriodosModelo::mdlBuscarExpediente($id_clinica,$id_expediente);
        return $expediente;

    }
    static public function ctrBuscarExpedientePeriodos($id_clinica,$id_expediente){
        
        $expediente = PeriodosModelo::mdlBuscarExpedientePeriodos($id_clinica,$id_expediente);
        return $expediente;

    }
    static public function ctrListarPeriodosCb($id_clinica,$id_expediente){
        
        $Periodos = PeriodosModelo::mdlListarPeriodosCb($id_clinica,$id_expediente);
        return $Periodos;

    }
    static public function ctrListarPeriodosAll($id_clinica){
        
        $Periodos = PeriodosModelo::mdlListarPeriodosAll($id_clinica);
        return $Periodos;

    }
    static public function ctrListarFolioPeriodos($idclinica){
        
        $Periodos = PeriodosModelo::mdlListarFolioPeriodos($idclinica);
    
        return $Periodos;
    
    }
    static public function ctrListarPeriodosadmin(){

    $Periodos = PeriodosModelo::mdlListarPeriodosadmin();

    return $Periodos;
    }
    static public function ctrRegistrarPeriodos($id,$id_expediente,$id_clinica,$fecha_inicial,$fecha_final,$pago,$saldo,$estatus){

    $registroPeriodos = PeriodosModelo::mdlRegistrarPeriodos($id,$id_expediente,$id_clinica,$fecha_inicial,$fecha_final,$pago,$saldo,$estatus);

    return $registroPeriodos;
}



static public function ctrActualizarPeriodos($table, $data,$id,$nameId0, $id_expediente, $nameId,$id_clinica,$nameId2){
    
    $respuesta = PeriodosModelo::mdlActualizarInformacion($table, $data,$id,$nameId0, $id_expediente, $nameId,$id_clinica,$nameId2);
    
    return $respuesta;
}

static public function ctrEliminarPeriodos($table, $id, $nameId,$id_clinica,$nameId2)
{
    $respuesta = PeriodosModelo::mdlEliminarInformacion($table, $id, $nameId,$id_clinica,$nameId2);
    
    return $respuesta;
}

/*===================================================================
LISTAR NOMBRE DE Periodos PARA INPUT DE AUTO COMPLETADO
====================================================================*/
static public function ctrListarNombrePeriodos(){

    $Periodos = PeriodosModelo::mdlListarNombrePeriodos();

    return $Periodos;
}

/*===================================================================
BUSCAR Periodos POR SU id
====================================================================*/
static public function ctrGetDatosPeriodos($codigo_Periodos){
        
    $Periodos = PeriodosModelo::mdlGetDatosPeriodos($codigo_Periodos);

    return $Periodos;

}

}