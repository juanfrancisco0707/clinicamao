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
		echo "No es posible generar la notificación del Ministerio Público.";
	}else{
		//echo "pasó a buscar los datos";
		$expediente = $_REQUEST['expediente'];
		$clinica = $_REQUEST['id_clinica'];
		//$noFactura = $_REQUEST['f'];
		$anulada = '';
		$result_config = 1;
		$result_detalle=1;

		$stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_ingreso, '%d/%m/%Y') as fecha_ingreso , DATE_FORMAT(FECHA_NACIMIENTO, '%d/%m/%Y') as FECHA_NACIMIENTO
		, DATE_FORMAT(sa.fecha_notificacion, '%d/%m/%Y') as fecha_notificacion from vta_hoja_ingreso
		vi INNER JOIN tblservicios_atencion sa ON vi.id_expediente = sa.id_expediente and vi.id_clinica = sa.id_clinica
		WHERE vi.id_expediente = :expediente and vi.id_clinica =:clinica");  
		$stmt -> bindParam(":expediente", $expediente , PDO::PARAM_STR);
		$stmt -> bindParam(":clinica", $clinica , PDO::PARAM_STR);

		if($stmt->execute()){
			$consulta_expediente = $stmt->fetchall(PDO::FETCH_ASSOC);
			//Total registros.
			$nr = $stmt->rowCount();
			
	

		//$result = mysqli_num_rows($query);
		if($nr > 0){
			$expediente = $consulta_expediente[0]["id_expediente"];
			//$factura = mysqli_fetch_assoc($query);
			//$no_factura = $factura['folio'];

		
			ob_start();
		    include(dirname('__FILE__').'/notificacion_mp_plantilla.php');
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('notificacion_mp_'.$expediente.'.pdf',array('Attachment'=>0));
			exit;
			}
		}	
	}
?>