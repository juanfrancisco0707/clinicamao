<?php

class ingresosDetallesControlador{

    static public function ctrListarpagosDetalles(){
        
        $pagosDetalles = ingresosDetallesModelo::mdlListarIngresosDetalles();

        return $pagosDetalles;

    }
    static public function ctrListarpagosDetallesCb(){

        $pagosDetallesCb = ingresosDetallesModelo::mdlListarIngresosDetallesCb();
    
        return $pagosDetallesCb;
    
    }
    static public function ctrRegistrarIngresosDetalles($id, $folio_detalle,$id_concepto,$cantidad, $precio, $importe){

$registroDetalle = ingresosDetallesModelo::mdlRegistrarIngresos_detalles($id, $folio_detalle,$id_concepto,$cantidad, $precio, $importe);

return $registroDetalle;
}

static public function ctrActualizarStock($table, $data, $id, $nameId){

$respuesta = ingresosDetallesModelo::mdlActualizarInformacion($table, $data, $id, $nameId);

return $respuesta;
}

static public function ctrActualizarIngresosDetalles($table, $data, $id, $nameId){

$respuesta = ingresosDetallesModelo::mdlActualizarInformacion($table, $data, $id, $nameId);

return $respuesta;
}

static public function ctrEliminarIngresosDetalles($table, $id, $nameId)
{
$respuesta = ingresosDetallesModelo::mdlEliminarInformacion($table, $id, $nameId);

return $respuesta;
}

/*===================================================================
LISTAR NOMBRE DE pagosDetalles PARA INPUT DE AUTO COMPLETADO
====================================================================*/
static public function ctrListarNombrepagosDetalles(){

$Concepto = ingresosDetallesModelo::mdlListarNombreIngresosDetalles();

return $Concepto;
}

/*===================================================================
BUSCAR Concepto POR SU CODIGO DE BARRAS
====================================================================*/
static public function ctrGetDatosIngresosDetalles($id){

$Concepto = ingresosDetallesModelo::mdlGetDatosIngresosDetalles($id);

return $Concepto;

}





}