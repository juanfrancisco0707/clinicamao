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
	<title>CONDICIONES GENERALES DE INGRESO</title>
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
					<p>Fecha: <strong><?php echo $consulta_expediente[0]['fecha_ingreso']; ?></strong></p>
					
				</div>
			</td>
		</tr>
	</table>
	<table id="consulta_expediente_cliente">
		<tr>
			<td class="info_cliente">
				<!-- <div class="round"> -->
					<span class="h3">CONDICIONES GENERALES DE INGRESO</span>					
					<!--<table class="datos_cliente"> -->
					<!--	 <tr> -->
					<br />
						<p ><strong>Nombre completo del usuario: <?php echo strtoupper($consulta_expediente[0]['nombre']); ?>  </strong><br> </p> <br />
						<p ><strong>Nombre del familiar o representante legal:  <?php echo strtoupper($consulta_expediente[0]['nombre_representante']); ?>  </strong><br> </p> <br />
						<p class="palaign" >
						Por medio de la presente solicito los servicios de tratamiento residencial contra las adicciones, mismo  que presta este
						establecimiento denominado  <strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong>., destinado para personas que tienen una
						adicción a drogas y/o alcohol. Esta solicitud está sujeta a las condiciones mencionadas a continuación:<br />
						</p>
						<p ><strong>1.-Consentimiento para tratamiento:</strong><br> </p> 
						<p class="p_tab">
						Por medio de la presente otorgo mi consentimiento voluntario para recibir cuidado médico y tratamiento que sea
						considerado benéfico o necesario por el personal de <strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong> AC, estando
						consciente que el procedimiento que utilizan no es una ciencia exacta, por lo tanto no es una garantía que dicho
						proceso arroje resultados positivos en el 100% de los casos. </p>
						<p ><strong>2.- Cooperación con el tratamiento:</strong><br> </p>
						<p class="p_tab">
						Al inicio del proceso terapéutico se involucra al familiar  que será sometida a un estudio socioeconómico con el
						fin de asignar una cuota de recuperación, económica en apoyo del usuario, la familia y el personal quienes los
						acompañaran a lo largo del proceso de reinserción social, de igual manera las familias deberán participar en las
						actividades terapéuticas, ocupacionales y/o de otra especie, que se consideren necesarias o sugeridas por la
						<strong>Comisión Estatal para la Prevención, Tratamiento y Control de las Adicciones</strong>, en coordinación con la
						<strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong>, esta práctica aplica tanto para el usuario como para el familiar
						y/o representante legal.
						</p>
						<p ><strong>3.-  Abandono de tratamiento</strong><br> </p>
						<p class="p_tab">
						<strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong>, se compromete a notificar de forma inmediata al familiar
						responsable y/o representante legal y ministerio público respectivamente, cuando el usuario abandone su
						tratamiento sin autorización y de forma abrupta, el establecimiento.
						</p>
						<p ><strong>4.- No hay garantía</strong><br> </p>
						<p class="p_tab">
						<strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong>, no garantiza que el tratamiento efectuado logre una rehabilitación
						completa, solo garantiza otorgar a cada usuario y sus familias la atención disponible y necesaria, buscando en
						todo momento que dichos cuidados y atenciones vayan encaminados a lograr su reintegración a la
						familia, a la vida productiva y a la sociedad. 
						</p>
						<p ><strong>5.- Inspección </strong><br> </p>
						<p class="p_tab">
						Durante la estancia en el establecimiento se podrán realizar revisiones periódicas y sin previo aviso a los objetos
						personales de cada usuario, y en caso de encontrarse cualquier cosa u objeto, químico, que se consideren en
						perjuicio al tratamiento, o que violen alguna regla interna establecida, serán retirados y retenidos por la
						administración, hasta determinar su canalización final.  De la misma forma todo artículo, objeto, comestibles, que
						tenga la familia del usuario como intención otorgárselo, deberá previamente ser inspeccionado y autorizado por la
						administración del establecimiento, para determinar que no se contraponga con las indicaciones médicas,
						terapéuticas o de otra especie.
						</p>
						<br />
	
			</td>
			

		</tr>
	</table>
	<br />
