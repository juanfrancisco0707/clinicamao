<?php

require_once "../controladores/conceptos.controlador.php";
require_once "../modelos/conceptos.modelo.php";

class AjaxConceptos{

    public $id;
    public $descripcion;
    public $tipo;
   

    public function ajaxListarConceptos(){

        $conceptos = ConceptosControlador::ctrListarConceptos();

        echo json_encode($conceptos, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxRegistrarConceptos(){
                                               
        $Concepto = ConceptosControlador::ctrRegistrarConcepto($this->id, $this->descripcion,$this->tipo);
    
        echo json_encode($Concepto);
    }  
    public function ajaxActualizarConceptos($data){
            
        $table = "tblConceptos";
        $id = $_POST["id"];
        $nameId = "id";
    
        $respuesta = ConceptosControlador::ctrActualizarConcepto($table, $data, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    public function ajaxEliminarConcepto(){
    
        $table = "tblConceptos"; 
        $id = $_POST["id"]; 
        $nameId = "id";
    
        $respuesta = ConceptosControlador::ctrEliminarConcepto($table, $id, $nameId);
    
        echo json_encode($respuesta);
    }
     /*===================================================================
    LISTAR NOMBRE DE Conceptos PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    public function ajaxListarNombreConceptos(){

        $NombreConceptos = ConceptosControlador::ctrListarNombreConceptos();

        echo json_encode($NombreConceptos);
    }

    /*===================================================================
    BUSCAR Concepto POR SU CODIGO DE BARRAS
    ====================================================================*/
    public function ajaxGetDatosConcepto(){
        
        $Concepto = ConceptosControlador::ctrGetDatosConcepto($this->id);

        echo json_encode($Concepto);
    }




    
    
}
if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar Conceptos

    $Conceptos = new ajaxConceptos();
    $Conceptos -> ajaxListarConceptos();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Conceptos

    $registrarConcepto = new AjaxConceptos();
    $registrarConcepto -> id = $_POST["id"];
    $registrarConcepto -> descripcion = $_POST["descripcion"];
    $registrarConcepto -> tipo = $_POST["tipo"];

    $registrarConcepto -> ajaxRegistrarConceptos();
    

}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Concepto
 
    $actualizarConcepto = new ajaxConceptos();

    $data = array(
        "id" => $_POST["id"],
        "descripcion" => $_POST["descripcion"],
        "tipo" => $_POST["tipo"],
       
    );
                           
    $actualizarConcepto -> ajaxActualizarConceptos($data);

}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN Concepto

    $eliminarConcepto = new ajaxConceptos();
    $eliminarConcepto -> ajaxEliminarConcepto();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE Conceptos PARA EL AUTOCOMPLETE

    $nombreConceptos = new AjaxConceptos();
    $nombreConceptos -> ajaxListarNombreConceptos();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN Concepto POR SU ID

    $listaConcepto = new AjaxConceptos();

    $listaConcepto -> id = $_POST["id"];
    
    $listaConcepto -> ajaxGetDatosConcepto();

}else if(isset($_FILES)){
   
}