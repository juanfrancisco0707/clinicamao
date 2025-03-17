<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/pacientes.controlador.php";
require_once "../modelos/pacientes.modelo.php";

class AjaxPacientescb{


    public function ajaxListarPacientescb(){

        $pacientes = PacientesControlador::ctrListarPacientesCb($this->idclinica);

        echo json_encode($pacientes, JSON_UNESCAPED_UNICODE);
    }
}

$pacientes = new AjaxPacientescb();
$pacientes -> idclinica = $_SESSION['S_IDCLINICA']; 
$pacientes -> ajaxListarPacientescb();
   
