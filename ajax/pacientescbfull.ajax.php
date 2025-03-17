<?php

require_once "../controladores/pacientes.controlador.php";
require_once "../modelos/pacientes.modelo.php";

class AjaxPacientescbfull{


    public function ajaxListarPacientescbfull(){

        $pacientes = PacientesControlador::ctrListarPacientesCbFull();

        echo json_encode($pacientes, JSON_UNESCAPED_UNICODE);
    }
}

$pacientescbfull = new AjaxPacientescbfull();
$pacientescbfull -> ajaxListarPacientescbfull();
   