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
    <link rel="stylesheet" href="style_constancia_medica.css">
</head>
<body>
<?php echo $anulada; ?>
<div id="page_pdf">
	<table id="consulta_expediente_head">
		<tr>
			<td class="logo_consulta_expediente">
			<?php
				if($consulta_expediente[0]["id_clinica"] == 1){
					
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
					<span class="h2"><?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></span>
					
					<p><?php echo $consulta_expediente[0]['direccion_clinica']; ?></p>
				
					<p>Teléfono: <?php echo $consulta_expediente[0]['telefono_clinica']; ?></p>
					
				</div>
				<?php
					}
				 ?>
			</td>
			<td class="info_consulta_expediente">
				<div class="round">
					<span class="h3">Expediente</span>
					<p>No. Expediente: <strong><?php echo $consulta_expediente[0]['id_expediente']; ?></strong></p>
					
				</div>
			</td>
		</tr>
	</table>
	<table id="consulta_expediente_cliente">
		<tr>
			<td class="info_cliente">
				<!-- <div class="round"> -->
					<span class="h3">NOTIFICACIÓN AL MINISTERIO PÚBLICO</span>
					<!--<table class="datos_cliente"> -->
					<!--	 <tr> -->
						<p ><strong>C.AGENTE DEL MINISTERIO PUBLICO EN TURNO </strong><br>  					
							<strong>PROCURADURIA GENERAL DE JUSTICIA DEL ESTADO DE SINALOA EN GUASAVE</strong> <br />
							<br />
						</p>
						<p class="palaign" >
							Con el objetivo de dar cumplimiento a lo dispuesto por <strong> la Norma Oficial Mexicana NOM-028-SSA2-2009</strong>, para la 
							Prevención, Tratamiento y Control de las Adicciones, en su numeral 5.3.2, el cual establece que, todo internamiento
							involuntario deberá ser notificado por el representante legal del establecimiento, al Ministerio Público de la adscripción, 
						    en un plazo no mayor de 24 horas posteriores a la admisión, me permito informarle los datos relativos a la notificación:		
						</p>
						<br /> 
						<br /> 
						<p ><strong>Datos generales del establecimiento: </strong><br></p>
						<br /> 
						<p>Nombre completo: <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></p>
						<p>Domicilio completo: <?php echo $consulta_expediente[0]['direccion_clinica']; ?></p>
						<p>Teléfono: <?php echo $consulta_expediente[0]['telefono_clinica']; ?></p>
						<br /> 
						
						<p ><strong>1. Datos del usuario y/o del familiar que realizó la solicitud de ingreso </strong><br>
						<p>Nombre completo del usuario: <strong><u> <?php echo strtoupper($consulta_expediente[0]['nombre']); ?> </u></strong> </p>
						<p> Sexo:&nbsp;&nbsp;&nbsp;&nbsp; 
						<?php
				if($consulta_expediente[0]["sexo"] == 'Masculino'){
					
				 ?>
				<strong><u>(&nbsp;H&nbsp;)</u></strong>&nbsp;&nbsp;  (&nbsp;M&nbsp;)  
				<?php
				}
				else
				{
					?>
					(&nbsp;H&nbsp;)&nbsp;&nbsp; <strong><u>(&nbsp;M&nbsp;)</u> </strong>
			<?php
					}
				 ?>
					 &nbsp;&nbsp; &nbsp;&nbsp; Edad:&nbsp;&nbsp;<strong><u><?php echo $consulta_expediente[0]['edad']; ?></strong>&nbsp;&nbsp; &nbsp;&nbsp; Domicilio: <strong><u><?php echo $consulta_expediente[0]['DIRECCION']; ?></u></strong> 
				</p>
				<br /> 
				<p> <strong>2. Nombre completo del familiar que realizó la solicitud del ingreso:</strong>&nbsp;&nbsp; <strong><u> <?php echo $consulta_expediente[0]['nombre_representante']; ?></u></strong> <br />
				Parentesco:&nbsp;&nbsp;<strong><u>  <?php echo $consulta_expediente[0]['parentesco']; ?></u></strong> &nbsp;&nbsp;  Teléfonos: &nbsp;&nbsp;<strong><u><?php echo $consulta_expediente[0]['telefono_representante']; ?></u></strong><br />
				Dirección:&nbsp;&nbsp;<strong><u>  <?php echo $consulta_expediente[0]['direccion_representante']; ?> </u></strong><br />
				Fecha en la que ingresó el usuario al establecimiento:&nbsp;&nbsp;<strong><u>  <?php echo $consulta_expediente[0]['fecha_ingreso']; ?></u></strong> &nbsp;&nbsp; Hora de ingreso:&nbsp;&nbsp;<strong><u> <?php echo $consulta_expediente[0]['hora_ingreso']; ?></u></strong><br />
				</p>
				<br /> 						
				<p ><strong>3. Datos del servicio de atención </strong><br>
				Motivo de la atención (acto notificado):&nbsp;&nbsp;<strong><u><?php echo $consulta_expediente[0]['motivo_atencion']; ?></u></strong><br>
				Reporte de lesiones, en su caso:&nbsp;&nbsp;<strong><u>   <?php echo $consulta_expediente[0]['reporte_lesion']; ?></u></strong> <br>
				<br />
				Diagnóstico (s) del usuario:&nbsp;&nbsp;<strong><u>  <?php echo $consulta_expediente[0]['diagnostico']; ?> </u></strong><br>
				<br>
				<?php $mystring = $consulta_expediente[0]['plan_terapeutico'];
				if(strpos($mystring, "farmaco") !== false){
					?>
					  Plan Terapéutico: ( <strong><u> X </u></strong>) Farmacoterapia
					<?php
				} else{
					?>
					Plan Terapéutico: (&nbsp;&nbsp;) Farmacoterapia
					<?php	
				}
				
				if(strpos($mystring, "examenes") !== false){
					?>
					  ( <strong><u> X </u></strong>) Exámenes de laboratorio
					<?php
				} else{
					?>
					(&nbsp;&nbsp;  ) Exámenes de laboratorio
					<?php	
				}
				if(strpos($mystring, "terapia") !== false){
					?>
					  ( <strong><u> X </u></strong>) Terapia psicológica
					<?php
				} else{
					?>
					(&nbsp;&nbsp;  ) Terapia psicológica
					<?php	
				}
				if(strpos($mystring, "consejeria") !== false){
					?>
					  (<strong><u> X </u></strong>) Consejería
					<?php
				} else{
					?>
					(&nbsp;&nbsp;  ) Consejería
					<?php	
				}
				if(strpos($mystring, "canalizacion") !== false){
					?>
					  (<strong><u> X </u></strong>) Canalización
					<?php
				} else{
					?>
					(&nbsp;&nbsp;) Canalización
					<?php	
				}
				?>
				<br>
				 Pronóstico:&nbsp;&nbsp;<strong><u> <?php echo $consulta_expediente[0]['pronostico']; ?><u> </strong> <br>
				Cédula profesional del médico responsable de la valoración: &nbsp;&nbsp;<strong><u><?php echo $consulta_expediente[0]['cedula_medico']; ?><u> </strong><br>
				Duración promedio del servicio de atención residencial:&nbsp;&nbsp;<strong><u> <?php echo $consulta_expediente[0]['duracion_consulta']; ?><u> </strong><br>

				Nombre del médico:&nbsp;&nbsp;<strong><u> <?php echo $consulta_expediente[0]['nombre_medico']; ?><u> </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Firma: _____________________________________________<br>
				Fecha de la notificación:&nbsp;&nbsp;<strong><u> <?php echo $consulta_expediente[0]['fecha_notificacion']; ?><u> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Agencia del Ministerio Público:<strong><u>  <?php echo $consulta_expediente[0]['agencia_mp']; ?><u> </strong><br>
				Domicilio de la agencia:&nbsp;&nbsp;<strong><u> <?php echo $consulta_expediente[0]['domicilio_agencia']; ?><u> </strong><br>

						</p>
						<br /> 
				
			</td>


		</tr>
	</table>
	<table class="datos_cliente">
						<tr>
							<td><p>Nombre y Firma del Representante Legal de<br />
							<?php echo $consulta_expediente[0]['nombre_clinica']; ?></p>
							<br>
						</td>
							<td><p>Nombre y Firma</p> 
							<br>
							
						</td>
						
						</tr>
						
						<tr>
							<td><p><strong><?php echo $consulta_expediente[0]['representante_legal']; ?></strong><br />
							Ced. Prof. <?php echo $consulta_expediente[0]['cedula_legal']; ?>
						</p></td>
							
						<td> <p><strong><?php echo $consulta_expediente[0]['nombre_representante']; ?></strong><br/>
							 Familiar o Representante Legal</p>
							 </td>
						</tr>
					</table>

</div>

</body>
</html>