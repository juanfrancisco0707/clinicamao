<?php

require_once "../controladores/mao.servicios.controlador.php";
require_once "../modelos/mao.servicios.modelo.php";

class AjaxServicios{
    public $id_servicio;
    public $nombre_servicio;
    public $descripcion;
    public $precio;

    public $idServicio;
    /* Editar Serivicios IA*/
    public function ajaxEditarServicio(){

        $item = "id_servicio";
        $valor = $this->idServicio;

        $respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);

        echo json_encode($respuesta);

    }
/*=============================================
    ACTIVAR SERVICIO
    =============================================*/ 

    public $activarId;
    public $activarServicio;

    public function ajaxActivarServicio(){

        $tabla = "tblservicios";

        $item1 = "estado";
        $valor1 = $this->activarServicio;

        $item2 = "id_servicio";
        $valor2 = $this->activarId;

        $respuesta = ModeloServicios::mdlEditarServicio($tabla, $item1, $valor1, $item2, $valor2);

        echo $respuesta;

    }
     /*=============================================
    CARGAR SELECT 2
    =============================================*/ 
    public function ajaxListarServicios()
    {
        $servicios = ControladorServicios::ctrMostrarServicios(null,null);
        echo json_encode($servicios);
    }
      /*=============================================
    CARGAR SELECT 2
    =============================================*/ 
    public function ajaxListarCategoriaServicios()
    {
         $servicios = ControladorServicios::ctrMostrarCategoriaServicios();
         echo json_encode($servicios);
    }



    public function ajaxListarServicios1(){

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

/*=============================================
EDITAR SERVICIO
=============================================*/
if(isset($_POST["idServicio"])){

    $editarServicio = new AjaxServicios();
    $editarServicio -> idServicio = $_POST["idServicio"];
    $editarServicio -> ajaxEditarServicio();

}

/*=============================================
ACTIVAR SERVICIO
=============================================*/ 

if(isset($_POST["activarId"])){

    $activarServicio = new AjaxServicios();
    $activarServicio -> activarId = $_POST["activarId"];
    $activarServicio -> activarServicio = $_POST["activarServicio"];
    $activarServicio -> ajaxActivarServicio();

}
/*=============================================
Listar Servicios
=============================================*/ 
if(isset($_POST["accion"]) && $_POST["accion"] == 1){
$a = new AjaxServicios();
$a -> ajaxListarServicios();

}
/*=============================================
Listar Categorias
=============================================*/ 
if(isset($_POST["accion"]) && $_POST["accion"] == 2){
$a = new AjaxServicios();
$a -> ajaxListarCategoriaServicios();

}
/*
if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar servicios

    $servicios = new AjaxServicios();
    $servicios -> ajaxListarServicios1();
    
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
	
}*/
