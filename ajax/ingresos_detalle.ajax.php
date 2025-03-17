<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/ingresos.detalle.controlador.php";
require_once "../modelos/ingresos.detalle.modelo.php";

class AjaxIngresosDetalles{
    public $id;
    public $folio_detalle;
    public $id_concepto;
    public $cantidad;
    public $precio;
    public $estatus;
    public $importe;

    public function ajaxListarIngresosDetalles(){

        $Ingresos = Ingresoscontrolador::ctrListarIngresos();

        echo json_encode($Ingresos, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxObtenerFolioPago(){

      //  $folio = IngresosControlador::ctrObtenerFolioPago($this->clinica);

      //  echo json_encode($folio,JSON_UNESCAPED_UNICODE);

    }
    public function ajaxCargarDetalle(){

       // $folio = IngresosControlador::ctrObtenerFolioPago($this->clinica);

      //  echo json_encode($folio,JSON_UNESCAPED_UNICODE);

    }
    public function ajaxRegistrarIngresos_detalle(){
                                               
        $Concepto = IngresosDetallesControlador::ctrRegistrarIngresosDetalles(
            $this->id, $this->folio_detalle,$this->id_concepto,$this->cantidad,$this->precio,$this->importe,);
    
        echo json_encode($Concepto);
    }  
    public function ajaxActualizarIngresosDetalles($data){
            
        $table = "tblIngresos_Detalle";
        $id = $_POST["id"];
        $nameId = "id";
    
        $respuesta = IngresosDetallesControlador::ctrActualizarIngresosDetalles($table, $data, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    public function ajaxEliminarConcepto(){
    
        $table = "tblIngresos_Detalle"; 
        $id = $_POST["id"]; 
        $nameId = "id";
    
        $respuesta = IngresosDetallesControlador::ctrEliminarIngresosDetalles($table, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    

}
if(isset($_POST["accion"]) && $_POST["accion"] == 1){
	
	$Ingresos= new AjaxIngresosDetalles();
    $Ingresos-> clinica = $_SESSION['S_CLINICA']; 
    $Ingresos-> ajaxObtenerFolioPago();

}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar el detalle del pago

    $agregarDetalle = new AjaxIngresosDetalles();
    $agregarDetalle -> id = $_POST["id"];
    $agregarDetalle -> folio_detalle = $_POST["folio_detalle"];
    $agregarDetalle -> id_concepto = $_POST["id_concepto"];
    $agregarDetalle -> cantidad = $_POST["cantidad"];
    $agregarDetalle -> precio = $_POST["precio"];
    $agregarDetalle -> importe = $_POST["importe"];
    $agregarDetalle -> ajaxCargarDetalle();
                         
}else {
     
	if((isset($_POST["arr"]))){
        $Ingresos = new AjaxIngresosDetalles();
        $Ingresos -> ajaxListarIngresosDetalles();
		
		$registrar = new AjaxVentas();
		$registrar -> ajaxRegistrarVenta($_POST["arr"],$_POST['nro_boleta'],$_POST['total_venta'],$_POST['descripcion_venta']);

	}
 }
