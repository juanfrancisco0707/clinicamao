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
		echo "No es posible generar el reporte de Carta Compromiso";
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

			$dia1 = date("d");
			$mes1 = date("m");
			$anio1 = date("Y");
			switch ($mes1) {
				case "01":
					$mes1 = 'Enero';
				  break;
				case "02":
					$mes1 = 'Febrero';
				  break;
				case "03":
					$mes1 = 'Marzo';
					break;
				case "04":
					$mes1 = 'Abril';
					break;
				case "05":
					$mes1 = 'Mayo';
					break;
				case "06":
					$mes1 = 'Junio';
					break;
				case "07":
					$mes1 = 'Julio';
					break;
				case "08":
					$mes1 = 'Agosto';
					break;
				case "09":
					$mes1 = 'Septiembre';
					break;
				case "10":
					$mes1 = 'Octubre';
					break;
				case "11":
					$mes1 = 'Noviembre';
					break;
				case "12":
					$mes1 = 'Diciembre';
					break;

				default:
				  echo "sm";
			  }
			ob_start();
		    include(dirname('__FILE__').'/carta_compromiso_plantilla.php');
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('carta_compromiso'.$expediente.'.pdf',array('Attachment'=>0));
			exit;
			}
		}	
	}

	
?>