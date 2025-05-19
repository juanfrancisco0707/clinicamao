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
    static public function ctrActualizarEspecialista($data)
    // Cambiamos la firma para que solo reciba $data, ya que el modelo extraerá los IDs
    {
        $respuesta = EspecialistasModelo::mdlActualizarEspecialista($data); // Llamar al nuevo método
        return $respuesta; // El modelo ya retorna "ok" o el errorInfo
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
    ALTA ESPECIALISTA
    ====================================================================*/
    static public function ctrAltaEspecialista($table, $id, $nameId)
    {
        $respuesta = EspecialistasModelo::mdlAltaInformacion($table, $id, $nameId);
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
