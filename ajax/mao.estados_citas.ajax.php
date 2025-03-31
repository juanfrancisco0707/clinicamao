<?php

require_once "../controladores/mao.estados_citas.controlador.php";
require_once "../modelos/mao.estados_citas.modelo.php";

class AjaxEstadosCitas{
    public $id_estado;
    public $nombre_estado;


    /*=================================================================
    LISTAR ESTADOS DE CITAS
    ====================================================================*/
    public function ajaxListarEstadosCitas(){

        $estadosCitas = EstadosCitasControlador::ctrListarEstadosCitas();

        echo json_encode($estadosCitas, JSON_UNESCAPED_UNICODE);
    }

    /*===================================================================
    REGISTRAR ESTADO DE CITA
    ====================================================================*/
    public function ajaxRegistrarEstadoCita(){
                                               
        $estadoCita = EstadosCitasControlador::ctrRegistrarEstadoCita($this->id_estado, $this->nombre_estado);
    
        echo json_encode($estadoCita);
    }  

    /*===================================================================
    ACTUALIZAR ESTADO DE CITA
    ====================================================================*/
    public function ajaxActualizarEstadoCita($data){
            
        $table = "tblmao_estadoscitas";
        $id = $_POST["id_estado"];
        $nameId = "id_estado";
    
        $respuesta = EstadosCitasControlador::ctrActualizarEstadoCita($table, $data, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    /*===================================================================
    ELIMINAR ESTADO DE CITA
    ====================================================================*/
    public function ajaxEliminarEstadoCita(){
    
        $table = "tblmao_estadoscitas"; 
        $id = $_POST["id_estado"]; 
        $nameId = "id_estado";
    
        $respuesta = EstadosCitasControlador::ctrEliminarEstadoCita($table, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    /*===================================================================
    LISTAR NOMBRES DE ESTADOS DE CITAS PARA AUTOCOMPLETADO
    ====================================================================*/
    public function ajaxListarNombreEstadosCitas(){
        $estadosCitas = EstadosCitasControlador::ctrListarNombreEstadosCitas();
        echo json_encode($estadosCitas, JSON_UNESCAPED_UNICODE);
    }

}

/*===============================================================
ACCIONES
=================================================================*/
if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar estados de citas

    $estadosCitas = new AjaxEstadosCitas();
    $estadosCitas -> ajaxListarEstadosCitas();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar estado de cita

    $registrarEstadoCita = new AjaxEstadosCitas();
    $registrarEstadoCita -> id_estado = $_POST["id_estado"];
    $registrarEstadoCita -> nombre_estado = $_POST["nombre_estado"];
    
    $registrarEstadoCita -> ajaxRegistrarEstadoCita();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN estado de cita
 
    $actualizarEstadoCita = new AjaxEstadosCitas();

    $data = array(
        "id_estado" => $_POST["id_estado"],
        "nombre_estado" => $_POST["nombre_estado"],
    );
                           
    $actualizarEstadoCita -> ajaxActualizarEstadoCita($data);

}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN estado de cita

    $eliminarEstadoCita = new AjaxEstadosCitas();
    $eliminarEstadoCita -> ajaxEliminarEstadoCita();
    

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE estados de citas PARA EL AUTOCOMPLETE

    $nombreEstadoCita = new AjaxEstadosCitas();
    $nombreEstadoCita -> ajaxListarNombreEstadosCitas();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN estado de cita POR SU ID

   // $listaEstadoCita = new AjaxEstadosCitas();

   // $listaEstadoCita -> id = $_POST["id"];
    
  // $listaEstadoCita -> ajaxGetDatosEstadoCita();
	
}