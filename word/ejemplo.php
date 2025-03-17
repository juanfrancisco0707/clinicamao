<?php
    include_once('../word/tbs_class.php'); 
    include_once('../word/plugins/tbs_plugin_opentbs.php'); 

    $TBS = new clsTinyButStrong; 
    $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 
    //Parametros
    $nomclinica='COMUNIDAD TERAPEUTICA VALLE VERDE AC';
    $numingprevios='1';
    $dirclinica=' Conocido S/N  El Mezquital, Carretera México 15, Km. 5, Tramo Guasave – Los Mochis, a un costado del Motel Treble-Park, C.P 81124, Guasave Sinaloa,  México.';
    $nompaciente = 'Luis Fernando Sepulveda Leyva';
    $fechaingreso = '23 de Mayo del 2022';
    $sexo = 'Masculino';
    $fechanacimiento = '01 de Enero de 1990';
    $edad = '32';
    $direccion="Guasave sinaloa";
    $hora="12:00 PM";
    $numexp="0002";
    $estadocivil="soltero";
    
    $telefono="68712323272";
    $nacionalidad="MEXICANA";
    $escolaridad="Secundaria";
    $ocupacion="Albañil";
    $fechaspreving="03-12-2021";
    
    $rfinssi="X";
    $rfinsno="";

    $voluntario="X";
    $involuntario="";
    $obligatorio="";

    $refinsnombre="H AYUNTAMIENTO DE GUASAVE";

    $refhojasi="X";
    $refhojano="";
    $motivo="problemas de drogas";

    $foliomp="mp36626";
    $operador="Juan Luis Gomez";
    $desestadosalud="Se encuentra de manera normal";
    $nomrepresentante="Pedro Leyva Sotelo";
    $ocupacionr="Abogado";
    $edadr="30";
    $parentesco="Conocido";
    $direccionr="Tamazula";
    $telefonor="68712313233";
    //$logompresa  = 'logoclinicaced.png';
    $logompresa  = 'logovalleverde.png';

    //Cargando template
   // $template = 'Plantilla_Colegiado.docx';
    $template = 'prueba.docx';
   
    $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
    //Escribir Nuevos campos

    $TBS->MergeField('PRO.NOMCLINICA', $nomclinica);
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

    $save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
    $output_file_name = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $template);
    if ($save_as==='') {
        $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); 
        exit();
    } else {
        $TBS->Show(OPENTBS_FILE, $output_file_name);
        exit("File [$output_file_name] has been created.");
    }


    ini_set ('soap.wsdl_cache_enabled', 0);

    // you will get this username and pass while register
    define ('USERNAME', 'hum9412'); 
    define ('PASSWORD', 'Clinicaced1*');
    
    // SOAP WSDL endpoint
    define ('ENDPOINT', 'https://api.livedocx.com/2.1/mailmerge.asmx?wsdl');
     
    // Define timezone
    date_default_timezone_set('Europe/Berlin');
    $soap = new SoapClient(ENDPOINT);
    $soap->LogIn(
        array(
            'username' => USERNAME,
            'password' => PASSWORD
        )
    );
    $data = file_get_contents('prueba.docx');
    $soap->SetLocalTemplate(
        array(
            'template' => base64_encode($data),
            'format'   => 'docx'
        )
    );
    $soap->CreateDocument();
    $result = $soap->RetrieveDocument(
        array(
            'format' => 'pdf'
        )
    );
    $data = $result->RetrieveDocumentResult;
    file_put_contents('tree.pdf', base64_decode($data));
    $soap->LogOut();
    unset($soap);



   
?>