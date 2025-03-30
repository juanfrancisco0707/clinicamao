<?php
class EspecialistasControlador
{
    /*===================================================================
    LISTAR ESPECIALISTAS
    ====================================================================*/
    static public function ctrListarEspecialistas()
    {
        $especialistas = EspecialistasModelo::mdlListarEspecialistas();
        return $especialistas;
    }

    /*===================================================================
    LISTAR ESPECIALISTAS PARA COMBOBOX
    ====================================================================*/
    static public function ctrListarEspecialistasCb()
    {
        $especialistasCb = EspecialistasModelo::mdlListarEspecialistasCb();
        return $especialistasCb;
    }

    /*===================================================================
    REGISTRAR ESPECIALISTA
    ====================================================================*/
    static public function ctrRegistrarEspecialista($data)
    {
        $registroEspecialista = EspecialistasModelo::mdlRegistrarEspecialista($data);
        return $registroEspecialista;
    }

    /*===================================================================
    ACTUALIZAR ESPECIALISTA
    ====================================================================*/
    static public function ctrActualizarEspecialista($table, $data, $id, $nameId)
    {
        $respuesta = EspecialistasModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        return $respuesta;
    }

    /*===================================================================
    ELIMINAR ESPECIALISTA
    ====================================================================*/
    static public function ctrEliminarEspecialista($table, $id, $nameId)
    {
        $respuesta = EspecialistasModelo::mdlEliminarInformacion($table, $id, $nameId);
        return $respuesta;
    }

    /*===================================================================
    LISTAR NOMBRES DE ESPECIALISTAS PARA AUTOCOMPLETADO
    ====================================================================*/
    static public function ctrListarNombreEspecialistas()
    {
        $especialistas = EspecialistasModelo::mdlListarNombreEspecialistas();
        return $especialistas;
    }

    /*===================================================================
    OBTENER UN ESPECIALISTA POR ID
    ====================================================================*/
    static public function ctrObtenerEspecialista($id)
    {
        $especialista = EspecialistasModelo::mdlObtenerEspecialista($id);
        return $especialista;
    }
}
