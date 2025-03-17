<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/drogas.controlador.php";
require_once "../modelos/drogas.modelo.php";

class AjaxDrogascb{

    public function ajaxListarDrogascb(){

        $Drogas = DrogasControlador::ctrListarDrogasCb();

        echo json_encode($Drogas, JSON_UNESCAPED_UNICODE);
    }
}

$Drogas = new AjaxDrogascb();
$Drogas -> ajaxListarDrogascb();