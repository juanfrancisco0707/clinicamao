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
		echo "No es posible generar la hoja de Ingreso";
	}else{
		//echo "pasó a buscar los datos";
		$expediente = $_REQUEST['expediente'];
		//$noFactura = $_REQUEST['f'];
		$anulada = '';
		$result_config = 1;
		$result_detalle=1;

		$stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha_ingreso, '%d/%m/%Y') as fecha_ingreso, DATE_FORMAT(FECHA_NACIMIENTO, '%d/%m/%Y') as FECHA_NACIMIENTO from vta_hoja_ingreso 	WHERE id_expediente = :expediente");  
		$stmt -> bindParam(":expediente", $expediente , PDO::PARAM_STR);									                                      
		if($stmt->execute()){
			$consulta_expediente = $stmt->fetchall(PDO::FETCH_ASSOC);
			//Total registros.
			$nr = $stmt->rowCount();
			$expediente = $consulta_expediente[0]["id_expediente"];
			$id_paciente = $consulta_expediente[0]["id_paciente"];
			$stmtp = Conexion::conectar()->prepare("SELECT DATE_FORMAT(fecha_ingreso, '%d/%m/%Y') as fecha_ingreso from tblexpedientes 	WHERE id_paciente = :id_paciente");  
			$stmtp -> bindParam(":id_paciente", $id_paciente , PDO::PARAM_STR);	
			if($stmtp->execute()){
				$consulta_expediente_p = $stmtp->fetchall(PDO::FETCH_ASSOC);
				$nrp =$stmtp->rowCount();
			}
		//$result = mysqli_num_rows($query);
		if($nr > 0){

			//$factura = mysqli_fetch_assoc($query);
			//$no_factura = $factura['folio'];

		
			ob_start();
		    include(dirname('__FILE__').'/hojadeingreso_plantilla.php');
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('hojadeingreso_'.$expediente.'.pdf',array('Attachment'=>0));
			exit;
			}
		}	
	}
?>