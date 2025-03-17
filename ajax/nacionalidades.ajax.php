<?php

require_once "../controladores/nacionalidades.controlador.php";
require_once "../modelos/nacionalidades.modelo.php";

class AjaxNacionalidades{


    public function ajaxListarNacionalidades(){

        $nacionalidades = NacionalidadesControlador::ctrListarNacionalidades();

        echo json_encode($nacionalidades, JSON_UNESCAPED_UNICODE);
    }
}

$nacionalidades = new AjaxNacionalidades();
$nacionalidades -> ajaxListarNacionalidades();