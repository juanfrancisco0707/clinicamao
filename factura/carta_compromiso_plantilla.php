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
	<title>CARTA COMPROMISO</title>
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
					<span class="h3_fuente">CARTA COMPROMISO</span>	<br />				
					<!--<table class="datos_cliente"> -->
					<!--	 <tr> -->
					<p class="textright" >Guasave, Sinaloa, A <?php echo ($dia1)?> de <?php echo ($mes1)?> del <?php echo ($anio1)?> <br> </p> <br />
						<p class="negrita_fuente"><strong>Administración de medicamentos</strong><br> </p> <br />
						<p ><strong>Nombre completo del usuario: <?php echo strtoupper($consulta_expediente[0]['nombre']); ?>  </strong><br> </p> <br />
						<br />
						<p class="palaign" >
						Por medio de la presente se establece el compromiso voluntario por  parte del paciente interno, el médico
						responsable del establecimiento, el personal de <strong> <?php echo strtoupper($consulta_expediente[0]['nombre_clinica']); ?></strong>. , el familiar y/o
						representante legal para que el usuario se someta al tratamiento médico establecido, tomando en cuenta las
						siguientes recomendaciones:
					    </p><br />
					
						<p class="margen_tab">
						•	Llevar a cabo el  tratamiento farmacológico, hasta que sea necesario y/o se realice un cambio por el
						 profesional en medicina, previa valoración.
						 </p><br />
						 <p class="margen_tab">
                        •   Trabajar   con empeño  y apegarse al plan de tratamiento que se estableció, dando la importancia
                        necesaria al estado de salud física. 
                        </p><br />
                        <p class="margen_tab">
                        •   Si es necesario e indicado se realizaran estudios clínicos entre ellos (antidoping).
                        </p><br />
                        <p class="margen_tab">
                        •   Se solicitará interconsulta u otro nivel de atención medica por razón necesaria.
                        </p> <br />

                        <p class="palaign" >
                        <strong>NOTA: </strong>Por medio de la presente se hace  constar que se informó sobre el plan de tratamiento e importancia de
                        seguimiento del mismo, así como de  todas las actividades a partir de ser instalado el tratamiento médico para el
                        usuario, mismas que serán supervisadas por los responsables del área clínica.
                        <br> </p>

						
			</td>
			

		</tr>
		<br><br><br>
		<tr>
        <div> <p class="info_conformidad"><strong>	A T E N T A M E N T E </strong> </p></div>
		</tr>
		
	</table><br><br><br>
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
						<!-- class="margen_rep_legal"  -->
						<td><p ><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $consulta_expediente[0]['representante_legal']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p></td>
							
							<td><p></p> 							
								<!--<p><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $consulta_expediente[0]['testigo']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p> -->
							</td>
						</tr>
						
						<tr >
						   
							<td><p >&nbsp;&nbsp;Nombre y Firma del Representante Legal de<br />
							&nbsp;&nbsp;&nbsp;<?php echo $consulta_expediente[0]['nombre_clinica']; ?></p>
						    </td>
							<!--<td><p>Nombre y Firma del testigo</p> </td> -->
						</tr>
					</table>
	<br />
					</table>
</div>


</body>

</html>