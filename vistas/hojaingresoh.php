    <?php
    include_once('../tbs_class.php'); 
    include_once('../plugins/tbs_plugin_opentbs.php');    
   // Dirección o IP del servidor MySQL
    $host = "localhost";
     // Puerto del servidor MySQL
    $puerto = "3306";
 
   // Nombre de usuario del servidor MySQL
   $usuario = "root";
 
    // Contraseña del usuario
   $contrasena = "";
 
   // Nombre de la base de datos
   $baseDeDatos ="bdclinica";
 
    function Conectarse()
   {
     global $host, $puerto, $usuario, $contrasena, $baseDeDatos, $tabla;
 
     if (!($link = mysqli_connect($host.":".$puerto, $usuario, $contrasena))) 
     { 
      //  echo "Error conectando a la base de datos.<br>"; 
       exit(); 
            }
     else
      {
       //echo "Listo, estamos conectados.<br>";
      }
     if (!mysqli_select_db($link, $baseDeDatos)) 
      { 
        //echo "Error seleccionando la base de datos.<br>"; 
        exit(); 
      }
     else
      {
       //echo "Obtuvimos la base de datos $baseDeDatos sin problema.<br>";
     }
   return $link; 
    } 
   
   $link = Conectarse();
  
 

   $id_expediente=$_GET['id_expediente'];
  
   $id_clinica=$_GET['id_clinica'];
  
   $sql =  "SELECT * FROM `vta_hoja_ingreso` WHERE id_expediente='$id_expediente' and id_clinica ='$id_clinica'";
   $result = mysqli_query($link, $sql); 

   $TBS = new clsTinyButStrong;
   $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 
   while($row = mysqli_fetch_array($result))
   { 
      //Parametros
      $idclinica=$row["id_clinica"];
      $nomclinica=$row["nombre_clinica"];
      $numingprevios='0';
      $dirclinica=$row["direccion_clinica"];
      $nompaciente = $row["nombre"];
      $fechaingreso = $row["fecha_ingreso"];
      $sexo = $row["sexo"];
      $fechanacimiento = $row["FECHA_NACIMIENTO"];
      $edad = $row["edad"];
      $direccion=$row["DIRECCION"];
      $hora=$row["hora_ingreso"];
      $numexp=$row["id"];
      $estadocivil=$row["ESTADO_CIVIL"];
      
      $telefono=$row["telefono"];
      $nacionalidad=$row["GENTILICIO_NAC"];
      $escolaridad=$row["ESCOLARIDAD"];
      $ocupacion=$row["NOMBRE_OCUPACION"];
      $fechaspreving="";
      
      $rfinssi="";
      $rfinsno="X";
  
      $voluntario="X";
      $involuntario="";
      $obligatorio="";
  
      $refinsnombre="";
  
      $refhojasi="";
      $refhojano="X";
      $motivo=$row["motivo_ingreso"];
  
      $foliomp=$row["folio_mp"];
      $operador=$row["operador_mp"];

      $desestadosalud=$row["descripion_salud"];
      $nomrepresentante=$row["representante_legal"];
      $ocupacionr=$row["nombre_ocupacionr"];
      $edadr=$row["edad_representante"];
      $parentesco=$row["parentesco"];
      $direccionr=$row["direccion_representante"];
      $telefonor=$row["telefono_representante"];
      if($idclinica===1)
      {
       $logompresa  = 'logoclinicaced.png';
      // $direccion='Prolongación Juan Carrasco #176, Colonia Centro. C.P. 81000';
      }
      else
      {
        $logompresa  = 'logovalleverde.png';
      }
      
      
  
      //Cargando template
     // $template = 'Plantilla_Colegiado.docx';
      $template = 'hojaingresoh.docx';
     
      $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
      //Escribir Nuevos campos
      
      $TBS->MergeField('PRO.NOMCLINICAS', $nomclinica);
      $TBS->MergeField('pro.direccionclinica', $dirclinica);
      $TBS->MergeField('pro.estadocivil', $estadocivil);
      $TBS->MergeField('es', $numingprevios);
      $TBS->MergeField('pro.nompaciente', $nompaciente);
      $TBS->MergeField('pro.fechaingreso', $fechaingreso);
      $TBS->MergeField('pro.sexo', $sexo);
      $TBS->MergeField('pro.fechanacimiento', $fechanacimiento);
      $TBS->MergeField('pro.edad', $edad);
      $TBS->MergeField('pro.direccion', $direccion);
      $TBS->MergeField('pro.hora', $hora);
      $TBS->MergeField('pro.numex', $numexp);
      $TBS->MergeField('pro.telefono', $telefono);
      $TBS->MergeField('pro.nacionalidad', $nacionalidad);
      $TBS->MergeField('pro.ocupacion', $ocupacion);
      $TBS->MergeField('pro.escolaridad', $escolaridad);
      $TBS->MergeField('i1', $rfinssi);
      $TBS->MergeField('i2', $rfinsno);
      $TBS->MergeField('nomrefinstitucion', $refinsnombre);
      $TBS->MergeField('h1', $refhojasi);
      $TBS->MergeField('h2', $refhojano);
      $TBS->MergeField('pro.fechaant', $fechaspreving);
      $TBS->MergeField('v1', $voluntario);
      $TBS->MergeField('v2', $involuntario);
      $TBS->MergeField('v3', $obligatorio);
      $TBS->MergeField('pro.motivo', $motivo);
  
      $TBS->VarRef['x'] = $logompresa;
  
      $TBS->MergeField('folio mp', $foliomp);
      $TBS->MergeField('operador', $operador);
      $TBS->MergeField('pro.estadosaluddes', $desestadosalud);
      $TBS->MergeField('pro.nomrepresentante', $nomrepresentante);
      $TBS->MergeField('pro.ocupacionr', $ocupacionr);
      $TBS->MergeField('pro.edadr', $edadr);
      $TBS->MergeField('pro.parentesco', $parentesco);
      $TBS->MergeField('pro.direccionrepresentante', $direccionr);
      $TBS->MergeField('pro.telefonor', $telefonor);
  
      //$TBS->VarRef['x'] = $firmadecano;
  
      $TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
  
      $save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost/vistas/plantilla.php')) ? trim($_POST['save_as']) : '';
      $output_file_name = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $template);
      if ($save_as==='') {
          $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
          exit();
      } else {
          $TBS->Show(OPENTBS_FILE, $output_file_name);
          exit("File [$output_file_name] has been created.");
      }
      $TBS->Show(OPENTBS_FILE, $output_file_name);
    } 
    mysqli_free_result($result); 
    mysqli_close($link);
  ?>