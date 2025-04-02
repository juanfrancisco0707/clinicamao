<?php

class HorariosControlador
{

    /*===================================================================
    OBTENER LISTADO TOTAL DE HORARIOS
    ====================================================================*/
    static public function ctrListarHorarios()
    {
        $horarios = HorariosModelo::mdlListarHorarios();
        return $horarios;
    }

    /*===================================================================
    REGISTRAR HORARIO
    ====================================================================*/
    static public function ctrRegistrarHorario($id_fisioterapeuta, $dia_semana, $hora_inicio, $hora_fin)
    {
        $registroHorario = HorariosModelo::mdlRegistrarHorario($id_fisioterapeuta, $dia_semana, $hora_inicio, $hora_fin);
        return $registroHorario;
    }

    /*===================================================================
    OBTENER LISTADO DE HORARIOS POR FISIOTERAPEUTA PARA EL COMBOBOX
    ====================================================================*/
    static public function ctrListarHorariosPorFisioterapeuta($id_fisioterapeuta)
    {
        $horarios = HorariosModelo::mdlListarHorariosPorFisioterapeuta($id_fisioterapeuta);
        return $horarios;
    }

    /*===================================================================
    ACTUALIZAR HORARIO
    ====================================================================*/
    static public function ctrActualizarHorario($table, $data, $id, $nameId)
    {
        $respuesta = HorariosModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        return $respuesta;
    }

    /*===================================================================
    ELIMINAR HORARIO
    ====================================================================*/
    static public function ctrEliminarHorario($table, $id, $nameId)
    {
        $respuesta = HorariosModelo::mdlEliminarInformacion($table, $id, $nameId);
        return $respuesta;
    }

    /*===================================================================
    LISTAR NOMBRES DE HORARIOS PARA AUTOCOMPLETADO
    ====================================================================*/
    static public function ctrListarNombreHorarios()
    {
        $horarios = HorariosModelo::mdlListarNombreHorarios();
        return $horarios;
    }
    /*===================================================================
    OBTENER UN HORARIO POR ID
    ====================================================================*/
    static public function ctrObtenerHorarioPorId($id_horario){
        $horario = HorariosModelo::mdlObtenerHorarioPorId($id_horario);
        return $horario;
    }
}
