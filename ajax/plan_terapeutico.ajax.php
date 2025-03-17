<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/plan_terapeutico.controlador.php";
require_once "../modelos/plan_terapeutico.modelo.php";

class AjaxPlanTerapeuticocb{

    public function ajaxListarPlanTerapeuticocb(){

        $PlanTerapeutico = PlanTerapeuticoControlador::ctrListarPlanTerapeuticoCb();

        echo json_encode($PlanTerapeutico, JSON_UNESCAPED_UNICODE);
    }
}

$PlanTerapeutico = new AjaxPlanTerapeuticocb();
$PlanTerapeutico -> ajaxListarPlanTerapeuticocb();