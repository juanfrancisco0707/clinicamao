<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/representantes.controlador.php";
require_once "../modelos/representantes.modelo.php";

class AjaxRepresentantescb{

    public function ajaxListarRepresentantescb(){

        $representantescb = RepresentantesControlador::ctrListarRepresentantescb($this->idclinica);

        echo json_encode($representantescb, JSON_UNESCAPED_UNICODE);
    }
}
$representantescb = new AjaxRepresentantescb();
$representantescb -> idclinica = $_SESSION['S_IDCLINICA']; 
$representantescb -> ajaxListarRepresentantescb();