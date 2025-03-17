<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/periodos.controlador.php";
require_once "../modelos/periodos.modelo.php";

class AjaxPeriodoscb{

    public $id_expediente;
    public function ajaxListarPeriodoscb(){

        $periodos = PeriodosControlador::ctrListarPeriodosCb($this->idclinica,$this->id_expediente);

        echo json_encode($periodos, JSON_UNESCAPED_UNICODE);
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar
$periodosp = new AjaxPeriodoscb();
$periodosp -> idclinica = $_SESSION['S_IDCLINICA'];
$periodosp -> id_expediente = $_POST["id_expediente"];
$periodosp -> ajaxListarPeriodoscb();
}
   