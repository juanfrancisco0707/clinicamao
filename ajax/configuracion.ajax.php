<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/configuracion.controlador.php";
require_once "../modelos/configuracion.modelo.php";

class AjaxConfiguracion{
  //  public $id;
  //  public $id_rol;
  //  public $nombre_rol;
  //  public $id_modulo;
  //  public $nombre_modulo;
  //  public $consultar;
  //  public $grabar;
  //  public $actualizar;
  //  public $borrar;
    public $usu_id;


    public function getDatosconfiguracion(){
        $listaUsuariopermisos = ConfiguracionControlador::ctrGetDatosConfiguracion($this->usu_id);
        echo json_encode($listaUsuariopermisos, JSON_UNESCAPED_UNICODE); 
        
       // $datos = configuracionControlador::ctrGetDatosconfiguracion();
      //  echo json_encode($datos);
    }

    public function getVentasMesActual(){
        $ventasMesActual = configuracionControlador::ctrGetVentasMesActual();
        echo json_encode($ventasMesActual);
    }
    
    public function getProductosMasVendidos(){
    
        $productosMasVendidos = configuracionControlador::ctrProductosMasVendidos();
    
        echo json_encode($productosMasVendidos);
    
    }
    public function getProductosPocoStock(){
    
        $productosPocoStock = configuracionControlador::ctrProductosPocoStock();
    
        echo json_encode($productosPocoStock);
    
    }
    
  
}


if(isset($_POST['accion']) && $_POST['accion'] == 1){ //Ejecutar function ventas del mes (Grafico de Barras)

    $listaUsuariopermisos = new AjaxConfiguracion();
    $listaUsuariopermisos -> usu_id =  $_SESSION['S_IDUSUARIO'];   
    $listaUsuariopermisos -> GetDatosconfiguracion();
   // $ventasMesActual = new Ajaxconfiguracion();
   //$ventasMesActual -> getVentasMesActual();

}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ //Ejecutar function de productos mas vendidos


    $produtosMasVendidos = new Ajaxconfiguracion();
    $produtosMasVendidos -> getProductosMasVendidos();

}else if(isset($_POST['accion']) && $_POST['accion'] == 3){ //Ejecutar function de productos poco stock


    $productosPocoStock = new Ajaxconfiguracion();
    $productosPocoStock -> getProductosPocoStock();

}else{
    $datos = new Ajaxconfiguracion();
    $datos -> getDatosconfiguracion();
}