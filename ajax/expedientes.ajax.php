<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}

require_once "../controladores/expedientes.controlador.php";
require_once "../modelos/expedientes.modelo.php";

class AjaxExpedientes{
    public $id_expediente;
    public $id_paciente;
    public $id_clinica;
    public $id_representante;
    public $fecha_ingreso;
    public $fecha_salida;
    public $firmo_contrato;
    public $tiempo_duracion;
    public $hora_ingreso;
    public $cuota_ingreso;
    public $cuota_semanal;
    public $extras;
    public $testigo;
    public $estatus; 
    public $tipo_ingreso;
    public $refiere_institucion;
    public $motivo_ingreso;
    public $folio_mp;
    public $operador_mp;
    public $descripcion_salud;

    public $id_droga;
    public $medicamentos;
    public $terapia_individual;
    public $terapia_ocupacional;

    public $clinica; 

    public function ajaxListarExpedientes(){

        $expedientes = ExpedientesControlador::ctrListarExpedientes($this->id_clinica);

        echo json_encode($expedientes, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxBuscarExpedientes($id_expediente,$id_clinica){

        $expedientes = ExpedientesControlador::ctrBuscarExpedientes($id_clinica,$id_expediente);

        echo json_encode($expedientes, JSON_UNESCAPED_UNICODE);
    }
   
    public function ajaxBuscarExpedienteXcliente($id_paciente,$id_clinica ){

        $expedientesxcliente = ExpedientesControlador::ctrBuscarExpedienteXcliente($id_paciente,$id_clinica);

        echo json_encode($expedientesxcliente, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxListarFolioExpedientes(){

        $folioexpedientes = ExpedientesControlador::ctrListarFolioExpedientes($this->idclinica);
    
        echo json_encode($folioexpedientes, JSON_UNESCAPED_UNICODE);
    }
    
    public function ajaxListarExpedientesadmin(){

        $expedientes = ExpedientesControlador::ctrListarExpedientesadmin();
        echo json_encode($expedientes);     
   }

    public function ajaxRegistrarExpedientes(){
        
        $Expediente = ExpedientesControlador::ctrRegistrarExpediente($this->id_expediente, 
        $this->id_clinica, $this->id_paciente, 
        $this->id_representante, 
        $this->fecha_ingreso,        
                    $this->fecha_salida,$this->firmo_contrato,$this->tiempo_duracion,$this->hora_ingreso,
                    $this->cuota_ingreso,$this->cuota_semanal,$this->extras,$this->testigo,
                    $this->estatus,
                    $this->tipo_ingreso,$this->refiere_institucion,$this->motivo_ingreso,$this->folio_mp,
                    $this->operador_mp,$this->descripcion_salud,
                    $this->id_droga,$this->medicamentos,$this->terapia_individual, $this->terapia_ocupacional);

        echo json_encode($Expediente);
    }

   

    public function ajaxActualizarExpedientes($data){
        
        $table = "tblExpedientes";
        $id = $_POST["id_expediente"];
        $nameId = "id_expediente";
        $id_clinica = $_SESSION['S_IDCLINICA'];
        $nameId2 = "id_clinica";
        $respuesta = ExpedientesControlador::ctrActualizarExpediente($table, $data, $id, $nameId,$id_clinica,$nameId2);

        echo json_encode($respuesta);
    }

    public function ajaxEliminarExpediente(){

        $table = "tblexpedientes"; 
        $id = $_POST["id_expediente"]; 
        $nameId = "id_expediente";
        $id_clinica = $_SESSION['S_IDCLINICA'];
        $nameId2 = "id_clinica";
        $respuesta = ExpedientesControlador::ctrEliminarExpediente($table, $id, $nameId,$id_clinica,$nameId2);

        echo json_encode($respuesta);
    }

    /*===================================================================
    LISTAR NOMBRE DE Expedientes PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    public function ajaxListarNombreExpedientes(){

        $NombreExpediente = ExpedientesControlador::ctrListarNombreExpedientes();

        echo json_encode($NombreExpediente);
    }

    /*===================================================================
    BUSCAR Expedientes POR SU ID
    ====================================================================*/
    public function ajaxGetDatosExpediente(){
     
        $Expediente = ExpedientesControlador::ctrGetDatosExpediente($this->id);
        echo json_encode($Expediente);
    }


}

if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar Expedientes

    
    if( $_SESSION['S_ROL']==1){
        $expedientes = new ajaxExpedientes();
        $expedientes -> ajaxListarExpedientesadmin();
       }
       else{
        $expedientes = new AjaxExpedientes();
        $expedientes -> id_clinica = $_SESSION['S_IDCLINICA']; 
        $expedientes -> ajaxListarExpedientes();
       }

    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Expedientes

    $registrarExpediente = new AjaxExpedientes();
    $registrarExpediente -> id_expediente = $_POST["id_expediente"];
    $registrarExpediente -> id_clinica = $_SESSION['S_IDCLINICA']; 
    $registrarExpediente -> id_paciente = $_POST["id_paciente"];
    $registrarExpediente -> id_representante = $_POST["id_representante"];
    $registrarExpediente -> fecha_ingreso = $_POST["fecha_ingreso"];
    $registrarExpediente -> fecha_salida = $_POST["fecha_salida"];
    $registrarExpediente -> firmo_contrato = $_POST["firmo_contrato"];
    $registrarExpediente -> tiempo_duracion = $_POST["tiempo_duracion"];
    $registrarExpediente -> hora_ingreso= $_POST["hora_ingreso"];
    $registrarExpediente -> cuota_ingreso = $_POST["cuota_ingreso"];
    $registrarExpediente -> cuota_semanal = $_POST["cuota_semanal"];
    $registrarExpediente -> extras = $_POST["extras"];
    $registrarExpediente -> testigo = $_POST["testigo"];  
    $registrarExpediente -> estatus = $_POST["estatus"];   

    $registrarExpediente -> tipo_ingreso = $_POST["tipo_ingreso"];
    $registrarExpediente -> refiere_institucion = $_POST["refiere_institucion"];
    $registrarExpediente -> motivo_ingreso = $_POST["motivo_ingreso"];
    $registrarExpediente -> folio_mp = $_POST["folio_mp"];
    $registrarExpediente -> operador_mp = $_POST["operador_mp"];
    $registrarExpediente -> descripcion_salud = $_POST["descripcion_salud"];

    $registrarExpediente -> id_droga = $_POST["id_droga"];
    $registrarExpediente -> medicamentos = $_POST["medicamentos"];
    $registrarExpediente -> terapia_individual = $_POST["terapia_individual"];
    $registrarExpediente -> terapia_ocupacional = $_POST["terapia_ocupacional"];

   
    $registrarExpediente -> ajaxRegistrarExpedientes(); 

}
else if(isset($_POST['accion']) && $_POST['accion'] == 22){ // parametro para registrar Expedientes

    $registrarExpedienteServiciosMedicos = new AjaxExpedientes();
    $registrarExpedienteServiciosMedicos -> id_expediente = $_POST["id_expediente"];
    $registrarExpedienteServiciosMedicos -> id_clinica = $_SESSION['S_IDCLINICA']; 
    $registrarExpedienteServiciosMedicos -> motivo_atencion = $_POST["motivo_atencion"];
    $registrarExpedienteServiciosMedicos -> reporte_lesion = $_POST["reporte_lesion"];
    $registrarExpedienteServiciosMedicos -> diagnostico = $_POST["diagnostico"];
    $registrarExpedienteServiciosMedicos -> plan_terapeutico = $_POST["plan_terapeutico"];
    $registrarExpedienteServiciosMedicos -> pronostico = $_POST["pronostico"];
    $registrarExpedienteServiciosMedicos -> cedula_medico = $_POST["cedula_medico"];
    $registrarExpedienteServiciosMedicos -> duracion_consulta= $_POST["duracion_consulta"];
    $registrarExpedienteServiciosMedicos -> nombre_medico = $_POST["nombre_medico"];
    $registrarExpedienteServiciosMedicos -> fecha_notificacion = $_POST["fecha_notificacion"];
    $registrarExpedienteServiciosMedicos -> fecha_notificacion = $_POST["fecha_notificacion"];
    $registrarExpedienteServiciosMedicos -> agencia_mp = $_POST["agencia_mp"];  
    $registrarExpedienteServiciosMedicos -> domicilio_agencia = $_POST["domicilio_agencia"];   
    $registrarExpedienteServiciosMedicos -> ajaxRegistrarExpedientes(); 

}
else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Paciente
 
    $actualizarExpediente = new AjaxExpedientes();

    $data = array(
        "id_expediente" => $_POST["id_expediente"],
        "id_clinica" => $_SESSION['S_IDCLINICA'],
        "id_paciente" => $_POST["id_paciente"],
        "id_representante" => $_POST["id_representante"],
        "fecha_ingreso" => $_POST["fecha_ingreso"],
        "fecha_salida" => $_POST["fecha_salida"],
        "firmo_contrato" => $_POST["firmo_contrato"],
        "tiempo_duracion" => $_POST["tiempo_duracion"],
        "hora_ingreso" => $_POST["hora_ingreso"],
        "cuota_ingreso" => $_POST["cuota_ingreso"],
        "cuota_semanal" => $_POST["cuota_semanal"],
        "extras" => $_POST["extras"],
        "testigo" => $_POST["testigo"],
        "estatus" => $_POST["estatus"],

        "tipo_ingreso" => $_POST["tipo_ingreso"],
        "refiere_institucion" => $_POST["refiere_institucion"],
        "motivo_ingreso" => $_POST["motivo_ingreso"],
        "folio_mp" => $_POST["folio_mp"],
        "operador_mp"=> $_POST["operador_mp"],
        "descripcion_salud" => $_POST["descripcion_salud"],

        "id_droga" => $_POST["id_droga"],
        "medicamentos" => $_POST["medicamentos"],
        "terapia_individual"=> $_POST["terapia_individual"],
        "terapia_ocupacional" => $_POST["terapia_ocupacional"],
    );
                           
    $actualizarExpediente -> ajaxActualizarExpedientes($data);
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN Expediente

    $eliminarExpediente = new ajaxExpedientes();
    $data = array(
        "id_expediente" => $_POST["id_expediente"],
        "id_clinica" => $_POST["id_clinica"],      
    );
    $eliminarExpediente -> ajaxEliminarExpediente($data);

}
else if(isset($_POST['accion']) && $_POST['accion'] == 55){// ACCION PARA consultar expediente

    $buscarExpediente = new ajaxExpedientes();
    $buscarExpediente-> ajaxBuscarExpedientes($_POST['id_expediente'],
    $buscarExpediente-> id_clinica = $_SESSION['S_IDCLINICA']
 );
}

else if(isset($_POST["accion"]) && $_POST["accion"] ==  556){ // verifica si ya realizó el pago de la cuota de ingreso
   
    $buscacliente= new AjaxExpedientes();
    $buscacliente-> ajaxBuscarExpedienteXcliente($_POST['id_paciente'],
    $buscacliente-> id_clinica = $_SESSION['S_IDCLINICA']
 );
}
else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE Expedientes PARA EL AUTOCOMPLETE

    $nombreExpedientes = new AjaxExpedientes();
   
    $nombreExpedientes -> ajaxListarNombreExpedientes();

}else if(isset($_POST['accion']) && $_POST['accion'] == 11){ // folio de expedientes

    $folioExpedientes = new ajaxExpedientes();
    $folioExpedientes -> idclinica = $_SESSION['S_IDCLINICA']; 
    $folioExpedientes ->  ajaxListarFolioExpedientes();
    
}
else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN Expediente POR SU ID

    $listaExpediente = new AjaxExpedientes();

    $listaExpediente -> id = $_POST["id"];
    
    $listaExpediente -> ajaxGetDatosExpediente();

}else if(isset($_FILES)){
   
}