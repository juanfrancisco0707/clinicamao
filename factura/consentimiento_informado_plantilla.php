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
	<title>CONSENTIMIENTO INFORMADO</title>
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
					
				</div>
			</td>
		</tr>
	</table>
	<table id="consulta_expediente_cliente">
		<tr>
			<td class="info_cliente">
				<!-- <div class="round"> -->
					<span class="h3">CONSENTIMIENTO INFORMADO</span>					
					<!--<table class="datos_cliente"> -->
					<!--	 <tr> -->
					<br />
						<p ><strong>I.	Por parte del usuario:  </strong><br> </p> <br />
						<p class="palaign" >
						Por medio de la presente y en calidad de paciente interno de <strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong>.,  
						yo <strong> <?php echo strtoupper($consulta_expediente[0]['nombre']); ?></strong> &nbsp;&nbsp; de sexo &nbsp;&nbsp;<strong> <?php echo strtoupper($consulta_expediente[0]['sexo']); ?></strong>,
						con	&nbsp;&nbsp;<strong> <?php echo strtoupper($consulta_expediente[0]['edad']); ?></strong> años de edad, declaro haber sido informado que 
						permaneceré  recibiendo tratamiento residencial contra las adicciones, por un periodo de <strong> <?php echo$periodoletra?> (&nbsp;<?php echo$periodo?>&nbsp;) meses</strong> , en las 
						instalaciones que ocupa la <strong>.</strong>  Institución que ofrece un modelo de tratamiento <strong>Mixto </strong> (combinación de la 
						ayuda mutua y del modelo profesional), donde lo más importante para el cuerpo técnico es brindar una atención
						integral al usuario consistente en: desintoxicación física, análisis clínicos, valoración médica,  valoración
						psicológica, psicoterapia individual y grupal, consejería en adicciones (individual, grupal y familiar), asesoría
						familiar, guía espiritual, plan de vida, programa de prevención de recaídas, entre otras acciones específicas.	<br />
						<br /> 
						También estoy de acuerdo en participar activamente durante todo el proceso de tratamiento, mismo que implica
						proporcionar información veraz y oportuna al momento de cualquier  evaluación por algún miembro del equipo
						de trabajo,  realizar las actividades asignadas por el Consejero, Médico, psicólogo y/o cualquier autoridad
						dentro del personal autorizado. También acepto cumplir los puntos que establece el reglamento interno, asistir a
						las sesiones de seguimiento del tratamiento, una vez terminado el anexo, todas estas acciones tienen como
						finalidad  lograr mi abstinencia y facilitar mi recuperación y mi reinserción a la vida productiva, a la familia y a
						la sociedad en general.<br />
						<br />
						Estoy de acuerdo que en caso necesario y al no obtener los resultados esperados, se me proporcione información
						por escrito respecto a otro tipo de alternativas de atención, además se hizo de mi conocimiento que mi relación
						con el personal del establecimiento será únicamente de carácter profesional, por otra parte soy consciente que
						fui informado de la parte donde mi familiar o representante legal se compromete a cubrir  una cuota de
						$&nbsp;<strong> <?php echo strtoupper($consulta_expediente[0]['cuota_ingreso']); ?></strong>&nbsp; de ingreso y  $&nbsp;<strong> <?php echo strtoupper($consulta_expediente[0]['cuota_semanal']); ?></strong>&nbsp; semanal,  en beneficio de tener acceso a servicios
						dignos y apropiados durante mi estancia en esta casa de vida. <br />
						<br />
						En  caso de abandonar mi tratamiento residencial sin un argumento verdaderamente valido,  dentro del período
						de los <strong> <?php echo$periodoletra?> (&nbsp;<?php echo$periodo?>&nbsp;) meses</strong>,  se deberá cubrir la cuota de recuperación por los <strong> <?php echo$periodoletra?> (&nbsp;<?php echo$periodo?>&nbsp;) meses</strong>, en el entendido de
						que dicho saldo  quedará a favor del familiar o representante legal para que en caso de que el paciente sufra una
						recaída antes de los próximos seis meses a partir de la fecha de egreso, como una medida preventiva así poder
						reingresar al usuario sin necesidad de tener que cubrir la cuota de ingreso si de las semanas que fueron cubiertas
						en caso de haber cubierto el total de los &nbsp;<?php echo$periodoletra?> (&nbsp;<?php echo$periodo?>&nbsp;) meses estipulados en el presente contrato, dicho saldo a favor se
						utilizará hasta donde alcance para cubrir los gastos por el  nuevo tratamiento residencial al seno de la <strong><?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?>&nbsp;.</strong> <br />
						Ratifico que he sido informado respecto a las características del tratamiento, los procedimientos, los riesgos que
						implica, los costos, así como los beneficios esperados, también estoy de acuerdo en que se utilicen los
						procedimientos  necesarios para su aplicación.<br /> <br />
						<strong>II.	Por parte del establecimiento: </strong><br /> <br />
						El establecimiento:&nbsp;<strong><?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?>&nbsp;</strong>, se compromete a brindar un servicio de
						atención de calidad que facilite la recuperación y la reinserción del usuario a una vida productiva, garantizando
						en todo momento el respeto a su dignidad, integridad y haciendo valer sus derechos. Por ello, en caso de que el
						usuario y/o el familiar o representante legal desee suspender el tratamiento antes de que éste finalice, el centro
						se compromete a no mantenerlo de forma involuntaria y  brindarle la información y la orientación necesaria
						para continuar con el proceso de rehabilitación en otra institución que persiga los mismos fines.
						<br />
						
						<br />

						

						<p class="palaign" >
						
						</p>
			</td>


		</tr>
	</table>
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
		<p class="palaign" >
						Se pone de manifiesto que toda información brindada por el usuario es de carácter confidencial y sólo tendrán
						acceso a ésta el equipo multidisciplinario involucrado en el proceso terapéutico, por lo que no se revelará a
						ningún otro individuo, si no es bajo el consentimiento por escrito del usuario, exceptuando los casos previstos
						por la ley y autoridades sanitarias. Así mismo, durante el tratamiento no se realizarán grabaciones de audio,
						video o fotografías, sin que el personal del establecimiento explique su finalidad y sin previo consentimiento
						escrito por parte del usuario. <br />
						<br />
						En caso de que el usuario presente una condición médica previa al ingreso, el establecimiento dará continuidad
						al tratamiento médico o farmacológico, suministrando los medicamentos en las dosis y horarios indicados,
						siempre y cuando estos sean proporcionados por: personal de enfermería autorizado por la propia institución,
						deberán  existir los estudios y recetas avaladas por un médico certificado y no se contraindique con el
						tratamiento recibido durante su estadía en &nbsp;<strong><?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?>&nbsp;</strong>, en caso de que el
						usuario requiera estudios complementarios o el servicio de un médico especializado, se le informará al respecto
						y se dará aviso al familiar o representante legal, si el usuario requiere atención médica urgente, se dará aviso
						inmediato a los familiares y se trasladará a un hospital de segundo nivel de atención. <br />
						<br />
						Por otro lado, el establecimiento se exime de toda responsabilidad por los actos en contra de la ley en que el
						usuario se haya visto involucrado, previo y posterior al tratamiento. <br />
						<br />
						En  caso de que el usuario o sus familiares presenten alguna duda respecto al proceso de rehabilitación o a
						cualquier otro asunto relacionado con el mismo, el establecimiento se compromete a proporcionar dicha
						información relativa al estado de salud del usuario y evolución  durante su tratamiento, con una periodicidad de
						lunes a viernes, de 9 a 13 hrs. y de 15 a 18 hrs. Los sábados de 11 a 13 hrs.<br />
						<br />
						Finalmente, el establecimiento se compromete a proporcionar y a dar lectura del reglamento interno del
						establecimiento al usuario, y hacer entrega por escrito del reglamento para el  familiar y/o responsable legal.<br />
						<br />
						Siendo las &nbsp;<?php echo$hora?>&nbsp; hrs. del día &nbsp;<?php echo$dia?>&nbsp; del mes de &nbsp;<?php echo$mes?>&nbsp; del año &nbsp;<?php echo$anio?>&nbsp;, en la
						ciudad  de  Guasave  Sinaloa,  habiendo sido informado y aceptando los compromisos anteriormente expuestos
						se firma el presente consentimiento: <br />					
					</p>

					
					
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
							<td ><p >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre y Firma del Usuario</p><br /><br /><br /><br /> </td>
							
							<td ><p >Nombre y Firma del Representante</p><br /><br /> <br /><br /></td>

						</tr>
						
						<tr>
						
						<td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><?php echo $consulta_expediente[0]['representante_legal']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p></td>
							
							<td><p></p> 							
								<p><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $consulta_expediente[0]['testigo']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
							</td>
						</tr>
						
						<tr>
						   
							<td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre y Firma del Representante Legal de<br />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $consulta_expediente[0]['nombre_clinica']; ?></p>
						    </td>
							<td><p>Nombre y Firma del testigo</p> </td>
						</tr>
					</table>
	</div>



</body>

</html>
<script>
	
</script>