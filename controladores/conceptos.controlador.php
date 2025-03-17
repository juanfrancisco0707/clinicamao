<?php

class ConceptosControlador{

    static public function ctrListarConceptos(){
        
        $conceptos = conceptosModelo::mdlListarConceptos();

        return $conceptos;

    }
    static public function ctrListarConceptosCb(){

        $conceptosCb = ConceptosModelo::mdlListarConceptosCb();
    
        return $conceptosCb;
    
    }
    static public function ctrRegistrarConcepto($id, $idescripcion,$tipo){

$registroConcepto = ConceptosModelo::mdlRegistrarConcepto($id, $idescripcion,$tipo);

return $registroConcepto;
}

static public function ctrActualizarStock($table, $data, $id, $nameId){

$respuesta = ConceptosModelo::mdlActualizarInformacion($table, $data, $id, $nameId);

return $respuesta;
}

static public function ctrActualizarConcepto($table, $data, $id, $nameId){

$respuesta = ConceptosModelo::mdlActualizarInformacion($table, $data, $id, $nameId);

return $respuesta;
}

static public function ctrEliminarConcepto($table, $id, $nameId)
{
$respuesta = ConceptosModelo::mdlEliminarInformacion($table, $id, $nameId);

return $respuesta;
}

/*===================================================================
LISTAR NOMBRE DE ConceptoS PARA INPUT DE AUTO COMPLETADO
====================================================================*/
static public function ctrListarNombreConceptos(){

$Concepto = ConceptosModelo::mdlListarNombreConceptos();

return $Concepto;
}

/*===================================================================
BUSCAR Concepto POR SU CODIGO DE BARRAS
====================================================================*/
static public function ctrGetDatosConcepto($id){

$Concepto = ConceptosModelo::mdlGetDatosConcepto($id);

return $Concepto;

}





}