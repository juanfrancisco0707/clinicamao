<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/Empresa.controlador.php";
require_once "../modelos/Empresa.modelo.php";

class AjaxEmpresascb{


    public function ajaxListarEmpresascb(){

        $Empresas = EmpresaControlador::ctrListarEmpresasCb($this->idclinica,$this->idrol);

        echo json_encode($Empresas, JSON_UNESCAPED_UNICODE);
    }
}

$Empresas = new AjaxEmpresascb();
$Empresas -> idclinica = $_SESSION['S_IDCLINICA']; 
$Empresas -> idrol = $_SESSION['S_ROL'];
$Empresas -> ajaxListarEmpresascb();
   