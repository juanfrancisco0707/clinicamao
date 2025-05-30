<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/folio.controlador.php";
require_once "../modelos/folios.modelo.php";

class Ajaxfolios{
    public $id_droga;
    public $nombre_droga;
    public $entidad;
    public $id_empresa;


    public function ajaxListarfolios(){

        $folios = foliosControlador::ctrListarfolios();

        echo json_encode($folios, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxListarFolioEntidad(){

        $folio = FoliosControlador::ctrListarFolioEntidad($this->entidad, $this->id_empresa);

        echo json_encode($folio);

    }
    public function ajaxRegistrarfolios(){
                                               
        $Droga = foliosControlador::ctrRegistrarfolios($this->id_droga, $this->nombre_droga);
    
        echo json_encode($Droga);
    }  
    public function ajaxActualizarfolios($data){
            
        $table = "tblfolios";
        $id = $_POST["id_droga"];
        $nameId = "id_droga";
    
        $respuesta = foliosControlador::ctrActualizarfolios($table, $data, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    public function ajaxEliminarDroga(){
    
        $table = "tblfolios"; 
        $id = $_POST["id_droga"]; 
        $nameId = "id_droga";
    
        $respuesta = foliosControlador::ctrEliminarfolios($table, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    

}
//$folios = new Ajaxfolios();
//$folios -> ajaxListarfolios();
    //$folios = new ajaxfolios();
    //$folios -> ajaxListarfolios();
if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar folios

    $folios = new ajaxfolios();
    $folios -> ajaxListarfolios();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Droga

    $registrarDroga = new Ajaxfolios();
    $registrarDroga -> id_droga = $_POST["id_droga"];
    $registrarDroga -> nombre_droga = $_POST["nombre_droga"];
    
    $registrarDroga -> ajaxRegistrarfolios();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Droga
 
    $actualizarDroga = new Ajaxfolios();

    $data = array(
        "id_droga" => $_POST["id_droga"],
        "nombre_droga" => $_POST["nombre_droga"],
    );
                           
    $actualizarDroga -> ajaxActualizarfolios($data);

}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN Droga

    $eliminarDroga = new ajaxfolios();
    $eliminarDroga -> ajaxEliminarDroga();
    

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE folios PARA EL AUTOCOMPLETE

  //  $nombreDroga = new Ajaxfolios();
  //  $nombreDroga -> ajaxListarNombreDroga();

}if(isset($_POST['accion']) && $_POST['accion'] == 11){ // folio de representantes
    //$entidad = isset($_POST['entidad']) ? $_POST['entidad'] : 'paciente'; // valor por defecto
    //var_dump($entidad);
    //exit;
    //if( $_SESSION['S_ROL']==1){

      //  }
     $folio = new ajaxFolios();
    $folio->entidad = $_POST['entidad'];
    $folio->id_empresa = $_POST['id_empresa'];//$_SESSION['S_IDCLINICA']; // ← lo tomas de la sesión
    $folio->ajaxListarFolioEntidad();
    
}