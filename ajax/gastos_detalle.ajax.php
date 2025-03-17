<?php

require_once "../controladores/gastos_detalle.controlador.php";
require_once "../modelos/gastos_detalle.modelo.php";

class AjaxGastos_detalle{


    public function ajaxListarGastos_detalle(){

        $gastos_detalle = Gastos_detalleControlador::ctrListarGastos_detalle();

        echo json_encode($gastos_detalle, JSON_UNESCAPED_UNICODE);
    }
}

$gastos_detalle = new AjaxGastos_detalle();
$gastos_detalle -> ajaxListarGastos_detalle();