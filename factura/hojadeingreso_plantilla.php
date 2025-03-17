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
	<title>HOJA DE INGRESO / REINGRESO</title>
    <link rel="stylesheet" href="style_constancia_medica.css">
	<style>
		@media all {
.page-break { display: none; }
}

@media print {
.page-break { display: block; page-break-before: always; }
}
	</style>
</head>
<body>

<div id="page_pdf">
	<table id="consulta_expediente_head">
		<tr>
			<td class="logo_consulta_expediente">
			<?php
				if($consulta_expediente[0]["id_clinica"] == 1){
					
				 ?>
				<div>
				
				<!--	<img src="img/logoced.png"> -->
				<img src="img/logoceptca.jpg">
				</div>
				<?php
				}
				else
				{
					?>
					<div>
				
				<img src="img/logoceptca.jpg">

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
				<?php
				if($consulta_expediente[0]["id_clinica"] == 1){
					
				 ?>
				<div>
				
				<img src="img/logoceptca.jpg"> 
				
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
			<!--<td class="info_consulta_expediente">
				<div class="round">
					<span class="h3">Expediente</span>
					<p>No. Expediente: <strong>
						<?php echo $consulta_expediente[0]['id_expediente']; ?>
					</strong></p>
					
				</div>
			</td> -->
		</tr>
	</table>
	<table id="consulta_expediente_cliente">
		<tr>
			<td class="info_cliente">
				<!-- <div class="round"> -->
					<span class="h3_fuente">HOJA DE INGRESO / REINGRESO</span>
					<!--<table class="datos_cliente"> -->
					<!--	 <tr> --><br />
						<p class="palaign">Fecha de Ingreso : <?php echo $consulta_expediente[0]['fecha_ingreso']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hora :<?php echo $consulta_expediente[0]['hora_ingreso']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   No. Exp.<?php echo $consulta_expediente[0]['id_expediente']; ?> </P> 					
						<p><strong>1. Datos del usuario </strong> <br /> </p>
						<p>	Nombre completo del usuario: <?php echo $consulta_expediente[0]['nombre']; ?> </p>
						<p>	Sexo : <?php echo $consulta_expediente[0]['sexo']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Fecha de nacimiento :<?php echo $consulta_expediente[0]['FECHA_NACIMIENTO']; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Edad:<?php echo $consulta_expediente[0]['edad']; ?> </p>
						<p>	Dirección :  <?php echo $consulta_expediente[0]['DIRECCION']; ?> </p>
						<p>	Teléfono(s) : <?php echo $consulta_expediente[0]['telefono']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Nacionalidad: <?php echo $consulta_expediente[0]['GENTILICIO_NAC']; ?> </p>
						<p>	Estado civil:<?php echo $consulta_expediente[0]['ESTADO_CIVIL']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Escolaridad:<?php echo $consulta_expediente[0]['ESCOLARIDAD']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ocupación:<?php echo $consulta_expediente[0]['NOMBRE_OCUPACION']; ?></p> 
						<p>¿Cuántos ingresos previos ha tenido en el establecimiento? &nbsp;&nbsp;&nbsp; <?php echo $nrp - 1; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fecha (s): 
						<?php
						if($nrp > 1){
							
						echo $consulta_expediente_p[0]['fecha_ingreso']; 
						}?> 
						
					    </p>
						<p>¿Lo refiere alguna institución? &nbsp;&nbsp;&nbsp;
							<?php
				if($consulta_expediente[0]["refiere_institucion"] != ''){
					
				 ?>
				(&nbsp;X&nbsp;) Si  &nbsp;&nbsp; (&nbsp;&nbsp;) No &nbsp;&nbsp; 
				<?php
				}
				else
				{
					?>
					(&nbsp;&nbsp;) Si  &nbsp;&nbsp; (&nbsp;X&nbsp;) No &nbsp;&nbsp; 
			<?php
					}
				 ?>
					¿Cuál? <?php echo $consulta_expediente[0]['refiere_institucion']; ?></p>
					<p>¿Presenta hoja de referencia?   &nbsp;&nbsp;&nbsp;&nbsp; (   ) Si &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   (   ) No    (en caso afirmativo anexar al expediente) </p>
					<p> Tipo de ingreso actual:  
					<?php
				if($consulta_expediente[0]["tipo_ingreso"] == 'Voluntario'){
					
				 ?>
				( X ) Voluntario               (   ) Involuntario              (   ) Obligatorio
				<?php
				}
				elseif($consulta_expediente[0]["tipo_ingreso"] == 'Involuntario'){
				
					?>
					(  ) Voluntario               ( X ) Involuntario              (   ) Obligatorio
					
			<?php
				}
				else {
					?>
					(  ) Voluntario               (   ) Involuntario              ( X ) Obligatorio
				<?php
					}
				 ?>

					</p>   
					<br />                 
					<p><strong>2. Motivo de consulta: </strong> <?php echo $consulta_expediente[0]['motivo_ingreso']; ?>  </p>
					<p>Folio M.P.:&nbsp;&nbsp;<?php echo $consulta_expediente[0]['folio_mp']; ?>  &nbsp;&nbsp;&nbsp;&nbsp; Operador(a):&nbsp;&nbsp; <?php echo $consulta_expediente[0]['operador_mp']; ?>  </p>	
					<p>Descripción breve del estado de salud general del usuario:&nbsp;&nbsp;<?php echo $consulta_expediente[0]['descripcion_salud']; ?>  </p>
					<br />
						<p ><strong>3. Datos del familiar o representante legal  </strong><br>
						<br /> 
						<p>Nombre: <?php echo strtoupper($consulta_expediente[0]['nombre_representante']); ?></p>
						<p> Edad:&nbsp;&nbsp;<?php echo $consulta_expediente[0]['edad_representante']; ?>  Ocupación: &nbsp;&nbsp;<?php echo $consulta_expediente[0]['NOMBRE_OCUPACIONR']; ?>&nbsp;&nbsp;  Parentesco:&nbsp;&nbsp;<?php echo $consulta_expediente[0]['parentesco']; ?>

						</p>
						<p>Dirección: <?php echo $consulta_expediente[0]['direccion_representante']; ?></p>
						<p>Teléfono: <?php echo $consulta_expediente[0]['telefono_representante']; ?></p>
						 
						<br /> 
						
						
				<br /> 
				<p> <strong>2. Nombre completo del familiar que realizó la solicitud del ingreso:</strong> <?php echo $consulta_expediente[0]['nombre_representante']; ?> <br />
				Parentesco: <?php echo $consulta_expediente[0]['parentesco']; ?> &nbsp;&nbsp;  Teléfonos:<?php echo $consulta_expediente[0]['telefono_representante']; ?><br />
				Dirección: <?php echo $consulta_expediente[0]['direccion_representante']; ?> <br />
				Fecha en la que ingresó el usuario al establecimiento: <?php echo $consulta_expediente[0]['fecha_ingreso']; ?> &nbsp;&nbsp; Hora de ingreso: <?php echo $consulta_expediente[0]['hora_ingreso']; ?><br />
				</p>
				<br /> 						
				
						<br /> 
				
			</td>


		</tr>
	</table>
	<table class="datos_cliente">
						<tr>
						
							<td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $consulta_expediente[0]['nombre']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p></td>
							<td><p><u>&nbsp;&nbsp;<?php echo $consulta_expediente[0]['nombre_representante']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p></td>
						</tr>
						<tr>
							<td ><p >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre y Firma del Usuario</p><br /><br /><br /><br /> </td>
							
							<td ><p >Nombre y Firma del familiar Representante</p><br /><br /> <br /><br /></td>

						</tr>
						
						<tr>
						
						<td><p class="margen_rep_legal" ><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $consulta_expediente[0]['representante_legal']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p></td>
							
							<td><p></p> 							
								<!--<p><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $consulta_expediente[0]['testigo']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p> -->
							</td>
						</tr>
						
						<tr >
						   
							<td><p class="margen_rep_legal">&nbsp;&nbsp;Nombre y Firma del Representante Legal de<br />
							&nbsp;&nbsp;&nbsp;<?php echo $consulta_expediente[0]['nombre_clinica']; ?></p>
						    </td>
							<!--<td><p>Nombre y Firma del testigo</p> </td> -->
						</tr>
					</table>

</div>

</body>
</html>