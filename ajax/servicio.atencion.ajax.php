<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}

require_once "../controladores/servicio.atencion.controlador.php";
require_once "../modelos/servicio.atencion.modelo.php";

class AjaxServicioAtencion{
    public $id_expediente;
    public $id_clinica;
    public $motivo_atencion;
    public $reporte_atencion;
    public $diagnostico;
    public $plan_terapeutico;
    public $pronostico;
    public $cedula_medico;
    public $duracion_consulta;
    public $nombre_medico;
    public $fecha_notificacion;
    public $agencia_mp;
    public $domicilio_agencia;

    public function ajaxListarServicioAtencion(){

        $ServicioAtencion = ServicioAtencionControlador::ctrListarServicioAtencion($this->id_clinica);

        echo json_encode($ServicioAtencion, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxBuscarServicioAtencion($id_expediente,$id_clinica){

        $ServicioAtencion = ServicioAtencionControlador::ctrBuscarServicioAtencion($id_clinica,$id_expediente);

        echo json_encode($ServicioAtencion, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxBuscarServicioAtencionXexpediente($id_expediente,$id_clinica){

        $ServicioAtencion = ServicioAtencionControlador::ctrBuscarServicioAtencionXe($id_clinica,$id_expediente);

        echo json_encode($ServicioAtencion, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxBuscarExpedientesAtencionMedica($id_expediente,$id_clinica){

        $expedientes = ServicioAtencionControlador::ctrBuscarServicioAtencion($id_clinica,$id_expediente);

        echo json_encode($expedientes, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxBuscarExpedienteXcliente($id_paciente,$id_clinica ){

        $ServicioAtencionxcliente = ServicioAtencionControlador::ctrBuscarExpedienteXcliente($id_paciente,$id_clinica);

        echo json_encode($ServicioAtencionxcliente, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxListarFolioServicioAtencion(){

        $folioServicioAtencion = ServicioAtencionControlador::ctrListarFolioServicioAtencion($this->idclinica);
    
        echo json_encode($folioServicioAtencion, JSON_UNESCAPED_UNICODE);
    }
    
    public function ajaxListarServicioAtencionadmin(){

        $ServicioAtencion = ServicioAtencionControlador::ctrListarServicioAtencionadmin();
        echo json_encode($ServicioAtencion);     
   }

    public function ajaxRegistrarServicioAtencion(){
        
        $Expediente = ServicioAtencionControlador::ctrRegistrarServicioAtencion($this->id_expediente, 
        $this->id_clinica, $this->motivo_atencion, 
        $this->reporte_lesion, 
        $this->diagnostico,        
        $this->plan_terapeutico,$this->pronostico,$this->cedula_medico,$this->duracion_consulta,
        $this->nombre_medico,$this->fecha_notificacion,$this->agencia_mp,$this->domicilio_agencia);

        echo json_encode($Expediente);
    }

   

    public function ajaxActualizarServicioAtencion($data){
        
        $table = "tblServicios_Atencion";
        $id = $_POST["id_expediente"];
        $nameId = "id_expediente";
        $id_clinica = $_SESSION['S_IDCLINICA'];
        $nameId2 = "id_clinica";
        $respuesta = ServicioAtencionControlador::ctrActualizarExpediente($table, $data, $id, $nameId,$id_clinica,$nameId2);

        echo json_encode($respuesta);
    }

    public function ajaxEliminarExpediente(){

        $table = "tblServicios_Atencion"; 
        $id = $_POST["id_expediente"]; 
        $nameId = "id_expediente";
        $id_clinica = $_SESSION['S_IDCLINICA'];
        $nameId2 = "id_clinica";
        $respuesta = ServicioAtencionControlador::ctrEliminarExpediente($table, $id, $nameId,$id_clinica,$nameId2);

        echo json_encode($respuesta);
    }

    /*===================================================================
    LISTAR NOMBRE DE ServicioAtencion PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    public function ajaxListarNombreServicioAtencion(){

        $NombreExpediente = ServicioAtencionControlador::ctrListarNombreServicioAtencion();

        echo json_encode($NombreExpediente);
    }

    /*===================================================================
    BUSCAR ServicioAtencion POR SU ID
    ====================================================================*/
    public function ajaxGetDatosExpediente(){
     
        $Expediente = ServicioAtencionControlador::ctrGetDatosExpediente($this->id);
        echo json_encode($Expediente);
    }


}

if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar ServicioAtencion

    
    if( $_SESSION['S_ROL']==1){
        $ServicioAtencion = new ajaxServicioAtencion();
        $ServicioAtencion -> ajaxListarServicioAtencionadmin();
       }
       else{
        $ServicioAtencion = new AjaxServicioAtencion();
        $ServicioAtencion -> id_clinica = $_SESSION['S_IDCLINICA']; 
        $ServicioAtencion -> ajaxListarServicioAtencion();
       }

    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar ServicioAtencion

    $servicioAtencion = new AjaxServicioAtencion();
    $servicioAtencion -> id_expediente = $_POST["id_expediente"];
    $servicioAtencion -> id_clinica = $_SESSION['S_IDCLINICA']; 
    $servicioAtencion -> motivo_atencion = $_POST["motivo_atencion"];
    $servicioAtencion -> reporte_lesion = $_POST["reporte_lesion"];
    $servicioAtencion -> diagnostico = $_POST["diagnostico"];
    $servicioAtencion -> plan_terapeutico = $_POST["plan_terapeutico"];
    $servicioAtencion -> pronostico = $_POST["pronostico"];
    $servicioAtencion -> cedula_medico = $_POST["cedula_medico"];
    $servicioAtencion -> duracion_consulta= $_POST["duracion_consulta"];
    $servicioAtencion -> nombre_medico = $_POST["nombre_medico"];
    $servicioAtencion -> fecha_notificacion = $_POST["fecha_notificacion"];
    $servicioAtencion -> agencia_mp = $_POST["agencia_mp"];
    $servicioAtencion -> domicilio_agencia = $_POST["domicilio_agencia"];  
   
    $servicioAtencion -> ajaxRegistrarServicioAtencion(); 

}
else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Paciente
 
    $actualizarExpediente = new AjaxServicioAtencion();

    $data = array(
        "id_expediente" => $_POST["id_expediente"],
        "id_clinica" => $_SESSION['S_IDCLINICA'],
        "motivo_atencion" => $_POST["motivo_atencion"],
        "reporte_lesion" => $_POST["reporte_lesion"],
        "diagnostico" => $_POST["diagnostico"],
        "plan_terapeutico" => $_POST["plan_terapeutico"],
        "pronostico" => $_POST["pronostico"],
        "cedula_medico" => $_POST["cedula_medico"],
        "duracion_consulta" => $_POST["duracion_consulta"],
        "nombre_medico" => $_POST["nombre_medico"],
        "fecha_notificacion" => $_POST["fecha_notificacion"],
        "agencia_mp" => $_POST["agencia_mp"],
        "domicilio_agencia" => $_POST["domicilio_agencia"],
    );
                           
    $actualizarExpediente -> ajaxActualizarServicioAtencion($data);
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN Expediente

    $eliminarExpediente = new ajaxServicioAtencion();
    $data = array(
        "id_expediente" => $_POST["id_expediente"],
        "id_clinica" => $_POST["id_clinica"],      
    );
    $eliminarExpediente -> ajaxEliminarExpediente($data);

}
else if(isset($_POST['accion']) && $_POST['accion'] == 55){// ACCION PARA consultar expediente

    $buscarExpediente = new ajaxServicioAtencion();
    $buscarExpediente-> ajaxBuscarServicioAtencion($_POST['id_expediente'],
    $buscarExpediente-> id_clinica = $_SESSION['S_IDCLINICA']
 );
}
else if(isset($_POST["accion"]) && $_POST["accion"] ==  556){ // verifica si ya realizó el pago de la cuota de ingreso
   
    $buscacliente= new AjaxServicioAtencion();
    $buscacliente-> ajaxBuscarExpedienteXcliente($_POST['id_paciente'],
    $buscacliente-> id_clinica = $_SESSION['S_IDCLINICA']
 );
}
else if(isset($_POST['accion']) && $_POST['accion'] == 557){// ACCION PARA consultar datos del servicio de atencion médico

    $buscarExpedienteAtencionMedica = new AjaxServicioAtencion();
    $buscarExpedienteAtencionMedica-> ajaxBuscarExpedientesAtencionMedica($_POST['id_expediente'],
    $buscarExpedienteAtencionMedica-> id_clinica = $_SESSION['S_IDCLINICA']
 );
}
//ajaxBuscarServicioAtencionXexpediente
else if(isset($_POST['accion']) && $_POST['accion'] == 558){// ACCION PARA consultar datos del servicio de atencion médico

    $buscarExpedienteAtencionMedicaXe = new AjaxServicioAtencion();
    $buscarExpedienteAtencionMedicaXe-> ajaxBuscarServicioAtencionXexpediente($_POST['id_expediente'],
    $buscarExpedienteAtencionMedicaXe-> id_clinica = $_SESSION['S_IDCLINICA']
 );
}
else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE ServicioAtencion PARA EL AUTOCOMPLETE

    $nombreServicioAtencion = new AjaxServicioAtencion();
   
    $nombreServicioAtencion -> ajaxListarNombreServicioAtencion();

}else if(isset($_POST['accion']) && $_POST['accion'] == 11){ // folio de ServicioAtencion

    $folioServicioAtencion = new ajaxServicioAtencion();
    $folioServicioAtencion -> idclinica = $_SESSION['S_IDCLINICA']; 
    $folioServicioAtencion ->  ajaxListarFolioServicioAtencion();
    
}
else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN Expediente POR SU ID

    $listaExpediente = new AjaxServicioAtencion();

    $listaExpediente -> id = $_POST["id"];
    
    $listaExpediente -> ajaxGetDatosExpediente();

}else if(isset($_FILES)){
   
}