<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../index.php');
}
	require_once "../modelos/conexion.php";
	require_once '../pdf/vendor/autoload.php';
	use Dompdf\Dompdf;

	if(empty($_REQUEST['expediente']) ) //|| empty($_REQUEST['f'])
	{
		echo "No es posible generar el reporte de condiciones generales de ingreso";
	}else{
		//echo "pasó a buscar los datos";
		$expediente = $_REQUEST['expediente'];
		//$noFactura = $_REQUEST['f'];
		$anulada = '';
		$result_config = 1;
		$result_detalle=1;

		$stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_ingreso, '%d/%m/%Y') as fecha_ingreso , DATE_FORMAT(FECHA_NACIMIENTO, '%d/%m/%Y') as FECHA_NACIMIENTO from vta_hoja_ingreso 	WHERE id_expediente = :expediente");  
		$stmt -> bindParam(":expediente", $expediente , PDO::PARAM_STR);									                                      
		if($stmt->execute()){
			$consulta_expediente = $stmt->fetchall(PDO::FETCH_ASSOC);
			//Total registros.
			$nr = $stmt->rowCount();
			$expediente = $consulta_expediente[0]["id_expediente"];
	

		//$result = mysqli_num_rows($query);
		if($nr > 0){
			$periodo = $consulta_expediente[0]['tiempo_duracion'];
			$numeros = ["0","1","2","3","4","5","6","7","8","9"];
			$letras = ["cero ","uno ","dos ", "tres ", "cuatro ","cinco ","seis ","siete ","ocho ","nueve "];
			$periodoletra=str_replace($numeros, $letras, $periodo);
			$hora = date("H:i"); 
			$dia = date("d");
			$mes = date("F");
			if($mes=='July') $mes = 'Julio';
			if($mes=='August') $mes = 'Agosto';
			switch ($mes) {
				case "January":
					$mes = 'Enero';
				  break;
				case "February":
					$mes = 'Febrero';
				  break;
				case "March":
					$mes = 'Marzo';
					break;
				case "April":
					$mes = 'Abril';
					break;
				case "May":
					$mes = 'Mayo';
					break;
				case "June":
					$mes = 'Junio';
					break;
				case "July":
					$mes = 'Julio';
					break;
				case "August":
					$mes = 'Agosto';
					break;
				case "September":
					$mes = 'Septiembre';
					break;
				case "October":
					$mes = 'Octubre';
					break;
				case "September":
					$mes = 'Septiembre';
					break;
				case "October":
					$mes = 'Octubre';
					break;
				case "November":
					$mes = 'Noviembre';
					break;
				case "December":
					$mes = 'Diciembre';
					break;

				default:
				  echo "sm";
			  }
			

			$anio = date("Y");
			
			ob_start();
		    include(dirname('__FILE__').'/condiciones_generales_ingreso_plantilla.php');
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('condiciones_generales_ingreso_'.$expediente.'.pdf',array('Attachment'=>0));
			exit;
			}
		}	
	}

	
?>