</div>
<div class="page-break"></div>
<div id="page_pdf2">

<table id="consulta_expediente_head2">

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
<table id="consulta_expediente_cliente2">

<tr>

<td class="info_cliente">
						<p ><strong>6.- Transportación a otros lugares </strong><br> </p>
						<p class="p_tab">
						<strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong>, puede proporcionarle servicio de transporte al usuario  para recibir
						cuidados médicos que no estén disponibles en la unidad de tratamiento, como pueden ser dentales u otros
						servicios. El establecimiento no asume la responsabilidad por cualquier daño ocasionado en el trayecto a otros
						lugares como lo dicta la ley.
						</p>
						<p ><strong>Confidencialidad</strong><br> </p>
						<p class="p_tab">
						Estoy obligado a mantener la confidencialidad y privacidad de otros pacientes con respecto a fuentes externas en
						todo momento.
						</p>
						<p ><strong>Responsabilidad</strong><br> </p>
						<p class="p_tab">
						<strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong>,  no se hace responsable en caso de que el paciente interno sufra
						 cualquier lesión física, que pueda ser ocasionada por participación en ejercicios deportivos, actividades
						 recreativas o  de  cualquier tipo.  
						</p>
						<p ><strong>Responsabilidad Civil</strong><br> </p>
						<p class="p_tab">
						<strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong>, no se hace responsable de los actos morales contrarios a las
						buenas costumbres o legales en las que los pacientes se hubieran visto involucrados por hechos anteriores y
						posteriores al tratamiento, en todo caso eximirá a <strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong>, de toda
						responsabilidad que pudiera existir, otorgando siempre el finiquito más amplio que la ley compete.
						</p>
						<p ><strong>Fallecimiento</strong><br> </p>
						<p class="p_tab">
						<strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong>, otorgara todas las facilidades como marca la ley, para que las
						autoridades competentes realicen todas las indagatorias que permitan dictaminar la causa y sus consecuencias.
					    </p>
						<p ><strong>Permanencia en tratamiento</strong><br> </p>
						<p class="p_tab">
						La permanencia durante el tratamiento podrá ser finiquitada por el familiar y/o representante legal y el paciente no
						estará  sujeto a ninguna condición de ninguna especie, sin embargo se entiende que  la permanencia en
						tratamiento deberá ser por un tiempo  promedio de  meses  (6) aunque el periodo mínimo de permanencia en
						algunos casos  será bajo estricto acuerdo entre el personal del centro y  del familiar o representante legal.	
						</p>
						<p ><strong>Cargos por servicios médicos y otros cuidados  especiales</strong><br> </p>
						<p class="p_tab">
						Cualquier paciente que requiera de servicios médicos especiales como psiquiatra,  dentista, radiografías, recibirán
						cargos adicionales por estos servicios o medicamentos. Por lo general el encargado de oficina se hará cargo del
						cobro o cargos misceláneos adicionales, podrían incluir traslados, taxis, libros, terapia familiares, etc. Todos los
						cargos adicionales deberán ser liquidados en su totalidad al momento de ser requeridos o indicados, y solo se
						efectuarán bajo acuerdo y aceptación del familiar responsable	
						</p>
						<p ><strong>NOTA:</strong><br>Por la presente certifico que este formato me ha sido totalmente explicado y que he leído y entendido todo
						su contenido. </p>

					
					
</td>
		
</tr>
<br />
<tr>
        <div> <p class="info_conformidad"><strong>	De conformidad </strong> </p></div>
</tr>
</table>
</div>
<div><br />
	<table class="datos_cliente">
						<tr>
						
							<td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $consulta_expediente[0]['nombre']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p></td>
							<td><p><u>&nbsp;&nbsp;<?php echo $consulta_expediente[0]['nombre_representante']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p></td>
						</tr>
						<tr>
							<td ><p >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre y Firma del Usuario</p><br /><br /><br /><br /> </td>
							
							<td ><p >Nombre y Firma del Representante</p><br /><br /> <br /><br /></td>

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
<script>
	
</script>