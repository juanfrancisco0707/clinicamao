<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/ingresos.controlador.php";
require_once "../modelos/ingresos.modelo.php";

class AjaxIngresos{
    public $folio;
    public $id_clinica;
    public $id_expediente;
    public $fecha_pago;
    public $importe;
    public $descripcion;
    public $estatus;
    public $clinica;
    public $rol;


    public function ajaxListarIngresos($fechaDesde, $fechaHasta,$id_clinica,$rol){

        $ingresos = IngresosControlador::ctrListarIngresos($fechaDesde, $fechaHasta,$id_clinica,$rol);  

        echo json_encode($ingresos,JSON_UNESCAPED_UNICODE);
        
    }
    public function ajaxListarIngresosf($fechaDesde, $fechaHasta,$paciente,$folio, $id_clinica,$rol){

        $ingresos = IngresosControlador::ctrListarIngresosf($fechaDesde, $fechaHasta,$paciente,$folio,$id_clinica,$rol);  

        echo json_encode($ingresos,JSON_UNESCAPED_UNICODE);
        
    }

    public function ajaxBuscarPagoCuotaIngreso($id_expediente,$id_clinica ){
        $buscarPagoIngreso = IngresosControlador::ctrBuscarPagoCuotaIngresos($id_expediente,$id_clinica);
       echo json_encode($buscarPagoIngreso,JSON_UNESCAPED_UNICODE);


    }
    public function ajaxObtenerFolioIngreso(){

        $folio = ingresosControlador::ctrObtenerFolioIngreso($this->clinica);

        echo json_encode($folio,JSON_UNESCAPED_UNICODE);

    }
    public function ajaxCargarDetalle(){

        $folio = ingresosControlador::ctrObtenerFolioIngreso($this->clinica);

        echo json_encode($folio,JSON_UNESCAPED_UNICODE);

    }
    public function ajaxRegistrarIngresos($datos,$folio,$id_clinica, $id_expediente,
    $fecha_pago,$total,$descripcion){

        $registroIngreso = IngresosControlador::ctrRegistrarIngresos($datos,$folio,$id_clinica,
         $id_expediente,$fecha_pago,$total,$descripcion );
        echo json_encode($registroIngreso,JSON_UNESCAPED_UNICODE);

    }
    public function ajaxEliminarIngresos($folio,$id_clinica){

        $eliminarIngreso = IngresosControlador::ctrEliminarIngresos($folio,$id_clinica);
        echo json_encode($eliminarIngreso,JSON_UNESCAPED_UNICODE);

    }
    public function ajaxImprimirIngresos($folio,$id_clinica){

        $imprimirIngreso = IngresosControlador::ctrImprimirIngresos($folio,$id_clinica);
        echo json_encode($imprimirIngreso,JSON_UNESCAPED_UNICODE);

    }
    public function ajaxImprimirTicket($folio){

        $imprimirTicket = IngresosControlador::ctrImprimirTicket($folio);
        echo json_encode($imprimirTicket,JSON_UNESCAPED_UNICODE);

    }
    public function ajaxActualizarIngresos($data){
            
        $table = "tblingresos";
        $id = $_POST["folio"];
        $nameId = "folio";
    
        $respuesta = IngresosControlador::ctrActualizarIngresos($table, $data, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    public function ajaxEliminarIngreso(){
    
        $table = "tblingresos"; 
        $id = $_POST["id"]; 
        $nameId = "id";
    
        $respuesta = IngresosControlador::ctrEliminarIngresos($table, $id, $nameId);
         echo json_encode($respuesta);
    }
    
}
if(isset($_POST["accion"]) && $_POST["accion"] == 1){
	
	$pagos= new AjaxIngresos();
    $pagos-> clinica = $_SESSION['S_CLINICA']; 
    $pagos-> ajaxObtenerFolioIngreso();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 2 ){ // LISTADO DE PAGOS POR RANGO DE FECHAS
   
    $ingresos = new AjaxIngresos();
    $ingresos -> ajaxListarIngresos($_POST["fechaDesde"],
    $_POST["fechaHasta"],
    $ingresos-> id_clinica = $_SESSION['S_IDCLINICA'],
    $ingresos-> rol = $_SESSION['S_ROL']
);

}
else if(isset($_POST["accion"]) && $_POST["accion"] == 22 ){ // LISTADO DE PAGOS POR RANGO DE FECHAS
   
    $ingresos = new AjaxIngresos();
    $ingresos -> ajaxListarIngresosf($_POST["fechaDesde"],
    $_POST["fechaHasta"],
    $_POST["paciente"],
    $_POST["folio"],
    $ingresos-> id_clinica = $_SESSION['S_IDCLINICA'],
    $ingresos-> rol = $_SESSION['S_ROL']
);

}
else if(isset($_POST["accion"]) && $_POST["accion"] == 3 ){ // LISTADO DE PAGOS POR RANGO DE FECHAS
   
    $ingresos = new AjaxIngresos();
    $ingresos -> ajaxEliminarIngresos($_POST["folio"],
    $ingresos-> id_clinica = $_SESSION['S_IDCLINICA']
   // $ingresos-> rol = $_SESSION['S_ROL']
);

 }else if(isset($_POST["accion"]) && $_POST["accion"] == 4 ){ // LISTADO DE PAGOS POR RANGO DE FECHAS
   
    $ingresos = new AjaxIngresos();
    $ingresos -> ajaxImprimirIngresos($_POST["folio"],
    $ingresos-> id_clinica = $_SESSION['S_IDCLINICA']
);

 }else if(isset($_POST["accion"]) && $_POST["accion"] ==  5){ // verifica si ya realizó el pago de la cuota de ingreso
   
    $buscapago= new AjaxIngresos();
    $buscapago-> ajaxBuscarPagoCuotaIngreso($_POST['id_expediente'],
    $buscapago-> id_clinica = $_SESSION['S_IDCLINICA']
 );
 }else if(isset($_POST["accion"]) && $_POST["accion"] == 6 ){ // LISTADO DE PAGOS POR RANGO DE FECHAS
   
    $ticket = new AjaxIngresos();
    $ticket -> ajaxImprimirTicket($_POST["folio"]);

 }
 else if(isset($_POST["accion"]) && $_POST["accion"] == 7 ){ // busca si ya pagó la cuota de ingreso
   
    $ticket = new AjaxIngresos();
    $ticket -> ajaxImprimirTicket($_POST["folio"]);

 }
 else {
     
	if((isset($_POST["arr"]))){
   
		
		$registrar = new AjaxIngresos(); 
        
		$registrar -> ajaxRegistrarIngresos($_POST["arr"],
        $_POST['folio'],
        $registrar-> id_clinica = $_SESSION['S_IDCLINICA'],
        $_POST['id_expediente'],
        $_POST['fecha_pago'],
        $_POST['total'],
        $_POST['descripcion']
    );
	}
 }


