<?php

require_once "../controladores/permisos.controlador.php";
require_once "../modelos/permisos.modelo.php";

class Ajaxpermisoscb{

    public function ajaxListarpermisoscb(){

        $permisoscb = permisosControlador::ctrListarpermisoscb();

        echo json_encode($permisoscb, JSON_UNESCAPED_UNICODE);
    }
}
$permisoscb = new Ajaxpermisoscb();
$permisoscb -> ajaxListarpermisoscb();