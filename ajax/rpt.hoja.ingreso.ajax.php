<?php
ob_start();
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../index.php');
}
    require "../reportes/plantilla.php";
    require_once "../controladores/expedientes.controlador.php";
    require_once "../modelos/expedientes.modelo.php";
    class AjaxExpedientesReporte{
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
        public $clinica;
        public $numingprevios; 
        public $expedientesvistas;
        public $dirclinica;
        public $nompaciente;
        public $fechaingreso;
        public $sexo;
        public $fechanacimiento;
        public $edad;
        public $direccion;
        public $numexp;
        public $telefono;
        public $nacionalidad;
        public $escolaridad;
        public $ocupacion;
        public $nomclinica;
    
        public function ajaxImprimirExpedientes(){

            $nomclinica=$this->clinica;
          //  $expedientes = ExpedientesControlador::ctrListarExpedientes($this->id_clinica);
    
           // echo json_encode($expedientes, JSON_UNESCAPED_UNICODE);
        }
        public function ajaxContarExpedientes(){

            $expedientes = ExpedientesControlador::ctrContarExpedientes($this->id_clinica,$this->id_paciente);
    
            echo json_encode($expedientes, JSON_UNESCAPED_UNICODE);
            $numingprevios = $expedientes[0][0];
        }
        public function ajaxVistasExpedientes(){

            $expedientesvistas = ExpedientesControlador::ctrVistasExpedientes($this->id_clinica,$this->id_expediente);
    
            echo json_encode($expedientesvistas, JSON_UNESCAPED_UNICODE);
            $nomclinica= $expedientesvistas[0][34];
            $dirclinica= $expedientesvistas[0][35]; // direccion de la clinica
            $nompaciente=$expedientesvistas[0][21]; //nombre del paciente
            $fechaingreso=$expedientesvistas[0][4];
            $sexo=$expedientesvistas[0][22];
            $fechanacimiento =$expedientesvistas[0][23];
            $edad =$expedientesvistas[0][24];
            $direccion=$expedientesvistas[0][25];
            $hora=$expedientesvistas[0][8];
            $numexp=$expedientesvistas[0][0];
            $estadocivil=$expedientesvistas[0][27];
            $telefono=$expedientesvistas[0][26];
            $nacionalidad=$expedientesvistas[0][32];
            $escolaridad=$expedientesvistas[0][28];
            $ocupacion=$expedientesvistas[0][31];
            


          /*  ob_end_clean();                           //limpia el buffer de salida para poder generar el pdf
            $pdf = new PDF("P", "mm", "letter");
            $pdf->AliasNbPages();
            $pdf->SetMargins(10, 10, 10);
            $pdf->AddPage();
            $pdf->SetFont("Arial", "B", 9);
            $pdf->Cell(10, 5, "Fecha y hora de ingreso:", 1, 0, "C");
            $pdf->Cell(20, 5, "Edad", 1, 0, "C");
            $pdf->SetFont("Arial", "", 9);
            $pdf->Cell(10, 5, $fechaingreso, 1, 0, "C");
            $pdf->Output(F,'/var/www/html/PATH/filename.pdf');*/
           
        

            
        }
        public function imprimir(){
            $pdf = new PDF("P", "mm", "letter");
            $pdf->AliasNbPages();
            $pdf->SetMargins(10, 10, 10);
            $pdf->AddPage();
            $pdf->SetFont("Arial", "B", 9);
            $pdf->Cell(10, 5, "Fecha y hora de ingreso:", 1, 0, "C");
            $pdf->Cell(20, 5, "Edad", 1, 0, "C");
            $pdf->SetFont("Arial", "", 9);
            $pdf->Cell(10, 5, $this->fechaingreso, 1, 0, "C");
            $filename = "nombre_del_archivo.pdf";
            $pdf->output($filename,"F");
            //$pdf->Output();


        }
    
    }

  
    if(isset($_POST['accion']) && $_POST['accion'] == 7){ // parametro para listar Expedientes

    
       
            $expedientes = new AjaxExpedientesReporte();
            $expedientes -> id_clinica = $_SESSION['S_IDCLINICA'];
            $expedientes -> clinica = $_SESSION['S_CLINICA'];
            $expedientes -> ajaxImprimirExpedientes();

    
        
    }else
     if(isset($_POST['accion']) && $_POST['accion'] == 77){// ACCION PARA CONSULTAR EL NUMERO DE EXPEDIENTES DE UN PACIENTE

    $contarExpediente = new ajaxExpedientesReporte();
    $contarExpediente ->id_paciente =$_POST["id_paciente"];
    $contarExpediente ->id_clinica = $_POST["id_clinica"];
    $contarExpediente -> ajaxContarExpedientes();
   // $data = array(
    //    "id_paciente" => $_POST["id_paciente"],
    //    "id_clinica" => $_POST["id_clinica"], );
    //$contarExpediente -> ajaxContarExpedientes($data);

}else
if(isset($_POST['accion']) && $_POST['accion'] == 78){// ACCION PARA CONSULTAR EL NUMERO DE EXPEDIENTES DE UN PACIENTE

    $contarExpediente = new ajaxExpedientesReporte();
    $contarExpediente ->id_paciente =$_POST["id_paciente"];
    $contarExpediente ->id_clinica = $_POST["id_clinica"];
    $contarExpediente -> ajaxContarExpedientes();
    // $data = array(
//    "id_paciente" => $_POST["id_paciente"],
//    "id_clinica" => $_POST["id_clinica"], );
//$contarExpediente -> ajaxContarExpedientes($data);

}else
if(isset($_POST['accion']) && $_POST['accion'] == 79){// ACCION PARA CONSULTAR EL NUMERO DE EXPEDIENTES DE UN PACIENTE

        $vistasExpediente = new ajaxExpedientesReporte();
        $vistasExpediente ->id_expediente =$_POST["id_expediente"];
        $vistasExpediente ->id_clinica = $_POST["id_clinica"];
        $vistasExpediente -> ajaxVistasExpedientes();
        $vistasExpediente -> imprimir();
// $data = array(
//    "id_paciente" => $_POST["id_paciente"],
//    "id_clinica" => $_POST["id_clinica"], );
//$contarExpediente -> ajaxContarExpedientes($data);

}
ob_end_flush(); 
?>