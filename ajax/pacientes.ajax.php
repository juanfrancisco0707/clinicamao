<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/pacientes.controlador.php";
require_once "../modelos/pacientes.modelo.php";
require_once "../modelos/folios.modelo.php";

require_once "../vendor/autoload.php";

class ajaxPacientes{

    public $filePacientes;

    public $id;
    public $nombre;
    public $sexo;
    public $fecha_nacimiento;
    public $edad;
    public $direccion;
    public $telefono;
    public $correo;
    public $estado_civil;
    public $escolaridad;
    public $id_ocupacion;
    public $id_nacionalidad;
    public $comorbilidad;
    public $idclinica;
   // public $fecha_creacion; Se graba automaticamente
  
    public $id_empresa;  
    public $estatus;     
    public $clinica;
    public $entidad;

    public function ajaxListarPacientes(){
        
        $pacientes = PacientesControlador::ctrListarPacientes($this->clinica);
        
        echo json_encode($pacientes);     
    }
    public function ajaxListarFolioEntidad(){

        $folio = PacientesControlador::ctrListarFolioEntidad($this->entidad, $this->id_empresa);

        echo json_encode($folio);

    }
    public function ajaxListarPacientesadmin(){
         $pacientes = PacientesControlador::ctrListarPacientesadmin();
         echo json_encode($pacientes);     
    }
    
    public function ajaxRegistrarPacientes(){
        
        $paciente = PacientesControlador::ctrRegistrarPaciente($this->id, $this->nombre,
        $this->sexo, 
        $this->fecha_nacimiento,        
                    $this->edad,$this->direccion,$this->telefono, $this->correo,
                    $this->estado_civil,$this->escolaridad,
                    $this->id_ocupacion,$this->id_nacionalidad,$this->comorbilidad,
                    $this->id_empresa,
                    $this->estatus);

        echo json_encode($paciente);
    }
    public function ajaxActualizarPacientes($data){
        
        $table = "tblpacientes";
        $id = $_POST["id"];
        $id_clinica = $_POST["id_empresa"];
        $nameId = "id";
    
        $respuesta = PacientesControlador::ctrActualizarPaciente($table, $data, $id,$id_clinica, $nameId);
    
        echo json_encode($respuesta);
    }
   

   /* public function ajaxActualizarPacientes($data){
        
        $table = "tblPacientes";
        $id = $_POST["id"];
        $nameId = "id";

        $respuesta = PacientesControlador::ctrActualizarPaciente($table, $data, $id, $nameId);

        echo json_encode($respuesta);
    }*/
    public function ajaxListarFolioPacientes(){

        $foliopacientes = PacientesControlador::ctrListarFolioPacientes($this->idclinica);
    
        echo json_encode($foliopacientes, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxEliminarPaciente(){

        $table = "tblPacientes"; 
        $id = $_POST["id"]; 
        $id_empresa = $_POST["id_empresa"];
        $nameId = "id";
        $nameId2 = "id_empresa";

        $respuesta = PacientesControlador::ctrEliminarPaciente($table, $id, $nameId,$id_empresa,$nameId2);
//                                                  $table, $id, $nameId,$id_clinica,$nameId2
        echo json_encode($respuesta);
    }

    /*===================================================================
    LISTAR NOMBRE DE Pacientes PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    public function ajaxListarNombrePacientes(){

        $NombrePaciente = PacientesControlador::ctrListarNombrePacientes();

        echo json_encode($NombrePaciente);
    }

    /*===================================================================
    BUSCAR PACIENTES POR SU ID
    ====================================================================*/
    public function ajaxGetDatosPaciente(){
     
        $paciente = PacientesControlador::ctrGetDatosPaciente($this->id);

        echo json_encode($paciente);
    }
/*===================================================================
    BUSCAR PACIENTES POR SU ID y ACTIVOS
    ====================================================================*/
    public function ajaxGetDatosPacienteActivo(){
     
        $paciente = PacientesControlador::ctrGetDatosPacienteActivo($this->id);

        echo json_encode($paciente);
    }

   
}
if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar Pacientes

   if( $_SESSION['S_ROL']==1){
    $pacientes = new ajaxPacientes();
    $pacientes -> ajaxListarPacientesadmin();
   }
   else{
    $pacientes = new ajaxPacientes();
    $pacientes -> clinica = $_SESSION['S_CLINICA']; 
    $pacientes -> ajaxListarPacientes();
   }
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Pacientes

    $registrarPaciente = new AjaxPacientes();
    $registrarPaciente -> id = $_POST["id"];
    $registrarPaciente -> nombre = $_POST["nombre"];
    $registrarPaciente -> sexo = $_POST["sexo"];
    $registrarPaciente -> fecha_nacimiento = $_POST["fecha_nacimiento"];
    $registrarPaciente -> edad = $_POST["edad"];
    $registrarPaciente -> direccion = $_POST["direccion"];
    $registrarPaciente -> telefono = $_POST["telefono"];
    $registrarPaciente -> correo = $_POST["correo"];
    $registrarPaciente -> estado_civil = $_POST["estado_civil"];
    $registrarPaciente -> escolaridad = $_POST["escolaridad"];
    $registrarPaciente -> id_ocupacion = $_POST["id_ocupacion"];
    $registrarPaciente -> id_nacionalidad = $_POST["id_nacionalidad"];
    $registrarPaciente -> comorbilidad = $_POST["comorbilidad"];   
    $registrarPaciente -> id_empresa = $_POST["id_empresa"];
    $registrarPaciente -> estatus = $_POST["estatus"];

    $registrarPaciente -> ajaxRegistrarPacientes();
    

}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Paciente
 
