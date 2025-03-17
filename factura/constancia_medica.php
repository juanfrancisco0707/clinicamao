<?php
	$subtotal 	= 0;
	$iva 	 	= 0;
	$impuesto 	= 0;
	$tl_sniva   = 0;
	$total 		= 0;
 //print_r($configuracion); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>NOTIFICACION AL MINISTERIO PUBLICO</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php echo $anulada; ?>
<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="logo_factura">
			<?php
				if($factura[0]["id_clinica"] == 1){
					
				 ?>
				<div>
				
					<img src="img/logoced.png">

				</div>
				<?php
				}
				else
				{
					?>
					<div>
				
				<img src="img/logovalleverde.png">

			</div>
			<?php
					}
				 ?>
			</td>
			<td class="info_empresa">
				<?php
					if($result_config > 0){
					
				 ?>
				<div>
					<span class="h2"><?php echo strtoupper($factura[0]['nombre_clinica']); ?></span>
					
					<p><?php echo $factura[0]['direccion_clinica']; ?></p>
				
					<p>Teléfono: <?php echo $factura[0]['telefono_clinica']; ?></p>
					
				</div>
				<?php
					}
				 ?>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3">Recibo</span>
					<p>No. Recibo: <strong><?php echo $factura[0]['folio']; ?></strong></p>
					<p>Fecha: <?php echo $factura[0]['fecha_pago']; ?></p>
					
					<p>Usuario: <?php echo $_SESSION['S_NOMBRE']; ?> </p>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Paciente</span>
					<table class="datos_cliente">
						<tr>
							<td><label>C.AGENTE DEL MINISTERIO PUBLICO EN TURNO</label></td>
							<td><label>PROCURADURIA GENERAL DE JUSTICIA DEL ESTADO DE SINALOA EN GUASAVE</label></td>
							<td><label>Con el objeto de dar cumplimiento a lo dispuesto por  <spam class="negrita">la Norma Oficial Mexicana NOM-028-SSA2-2009</spam>, Para la</label></td>
							<td><label>Prevención, Tratamiento y Control de las Adicciones en su numeral 5.3.2, mismas que establece que, todo internamiento</label></td>
							<td><label>involuntario deberá ser notificado por el responsable del establecimiento al Ministerio Público de la adscripción, en un</label></td>
							<td><label>plazo no mayor de 24 horas posteriores a la admisión, me permito informarle los datos relativos a la notificación.</label></td>
     					</tr>
						
					</table>
				</div>
			</td>

		</tr>
	</table>

	
	
</div>

</body>
</html>