<?php

require_once "../controladores/ocupaciones.controlador.php";
require_once "../modelos/ocupaciones.modelo.php";

class AjaxOcupacionescb{

    public function ajaxListarocupacionescb(){

        $ocupacionescb = ocupacionesControlador::ctrListarocupacionescb();

        echo json_encode($ocupacionescb, JSON_UNESCAPED_UNICODE);
    }
}
$ocupacionescb = new AjaxOcupacionescb();
$ocupacionescb -> ajaxListarocupacionescb();