    $actualizarPaciente = new ajaxPacientes();

    $data = array(
        "id" => $_POST["id"],
        "nombre" => $_POST["nombre"],
        "sexo" => $_POST["sexo"],
        "fecha_nacimiento" => $_POST["fecha_nacimiento"],
        "edad" => $_POST["edad"],
        "direccion" => $_POST["direccion"],
        "telefono" => $_POST["telefono"],
        "correo" => $_POST["correo"],
        "estado_civil" => $_POST["estado_civil"],
        "escolaridad" => $_POST["escolaridad"],
        "id_ocupacion" => $_POST["id_ocupacion"],
        "id_nacionalidad" => $_POST["id_nacionalidad"],
        "comorbilidad" => $_POST["comorbilidad"],  
        "id_empresa" => $_POST["id_empresa"],
        "estatus" => $_POST["estatus"],
    );
                           
    $actualizarPaciente -> ajaxActualizarPacientes($data);
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 8){ // ACCION PARA MODIFICAR UN PACIENTE
 
        $actualizarPaciente = new ajaxPacientes();
    
        $data = array(
            "id" => $_POST["id"],
            "nombre" => $_POST["nombre"],
            "sexo" => $_POST["sexo"],
            "fecha_nacimiento" => $_POST["fecha_nacimiento"],
            "edad" => $_POST["edad"],
            "direccion" => $_POST["direccion"],
            "telefono" => $_POST["telefono"],
            "correo" => $_POST["correo"],
            "estado_civil" => $_POST["estado_civil"],
            "escolaridad" => $_POST["escolaridad"],
            "id_ocupacion" => $_POST["id_ocupacion"],
            "id_nacionalidad" => $_POST["id_nacionalidad"],
            "comorbilidad" => $_POST["comorbilidad"],
           // "fecha_creacion" => $_POST["fecha_creacion"],      
            "id_empresa" => $_POST["id_empresa"],
            "estatus" => $_POST["estatus"],
        );
                               
        $actualizarPaciente -> ajaxActualizarPacientes($data);
}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN PACIENTE

    $eliminarPaciente = new ajaxPacientes();
    $data = array(
        "id" => $_POST["id"],
        "id_empresa" => $_POST["id_empresa"],      
    );
    $eliminarPaciente -> ajaxEliminarPaciente($data);

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE Pacientes PARA EL AUTOCOMPLETE

    $nombrePacientes = new AjaxPacientes();
    $nombrePacientes -> ajaxListarNombrePacientes();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN PACIENTE POR SU ID

    $listaPaciente = new AjaxPacientes();

    $listaPaciente -> id = $_POST["id"];
    
    $listaPaciente -> ajaxGetDatosPaciente();

}else if(isset($_POST['accion']) && $_POST['accion'] == 11){ // folio de representantes
    $entidad = isset($_POST['entidad']) ? $_POST['entidad'] : 'paciente'; // valor por defecto
    //var_dump($entidad);
    //exit;
     $folioPacientes = new ajaxPacientes();
    $folioPacientes->entidad = $entidad;
    $folioPacientes->id_empresa = $_SESSION['S_IDCLINICA']; // ← lo tomas de la sesión
    $folioPacientes->ajaxListarFolioEntidad();
    
}
else if(isset($_POST["accion"]) && $_POST["accion"] == 99){ // OBTENER DATOS DE UN PACIENTE POR SU ID y ACTIVO

    $listaPacienteActivo = new AjaxPacientes();

    $listaPacienteActivo -> id = $_POST["id_paciente"];
    $listaPacienteActivo -> id_empresa = $_POST["id_empresa"];
    
    $listaPacienteActivo -> ajaxGetDatosPacienteActivo();

}
else if(isset($_FILES)){
   
}