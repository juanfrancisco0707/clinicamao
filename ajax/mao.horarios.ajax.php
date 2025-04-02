<?php
session_start();
if (!isset($_SESSION['S_IDUSUARIO'])) {
    header('Location: ../Login/index.php');
}

require_once "../controladores/mao.horarios.controlador.php";
require_once "../modelos/mao.horarios.modelo.php";

class AjaxHorarios
{
    public $id_fisioterapeuta;
    public $dia_semana;
    public $hora_inicio;
    public $hora_fin;
    public $id_horario;

    /*===================================================================
    LISTAR HORARIOS
    ====================================================================*/
    public function ajaxListarHorarios()
    {
        $horarios = HorariosControlador::ctrListarHorarios();
        echo json_encode($horarios, JSON_UNESCAPED_UNICODE);
    }

    /*===================================================================
    REGISTRAR HORARIO
    ====================================================================*/
    public function ajaxRegistrarHorario()
    {
        $registroHorario = HorariosControlador::ctrRegistrarHorario($this->id_fisioterapeuta, $this->dia_semana, $this->hora_inicio, $this->hora_fin);
        echo json_encode($registroHorario);
    }

    /*===================================================================
    OBTENER LISTADO DE HORARIOS POR FISIOTERAPEUTA PARA EL COMBOBOX
    ====================================================================*/
    public function ajaxListarHorariosPorFisioterapeuta()
    {
        $horarios = HorariosControlador::ctrListarHorariosPorFisioterapeuta($this->id_fisioterapeuta);
        echo json_encode($horarios, JSON_UNESCAPED_UNICODE);
    }

    /*===================================================================
    ACTUALIZAR HORARIO
    ====================================================================*/
    public function ajaxActualizarHorario($data)
    {
        $table = "tblmao_horarios";
        $id = $_POST["id_horario"];
        $nameId = "id_horario";

        $respuesta = HorariosControlador::ctrActualizarHorario($table, $data, $id, $nameId);
        echo json_encode($respuesta);
    }

    /*===================================================================
    ELIMINAR HORARIO
    ====================================================================*/
    public function ajaxEliminarHorario()
    {
        $table = "tblmao_horarios";
        $id = $_POST["id_horario"];
        $nameId = "id_horario";

        $respuesta = HorariosControlador::ctrEliminarHorario($table, $id, $nameId);
        echo json_encode($respuesta);
    }

    /*===================================================================
    OBTENER UN HORARIO POR ID
    ====================================================================*/
    public function ajaxObtenerHorarioPorId(){
        $horario = HorariosControlador::ctrObtenerHorarioPorId($this->id_horario);
        echo json_encode($horario, JSON_UNESCAPED_UNICODE);
    }
}

/*=============================================
ACCIONES
=============================================*/
if (isset($_POST['accion']) && $_POST['accion'] == 1) { // parametro para listar horarios
    $horarios = new AjaxHorarios();
    $horarios->ajaxListarHorarios();
} else if (isset($_POST['accion']) && $_POST['accion'] == 2) { // parametro para registrar horario
    $registrarHorario = new AjaxHorarios();
    $registrarHorario->id_fisioterapeuta = $_POST["id_fisioterapeuta"];
    $registrarHorario->dia_semana = $_POST["dia_semana"];
    $registrarHorario->hora_inicio = $_POST["hora_inicio"];
    $registrarHorario->hora_fin = $_POST["hora_fin"];

    $registrarHorario->ajaxRegistrarHorario();
} else if (isset($_POST['accion']) && $_POST['accion'] == 3) { // parametro para listar horarios por fisioterapeuta
    $horariosPorFisioterapeuta = new AjaxHorarios();
    $horariosPorFisioterapeuta->id_fisioterapeuta = $_POST["id_fisioterapeuta"];
    $horariosPorFisioterapeuta->ajaxListarHorariosPorFisioterapeuta();
} else if (isset($_POST['accion']) && $_POST['accion'] == 4) { // ACCION PARA ACTUALIZAR UN horario
    $actualizarHorario = new AjaxHorarios();

    $data = array(
        "id_fisioterapeuta" => $_POST["id_fisioterapeuta"],
        "dia_semana" => $_POST["dia_semana"],
        "hora_inicio" => $_POST["hora_inicio"],
        "hora_fin" => $_POST["hora_fin"]
    );

    $actualizarHorario->ajaxActualizarHorario($data);
} else if (isset($_POST['accion']) && $_POST['accion'] == 5) { // ACCION PARA ELIMINAR UN horario
    $eliminarHorario = new AjaxHorarios();
    $eliminarHorario->ajaxEliminarHorario();
}else if (isset($_POST['accion']) && $_POST['accion'] == 7) { // OBTENER DATOS DE UN horario POR SU ID
    $listaHorario = new AjaxHorarios();
    $listaHorario->id_horario = $_POST["id_horario"];
    $listaHorario->ajaxObtenerHorarioPorId();
}
