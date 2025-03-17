<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../index.php');
}
    include_once('tbs_class.php'); 
    include_once('plugins/tbs_plugin_opentbs.php'); 
    require_once "controladores/expedientes.controlador.php";
    require_once "modelos/expedientes.modelo.php";
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
           
            
        }
        public function imprimir(){
           
        

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
// $data = array(
//    "id_paciente" => $_POST["id_paciente"],
//    "id_clinica" => $_POST["id_clinica"], );
//$contarExpediente -> ajaxContarExpedientes($data);

}

   
    //Parametros
    //$nomclinica='COMUNIDAD TERAPEUTICA VALLE VERDE AC';
    //$numingprevios='1';
   
/* lo convierte a pdf
set_time_limit(0);


function MakePropertyValue($name,$value,$osm){
$oStruct = $osm->Bridge_GetStruct("com.sun.star.beans.PropertyValue");
$oStruct->Name = $name;
$oStruct->Value = $value;
return $oStruct;
}
function word2pdf($doc_url, $output_url){

//Invoke the OpenOffice.org service manager
$osm = new COM("com.sun.star.ServiceManager") or die ("Please be sure that OpenOffice.org is installed.\n");
//Set the application to remain hidden to avoid flashing the document onscreen
$args = array(MakePropertyValue("Hidden",true,$osm));
//Launch the desktop
$oDesktop = $osm->createInstance("com.sun.star.frame.Desktop");
//Load the .doc file, and pass in the "Hidden" property from above
$oWriterDoc = $oDesktop->loadComponentFromURL($doc_url,"_blank", 0, $args);
//Set up the arguments for the PDF output
$export_args = array(MakePropertyValue("FilterName","writer_pdf_Export",$osm));
//print_r($export_args);
//Write out the PDF
$oWriterDoc->storeToURL($output_url,$export_args);
$oWriterDoc->close(true);
}

$output_dir = "C:/wamp/www/projectfolder/";
$doc_file = "C:/wamp/www/projectfolder/wordfile.docx";
$pdf_file = "outputfile_name.pdf";

$output_file = $output_dir . $pdf_file;
$doc_file = "file:///" . $doc_file;
$output_file = "file:///" . $output_file;
word2pdf($doc_file,$output_file);
*/
   
?>