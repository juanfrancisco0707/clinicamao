<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../index.php');
}
	require_once "../modelos/conexion.php";
	require_once '../pdf/vendor/autoload.php';
	use Dompdf\Dompdf;

	if(empty($_REQUEST['folio']) ) //|| empty($_REQUEST['f'])
	{
		echo "No es posible generar el recibo.";
	}else{
		//echo "pasó a buscar los datos";
		$folio = $_REQUEST['folio'];
		//$noFactura = $_REQUEST['f'];
		$anulada = '';
		$result_config = 1;
		$result_detalle=1;

		$stmt = Conexion::conectar()->prepare("SELECT h.nombre_clinica,h.direccion_clinica,
		h.telefono_clinica, Concat('Folio Nro: ',v.folio_detalle,' - Total Pago: $ ',Round(i.total,2),' - ',i.nombre) as nro_folio,
		v.folio_detalle as folio,h.id_clinica,
		v.descripcion_detalle,  v.cantidad, 
		concat('$ ',round(v.precio,2)) as precio,
		concat('$ ',round(v.importe,2)) as importe,
		concat('$ ',round(ing.total,2)) as total,
		DATE_FORMAT(ing.fecha_pago, '%d/%m/%Y') as fecha_pago,
		i.nombre,
		h.id_paciente, h.telefono,h.direccion
	   from tblingresos ing inner join tblingresos_detalles v on ing.folio = v.folio_detalle
					inner join vta_hoja_ingreso h on ing.id_expediente = h.id_expediente
					inner join vta_expedientes_pacientes_ingresos i on i.folio = v.folio_detalle
											WHERE v.folio_detalle = :folio");  
		$stmt -> bindParam(":folio", $folio , PDO::PARAM_STR);									                                      
		if($stmt->execute()){
			$factura = $stmt->fetchall(PDO::FETCH_ASSOC);
			//Total registros.
			$nr = $stmt->rowCount();
			$no_ticket = $factura[0]["folio"];
	

		//$result = mysqli_num_rows($query);
		if($nr > 0){

			//$factura = mysqli_fetch_assoc($query);
			//$no_factura = $factura['folio'];

		
			ob_start();
		    include(dirname('__FILE__').'/factura.php');
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('recibo_'.$no_ticket.'.pdf',array('Attachment'=>0));
			exit;
			}
		}	
	}
?>