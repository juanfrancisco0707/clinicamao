<?php

require_once "../controladores/rol.controlador.php";
require_once "../modelos/rol.modelo.php";

class AjaxRolescb{


    public function ajaxListarRolescb(){

        $rolescb = RolesControlador::ctrListarRolescb();

        echo json_encode($rolescb, JSON_UNESCAPED_UNICODE);
    }
}

$rolescb = new AjaxRolescb();
$rolescb -> ajaxListarRolescb();