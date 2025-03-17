<?php

require_once "../controladores/gastos.controlador.php";
require_once "../modelos/gastos.modelo.php";

class AjaxGastos{


    public function ajaxListarGastos(){

        $gastos = GastosControlador::ctrListarGastos();

        echo json_encode($gastos, JSON_UNESCAPED_UNICODE);
    }
}

$gastos = new AjaxGastos();
$gastos -> ajaxListarGastos();