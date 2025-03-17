<?php

require_once "../controladores/ocupaciones.controlador.php";
require_once "../modelos/ocupaciones.modelo.php";

class AjaxOcupaciones{
    public $id;
    public $nombre_ocupacion;


    public function ajaxListarOcupaciones(){

        $ocupaciones = OcupacionesControlador::ctrListarOcupaciones();

        echo json_encode($ocupaciones, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxRegistrarOcupaciones(){
                                               
        $Ocupacion = OcupacionesControlador::ctrRegistrarOcupacion($this->id, $this->nombre_ocupacion);
    
        echo json_encode($Ocupacion);
    }  
    public function ajaxActualizarOcupaciones($data){
            
        $table = "tblocupaciones";
        $id = $_POST["id"];
        $nameId = "id";
    
        $respuesta = OcupacionesControlador::ctrActualizarOcupacion($table, $data, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    public function ajaxEliminarOcupacion(){
    
        $table = "tblocupaciones"; 
        $id = $_POST["id"]; 
        $nameId = "id";
    
        $respuesta = OcupacionesControlador::ctrEliminarOcupacion($table, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    

}
//$ocupaciones = new AjaxOcupaciones();
//$ocupaciones -> ajaxListarOcupaciones();
    //$ocupaciones = new ajaxOcupaciones();
    //$ocupaciones -> ajaxListarOcupaciones();
if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar Ocupaciones

    $Ocupaciones = new ajaxOcupaciones();
    $Ocupaciones -> ajaxListarOcupaciones();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Ocupacion

    $registrarOcupacion = new AjaxOcupaciones();
    $registrarOcupacion -> id = $_POST["id"];
    $registrarOcupacion -> nombre_ocupacion = $_POST["nombre_ocupacion"];
    
    $registrarOcupacion -> ajaxRegistrarOcupaciones();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Ocupacion
 
    $actualizarOcupacion = new AjaxOcupaciones();

    $data = array(
        "id" => $_POST["id"],
        "nombre_Ocupacion" => $_POST["nombre_ocupacion"],
    );
                           
    $actualizarOcupacion -> ajaxActualizarOcupaciones($data);

}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN Ocupacion

    $eliminarOcupacion = new ajaxOcupaciones();
    $eliminarOcupacion -> ajaxEliminarOcupacion();
    

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE Ocupaciones PARA EL AUTOCOMPLETE

  //  $nombreOcupacion = new AjaxOcupaciones();
  //  $nombreOcupacion -> ajaxListarNombreOcupacion();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN Ocupaciones POR SU ID

   // $listaOcupacion = new AjaxOcupaciones();

   // $listaOcupacion -> id = $_POST["id"];
    
  // $listaOcupacion -> ajaxGetDatosOcupaciones();
	
}
