<?php

class EmpresaControlador{

    static public function ctrListarEmpresa(){
        
        $empresa = EmpresaModelo::mdlListarEmpresa();

        return $empresa;

    }
    static public function ctrListarEmpresasCb($idclinica,$idrol){

        $empresasCb = EmpresaModelo::mdlListarEmpresaCb($idclinica,$idrol);
    
        return $empresasCb;
    
    }
    static public function ctrRegistrarEmpresa($id, $nombre, $direccion, $telefono, $representante_legal,$cedula_legal){

    $registroEmpresa = EmpresaModelo::mdlRegistrarEmpresa($id, $nombre, $direccion, $telefono, $representante_legal,$cedula_legal);

    return $registroEmpresa;
}

static public function ctrActualizarEmpresa($table, $data, $id, $nameId){
    
    $respuesta = EmpresaModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
    
    return $respuesta;
}

static public function ctrEliminarEmpresa($table, $id, $nameId)
{
    $respuesta = EmpresaModelo::mdlEliminarInformacion($table, $id, $nameId);
    
    return $respuesta;
}

/*===================================================================
LISTAR NOMBRE DE Empresa PARA INPUT DE AUTO COMPLETADO
====================================================================*/
static public function ctrListarNombreEmpresa(){

    $paciente = EmpresaModelo::mdlListarNombreEmpresa();

    return $paciente;
}

/*===================================================================
BUSCAR EMPRESA POR SU id
====================================================================*/
static public function ctrGetDatosEmpresa($id){
        
    $empresa = EmpresaModelo::mdlGetDatosEmpresa($id);

    return $empresa;

}

}