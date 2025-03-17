<?php

require_once "../controladores/conceptos.controlador.php";
require_once "../modelos/Conceptos.modelo.php";

class AjaxConceptoscb{


    public function ajaxListarConceptoscb(){

        $Conceptos = ConceptosControlador::ctrListarConceptosCb();

        echo json_encode($Conceptos, JSON_UNESCAPED_UNICODE);
    }
}

$Conceptos = new AjaxConceptoscb();
$Conceptos -> ajaxListarConceptoscb();
   