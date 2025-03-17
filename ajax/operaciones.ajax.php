<?php

require_once "../controladores/operaciones.controlador.php";
require_once "../modelos/operaciones.modelo.php";

class AjaxOperaciones{


    public function ajaxListarOperaciones(){

        $operaciones = OperacionesControlador::ctrListarOperaciones();

        echo json_encode($operaciones, JSON_UNESCAPED_UNICODE);
    }
}

$operaciones = new AjaxOperaciones();
$operaciones -> ajaxListarOperaciones();