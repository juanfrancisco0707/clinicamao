<?php

require_once "../controladores/empresa.controlador.php";
require_once "../modelos/empresa.modelo.php";

class AjaxEmpresa{

    public $id;
    public $nombre;
    public $direccion;
    public $telefono;
    public $representante_legal;
    public $cedula_legal;

    public $fecha;
   // public $logo; 

    public function ajaxListarEmpresas(){

        $empresa = EmpresaControlador::ctrListarEmpresa();

        echo json_encode($empresa, JSON_UNESCAPED_UNICODE);
    }
    
    public function ajaxRegistrarEmpresas(){
                                               
    $Empresa = EmpresaControlador::ctrRegistrarEmpresa($this->id,
     $this->nombre,
    $this->direccion, $this->telefono,$this->representante_legal,$this->cedula_legal
    );

    echo json_encode($Empresa);
}  
public function ajaxActualizarEmpresas($data){
        
    $table = "tblempresa";
    $id = $_POST["id"];
    $nameId = "id";

    $respuesta = EmpresaControlador::ctrActualizarEmpresa($table, $data, $id, $nameId);

    echo json_encode($respuesta);
}

public function ajaxEliminarEmpresa(){

    $table = "tblempresa"; 
    $id = $_POST["id"]; 
    $nameId = "id";

    $respuesta = EmpresaControlador::ctrEliminarEmpresa($table, $id, $nameId);

    echo json_encode($respuesta);
}


}
//$empresas = new AjaxEmpresa();
//$empresas -> ajaxListarEmpresas();

if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar las Clínicas

    $empresas = new AjaxEmpresa();
    $empresas -> ajaxListarEmpresas();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar la Clínica

    $registrarEmpresa = new AjaxEmpresa();
    $registrarEmpresa -> id = $_POST["id"];
    $registrarEmpresa -> nombre = $_POST["nombre"];
    $registrarEmpresa -> direccion = $_POST["direccion"];
    $registrarEmpresa -> telefono = $_POST["telefono"];
    $registrarEmpresa -> representante_legal = $_POST["representante_legal"];
    $registrarEmpresa -> cedula_legal = $_POST["cedula_legal"];
   // $registrarEmpresa -> logo = $_POST["logo"];
    
    $registrarEmpresa -> ajaxRegistrarEmpresas();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UNA CLINICA
 
    $actualizarEmpresa = new AjaxEmpresa();

    $data = array(
        "id" => $_POST["id"],
        "nombre" => $_POST["nombre"],
        "direccion" => $_POST["direccion"],
        "telefono" => $_POST["telefono"], 
        "representante_legal" => $_POST["representante_legal"], 
        "cedula_legal" => $_POST["cedula_legal"]
       // "logo" => $_POST["logo"],
    );
                           
    $actualizarEmpresa -> ajaxActualizarEmpresas($data);

}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UNA CLINICA

    $eliminarEmpresa = new AjaxEmpresa();
    $eliminarEmpresa -> ajaxEliminarEmpresa();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE LAS CLINICAS PARA EL AUTOCOMPLETE

   // $nombre = new AjaxEmpresa();
   // $nombre -> ajaxListarNombreEmpresas();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN CLINICA POR SU ID

  //  $listaEmpresa = new AjaxEmpresa();

  //  $listaEmpresa -> id = $_POST["id"];
    
  //  $listaEmpresa -> ajaxGetDatosEmpresas();
	

}else if(isset($_FILES)){
   // $archivo_Empresas = new AjaxEmpresa();
  //  $archivo_Empresas-> fileEmpresas = $_FILES['fileEmpresas'];
   // $archivo_Empresas -> ajaxCargaMasivaEmpresas();
}