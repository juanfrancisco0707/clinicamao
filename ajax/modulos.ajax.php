<?php

require_once "../controladores/modulos.controlador.php";
require_once "../modelos/modulos.modelo.php";

class AjaxModulos{


    public function ajaxListarModulos(){

        $modulos = ModulosControlador::ctrListarModulos();

        echo json_encode($modulos, JSON_UNESCAPED_UNICODE);
    }
}

$modulos = new AjaxModulos();
$modulos -> ajaxListarModulos();