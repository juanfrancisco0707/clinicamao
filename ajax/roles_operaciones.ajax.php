<?php

require_once "../controladores/roles_operaciones.controlador.php";
require_once "../modelos/roles_operaciones.modelo.php";

class AjaxRoles_operaciones{


    public function ajaxListarRoles_operaciones(){

        $roles_operaciones = Roles_operacionesControlador::ctrListarRoles_operaciones();

        echo json_encode($roles_operaciones, JSON_UNESCAPED_UNICODE);
    }
}

$roles_operaciones = new AjaxRoles_operaciones();
$roles_operaciones -> ajaxListarRoles_operaciones();