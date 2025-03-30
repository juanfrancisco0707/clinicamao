<?php

require_once "../controladores/modulos.controlador.php";
require_once "../modelos/modulos.modelo.php";

class AjaxModulos{
    public $id;
    public $nombre_modulo;


    public function ajaxListarModulos(){

        $modulos = ModulosControlador::ctrListarModulos();

        echo json_encode($modulos, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxRegistrarModulo(){
                                               
        $modulo = ModulosControlador::ctrRegistrarModulo($this->id, $this->nombre_modulo);
    
        echo json_encode($modulo);
    }  
    public function ajaxActualizarModulo($data){
            
        $table = "modulos";
        $id = $_POST["id"];
        $nameId = "id";
    
        $respuesta = ModulosControlador::ctrActualizarModulo($table, $data, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    public function ajaxEliminarModulo(){
    
        $table = "modulos"; 
        $id = $_POST["id"]; 
        $nameId = "id";
    
        $respuesta = ModulosControlador::ctrEliminarModulo($table, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    

}
//$modulos = new AjaxModulos();
//$modulos -> ajaxListarModulos();
    //$modulos = new AjaxModulos();
    //$modulos -> ajaxListarModulos();
if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar modulos

    $modulos = new AjaxModulos();
    $modulos -> ajaxListarModulos();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Modulo

    $registrarModulo = new AjaxModulos();
    $registrarModulo -> id = $_POST["id"];
    $registrarModulo -> nombre_modulo = $_POST["nombre_modulo"];
    
    $registrarModulo -> ajaxRegistrarModulo();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Modulo
 
    $actualizarModulo = new AjaxModulos();

    $data = array(
        "id" => $_POST["id"],
        "nombre_modulo" => $_POST["nombre_modulo"],
    );
                           
    $actualizarModulo -> ajaxActualizarModulo($data);

}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN Modulo

    $eliminarModulo = new AjaxModulos();
    $eliminarModulo -> ajaxEliminarModulo();
    

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE modulos PARA EL AUTOCOMPLETE

   // $nombreModulo = new AjaxModulos();
   // $nombreModulo -> ajaxListarNombreModulos();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN modulos POR SU ID

   // $listaModulo = new AjaxModulos();

   // $listaModulo -> id = $_POST["id"];
    
  // $listaModulo -> ajaxGetDatosModulos();
	
}
