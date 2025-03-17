<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/representantes.controlador.php";
require_once "../modelos/representantes.modelo.php";

class AjaxRepresentantes{

    public $fileRepresentantes;

    public $id;
    public $nombre_representante;
    public $parentesco;
    public $telefono;
    public $id_clinica;
    public $estatus;
    public $direccion;
    public $edad;
    public $id_ocupacion; 
    public $clinica;

    public function ajaxListarRepresentantes(){

        $representantes = RepresentantesControlador::ctrListarRepresentantes($this->id_clinica);

        echo json_encode($representantes, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxListarRepresentantesadmin(){
        $representantes = RepresentantesControlador::ctrListarRepresentantesadmin();
        echo json_encode($representantes);     
   }
   public function ajaxListarFolioRepresentantes(){

    $foliorepresentantes = RepresentantesControlador::ctrListarFolioRepresentantes($this->idclinica);

    echo json_encode($foliorepresentantes, JSON_UNESCAPED_UNICODE);
}
    
public function ajaxRegistrarRepresentantes(){
                                               
    $representante = RepresentantesControlador::ctrRegistrarRepresentante($this->id, $this->nombre_representante,
    $this->parentesco, 
    $this->telefono,$this->id_clinica,$this->estatus,$this->direccion,$this->edad,$this->id_ocupacion);

    echo json_encode($representante);
}  
public function ajaxActualizarRepresentantes($data){
        
    $table = "tblrepresentantes";
    $id = $_POST["id"];
    $id_clinica = $_POST["id_clinica"];
    $nameId = "id";

    $respuesta = RepresentantesControlador::ctrActualizarRepresentante($table, $data, $id,$id_clinica, $nameId);

    echo json_encode($respuesta);
}

public function ajaxEliminarRepresentante($data){

    $table = "tblrepresentantes"; 
    $id = $_POST["id"]; 
    $id_clinica=$_POST['id_clinica'];
    $nameId = "id";
    $nameId2 = "id_clinica";

    $respuesta = RepresentantesControlador::ctrEliminarRepresentante($table, $id, $nameId,$id_clinica,$nameId2);

    echo json_encode($respuesta);
}


}
    //$representantes = new AjaxRepresentantes();
    //$representantes -> ajaxListarRepresentantes();

if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar Representantes

    if( $_SESSION['S_ROL']==1){
        $representantes = new ajaxRepresentantes();
        $representantes -> ajaxListarRepresentantesadmin();
    }
else{
    $representantes = new ajaxRepresentantes();
    $representantes -> id_clinica = $_SESSION['S_IDCLINICA']; 
    $representantes -> ajaxListarRepresentantes();
}
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 11){ // folio de representantes

    $folioRepresentantes = new AjaxRepresentantes();
    $folioRepresentantes -> idclinica = $_SESSION['S_IDCLINICA']; 
    $folioRepresentantes -> ajaxListarFolioRepresentantes();
    
}
else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar representante

    $registrarRepresentante = new AjaxRepresentantes();
    $registrarRepresentante -> id = $_POST["id"];
    $registrarRepresentante -> nombre_representante = $_POST["nombre_representante"];
    $registrarRepresentante -> direccion = $_POST["direccion"];
    $registrarRepresentante -> edad = $_POST["edad"];

    $registrarRepresentante -> parentesco = $_POST["parentesco"];
    $registrarRepresentante -> telefono = $_POST["telefono"];
    $registrarRepresentante -> id_ocupacion = $_POST["id_ocupacion"];
    $registrarRepresentante -> id_clinica = $_POST["id_clinica"];

    $registrarRepresentante -> estatus = $_POST["estatus"];
    
    $registrarRepresentante -> ajaxRegistrarRepresentantes();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN REPRESENTANTE
 
    $actualizarRepresentante = new AjaxRepresentantes();

    $data = array(
        "id" => $_POST["id"],
        "nombre_representante" => $_POST["nombre_representante"],
        "parentesco" => $_POST["parentesco"],
        "telefono" => $_POST["telefono"],  
        "id_clinica" => $_POST["id_clinica"],      
        "estatus" => $_POST["estatus"],
        "id_ocupacion" => $_POST["id_ocupacion"], 
        "direccion" => $_POST["direccion"], 
        "edad" => $_POST["edad"], 
    );
                           
    $actualizarRepresentante -> ajaxActualizarRepresentantes($data);

}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN REPRESENTANTE

    $eliminarRepresentante = new ajaxRepresentantes();

    $data = array(
        "id" => $_POST["id"],
        "id_clinica" => $_POST["id_clinica"],      
    );
   
    $eliminarRepresentante -> ajaxEliminarRepresentante($data);
    

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE REPRESENTANTES PARA EL AUTOCOMPLETE

  //  $nombreRepresentante = new AjaxRepresentantes();
  //  $nombreRepresentante -> ajaxListarNombreRepresentante();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN REPRESENTANTES POR SU ID

   // $listaRepresentante = new AjaxRepresentantes();

   // $listaRepresentante -> id = $_POST["id"];
    
  // $listaRepresentante -> ajaxGetDatosRepresentantes();
	
}