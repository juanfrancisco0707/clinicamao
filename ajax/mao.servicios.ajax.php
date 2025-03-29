<?php

require_once "../controladores/mao.servicios.controlador.php";
require_once "../modelos/mao.servicios.modelo.php";

class AjaxServicios{
    public $id_servicio;
    public $nombre_servicio;
    public $descripcion;
    public $precio;


    public function ajaxListarServicios(){

        $servicios = ServicioControlador::ctrListarServicios();

        echo json_encode($servicios, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxRegistrarServicio(){
                                               
        $servicio = ServicioControlador::ctrRegistrarServicio($this->id_servicio, $this->nombre_servicio, $this->descripcion, $this->precio);
    
        echo json_encode($servicio);
    }  
    public function ajaxActualizarServicio($data){
            
        $table = "tblmao_servicio";
        $id = $_POST["id_servicio"];
        $nameId = "id_servicio";
    
        $respuesta = ServicioControlador::ctrActualizarServicio($table, $data, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    public function ajaxEliminarServicio(){
    
        $table = "tblmao_servicio"; 
        $id = $_POST["id_servicio"]; 
        $nameId = "id_servicio";
    
        $respuesta = ServicioControlador::ctrEliminarServicio($table, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    

}

if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar servicios

    $servicios = new AjaxServicios();
    $servicios -> ajaxListarServicios();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Servicio

    $registrarServicio = new AjaxServicios();
    $registrarServicio -> id_servicio = $_POST["id_servicio"];
    $registrarServicio -> nombre_servicio = $_POST["nombre_servicio"];
    $registrarServicio -> descripcion = $_POST["descripcion"];
    $registrarServicio -> precio = $_POST["precio"];
    
    $registrarServicio -> ajaxRegistrarServicio();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Servicio
 
    $actualizarServicio = new AjaxServicios();

    $data = array(
        "nombre_servicio" => $_POST["nombre_servicio"],
        "descripcion" => $_POST["descripcion"],
        "precio" => $_POST["precio"]
    );
                           
    $actualizarServicio -> ajaxActualizarServicio($data);

}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN Servicio

    $eliminarServicio = new AjaxServicios();
    $eliminarServicio -> ajaxEliminarServicio();
    

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE servicios PARA EL AUTOCOMPLETE

  //  $nombreServicio = new AjaxServicios();
  //  $nombreServicio -> ajaxListarNombreServicio();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN servicios POR SU ID

   // $listaServicio = new AjaxServicios();

   // $listaServicio -> id = $_POST["id"];
    
  // $listaServicio -> ajaxGetDatosServicios();
	
}
