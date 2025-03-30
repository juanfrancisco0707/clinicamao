<?php

require_once "../controladores/drogas.controlador.php";
require_once "../modelos/drogas.modelo.php";

class Ajaxdrogas{
    public $id_droga;
    public $nombre_droga;


    public function ajaxListardrogas(){

        $drogas = drogasControlador::ctrListardrogas();

        echo json_encode($drogas, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxRegistrardrogas(){
                                               
        $Droga = drogasControlador::ctrRegistrarDrogas($this->id_droga, $this->nombre_droga);
    
        echo json_encode($Droga);
    }  
    public function ajaxActualizardrogas($data){
            
        $table = "tbldrogas";
        $id = $_POST["id_droga"];
        $nameId = "id_droga";
    
        $respuesta = drogasControlador::ctrActualizarDrogas($table, $data, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    public function ajaxEliminarDroga(){
    
        $table = "tbldrogas"; 
        $id = $_POST["id_droga"]; 
        $nameId = "id_droga";
    
        $respuesta = drogasControlador::ctrEliminarDrogas($table, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    

}
//$drogas = new Ajaxdrogas();
//$drogas -> ajaxListardrogas();
    //$drogas = new ajaxdrogas();
    //$drogas -> ajaxListardrogas();
if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar drogas

    $drogas = new ajaxdrogas();
    $drogas -> ajaxListardrogas();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Droga

    $registrarDroga = new Ajaxdrogas();
    $registrarDroga -> id_droga = $_POST["id_droga"];
    $registrarDroga -> nombre_droga = $_POST["nombre_droga"];
    
    $registrarDroga -> ajaxRegistrardrogas();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Droga
 
    $actualizarDroga = new Ajaxdrogas();

    $data = array(
        "id_droga" => $_POST["id_droga"],
        "nombre_droga" => $_POST["nombre_droga"],
    );
                           
    $actualizarDroga -> ajaxActualizardrogas($data);

}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN Droga

    $eliminarDroga = new ajaxdrogas();
    $eliminarDroga -> ajaxEliminarDroga();
    

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE drogas PARA EL AUTOCOMPLETE

  //  $nombreDroga = new Ajaxdrogas();
  //  $nombreDroga -> ajaxListarNombreDroga();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN drogas POR SU ID

   // $listaDroga = new Ajaxdrogas();

   // $listaDroga -> id = $_POST["id"];
    
  // $listaDroga -> ajaxGetDatosdrogas();
	
}
