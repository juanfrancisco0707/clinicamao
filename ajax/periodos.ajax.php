<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}

require_once "../controladores/periodos.controlador.php";
require_once "../modelos/periodos.modelo.php";

class AjaxPeriodos{
    public $id;
    public $id_expediente;
    public $fecha_inicial;
    public $fecha_final;
    public $pago;
    public $saldo;
    public $estatus;

    public function ajaxListarPeriodos(){

        $Periodos = PeriodosControlador::ctrListarPeriodos($this->id_clinica,$this->id_expediente);

        echo json_encode($Periodos, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxBuscarExpedienteenPagos(){

        $expedientepagado = PeriodosControlador::ctrBuscarExpediente($this->id_clinica,$this->id_expediente);

        echo json_encode($expedientepagado, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxBuscarExpedienteenPeriodos(){

        $expedienteperiodos = PeriodosControlador::ctrBuscarExpedientePeriodos($this->id_clinica,$this->id_expediente);

        echo json_encode($expedienteperiodos, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxListarPeriodosAll(){

        $Periodos = PeriodosControlador::ctrListarPeriodosAll($this->id_clinica);

        echo json_encode($Periodos, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxListarFolioPeriodos(){

        $folioPeriodos = PeriodosControlador::ctrListarFolioPeriodos($this->idclinica);
    
        echo json_encode($folioPeriodos, JSON_UNESCAPED_UNICODE);
    }
    
    public function ajaxListarPeriodosadmin(){

        $Periodos = PeriodosControlador::ctrListarPeriodosadmin();
        echo json_encode($Periodos);     
   }

    public function ajaxRegistrarPeriodos(){
        
        $Periodos = PeriodosControlador::ctrRegistrarPeriodos($this->id,$this->id_expediente, 
        $this->id_clinica, $this->fecha_inicial, 
        $this->fecha_final, 
        $this->pago,$this->saldo, $this->estatus);

        echo json_encode($Periodos);
    }

   

    public function ajaxActualizarPeriodos($data){
        
        $table = "tblPeriodos_pagos";
        $id = $_POST["id"];
        $nameId0 = "id";
        $id_expediente = $_POST["id_expediente"];
        $nameId = "id_expediente";
        $id_clinica = $_SESSION['S_IDCLINICA'];
        $nameId2 = "id_clinica";
        $respuesta = PeriodosControlador::ctrActualizarPeriodos($table, $data,$id,$nameId0, $id_expediente, $nameId,$id_clinica,$nameId2);

        echo json_encode($respuesta);
    }

    public function ajaxEliminarPeriodo(){

        $table = "tblPeriodos_pagos"; 
        $id = $_POST["id_expediente"]; 
        $nameId = "id_expediente";
        $id_clinica = $_SESSION['S_IDCLINICA'];
        $nameId2 = "id_clinica";
        $respuesta = PeriodosControlador::ctrEliminarPeriodos($table, $id, $nameId,$id_clinica,$nameId2);

        echo json_encode($respuesta);
    }

    /*===================================================================
    LISTAR NOMBRE DE Periodos PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    public function ajaxListarNombrePeriodos(){

        $NombreExpediente = PeriodosControlador::ctrListarNombrePeriodos();

        echo json_encode($NombreExpediente);
    }

    /*===================================================================
    BUSCAR Periodos POR SU ID
    ====================================================================*/
    public function ajaxGetDatosPeriodos(){
     
        $Expediente = PeriodosControlador::ctrGetDatosPeriodos($this->id);
        echo json_encode($Expediente);
    }


}

if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar Periodos

    
 /*   if( $_SESSION['S_ROL']==1){
        $Periodos = new ajaxPeriodos();
        $Periodos -> ajaxListarPeriodosadmin();
       }
       else{ */
        $Periodos = new AjaxPeriodos();
        $Periodos -> id_clinica = $_SESSION['S_IDCLINICA']; 
        $Periodos -> id_expediente = $_POST["id_expediente"];
        $Periodos -> ajaxListarPeriodos();
     //  }

    
}else if(isset($_POST['accion']) && $_POST['accion'] == 11){ // parametro para registrar Periodos
    $Periodos = new AjaxPeriodos();
    $Periodos -> id_clinica = $_SESSION['S_IDCLINICA']; 
   // $Periodos -> id_expediente = $_POST["id_expediente"];
    $Periodos -> ajaxListarPeriodosAll();

   
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Periodos

    $registrarPeriodo = new AjaxPeriodos();
    $registrarPeriodo -> id = $_POST["id"];
    $registrarPeriodo -> id_expediente = $_POST["id_expediente"];
    $registrarPeriodo -> id_clinica = $_SESSION['S_IDCLINICA']; 
    $registrarPeriodo -> fecha_inicial = $_POST["fecha_inicial"];
    $registrarPeriodo -> fecha_final = $_POST["fecha_final"];
    $registrarPeriodo -> pago = $_POST["pago"];
    $registrarPeriodo -> saldo = $_POST["saldo"];
   
    $registrarPeriodo -> estatus = $_POST["estatus"];
   
    $registrarPeriodo -> ajaxRegistrarPeriodos(); 

}
else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Paciente
 
    $actualizarExpediente = new AjaxPeriodos();

    $data = array(
        "id" =>  $_POST["id"],
        "id_expediente" => $_POST["id_expediente"],
        "id_clinica" => $_SESSION['S_IDCLINICA'],
        "fecha_inicial" => $_POST["fecha_inicial"],
        "fecha_final" => $_POST["fecha_final"],
        "pago" => $_POST["pago"],
        "saldo" => $_POST["saldo"],
        "estatus" => $_POST["estatus"],
       
    );
                           
    $actualizarExpediente -> ajaxActualizarPeriodos($data);
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN Expediente

    $eliminarPeriodo = new ajaxPeriodos();
    $data = array(
        "id_expediente" => $_POST["id_expediente"],
        "id_clinica" => $_POST["id_clinica"],      
    );
    $eliminarExpediente -> ajaxEliminarPeriodo($data);

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE Periodos PARA EL AUTOCOMPLETE

    $nombrePeriodos = new AjaxPeriodos();
   
    $nombrePeriodos -> ajaxListarNombrePeriodos();

}else if(isset($_POST['accion']) && $_POST['accion'] == 11){ // folio de Periodos

    $folioPeriodos = new ajaxPeriodos();
    $folioPeriodos -> idclinica = $_SESSION['S_IDCLINICA']; 
    $folioPeriodos ->  ajaxListarFolioPeriodos();
    
}
else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN Expediente POR SU ID

    $listaExpediente = new AjaxPeriodos();

    $listaExpediente -> id = $_POST["id"];
    
    $listaExpediente -> ajaxGetDatosPeriodos();

}else if(isset($_POST['accion']) && $_POST['accion'] == 8){// buscar si ya pago la cuota de ingreso

    $buscarexpediente = new ajaxPeriodos();
    $buscarexpediente -> id_clinica = $_SESSION['S_IDCLINICA']; 
    $buscarexpediente -> id_expediente = $_POST['id_expediente'];
   
    $buscarexpediente -> ajaxBuscarExpedienteenPagos($buscarexpediente);

}
else if(isset($_POST['accion']) && $_POST['accion'] == 9){// buscar expediente en periodos de pago

    $buscarexpedienteperiodos = new ajaxPeriodos();
    $buscarexpedienteperiodos -> id_clinica = $_SESSION['S_IDCLINICA']; 
    $buscarexpedienteperiodos -> id_expediente = $_POST['id_expediente'];
   
    $buscarexpedienteperiodos -> ajaxBuscarExpedienteenPeriodos($buscarexpedienteperiodos);

}
else if(isset($_FILES)){
   
}