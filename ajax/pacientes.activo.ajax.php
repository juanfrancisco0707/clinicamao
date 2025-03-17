<?php

require_once "../controladores/pacientes.controlador.php";
require_once "../modelos/pacientes.modelo.php";

class AjaxPacientesactivo{


    public function ajaxListarPacientesActivo(){

      //  $pacientes = PacientesControlador::ctrListarPacientesActivo();

      //  echo json_encode($pacientes, JSON_UNESCAPED_UNICODE);
    }
}

$pacientesActivo = new AjaxPacientesActivo();
$pacientesActivo -> ajaxListarPacientesActivo();