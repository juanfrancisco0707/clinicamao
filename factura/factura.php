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
	<title>Ticket</title>
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
							<td><label>No:</label><p><?php echo $factura[0]['id_paciente']; ?></p></td>
							<td><label>Teléfono:</label> <p><?php echo $factura[0]['telefono']; ?></p></td>
						</tr>
						<tr>
							<td><label>Nombre:</label> <p><?php echo $factura[0]['NOMBRE']; ?></p></td>
							<td><label>Dirección:</label> <p><?php echo $factura[0]['DIRECCION']; ?></p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<table id="factura_detalle">
			<thead>
				<tr>
					<th width="50px">Cant.</th>
					<th class="textleft">Descripción</th>
					<th class="textright" width="150px">Precio Unitario.</th>
					<th class="textright" width="150px"> Precio Total</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">

			<?php
			
				if($result_detalle > 0){
					for($i=0;$i<$nr;$i++){
						//$row = factura[$i][]					
			 ?>
				<tr>
					<td class="textcenter"><?php echo $factura[$i]['cantidad']; ?></td>
					<td><?php echo $factura[$i]['descripcion_detalle']; ?></td>
					<td class="textright"><?php echo $factura[$i]['precio']; ?></td>
					<td class="textright"><?php echo $factura[$i]['importe']; ?></td>
				</tr>
			<?php
						$precio_total = $factura[0]['total'];
						$subtotal = 0;// round($subtotal + $precio_total, 2);
					}
				}

				$impuesto 	= 0;
				$tl_sniva 	= 0;
				
			?>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="3" class="textright"><span>SUBTOTAL</span></td>
					<td class="textright"><span><?php echo $tl_sniva; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>IVA (<?php echo $iva; ?> %)</span></td>
					<td class="textright"><span><?php echo $impuesto; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>TOTAL</span></td>
					<td class="textright"><span><?php echo $factura[0]['total']; ?></span></td>
				</tr>
		</tfoot>
	</table>
	<div>
		<p class="nota">Si usted tiene preguntas sobre este Recibo, <br>pongase en contacto con nombre, teléfono y Email</p>
		<h4 class="label_gracias">¡Gracias por su Pago!</h4>
	</div>

</div>

</body>
</html>