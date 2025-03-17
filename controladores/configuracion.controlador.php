<?php

class ConfiguracionControlador{

    static public function ctrGetDatosConfiguracion($id){

        $usuario_permiso_modulo = ConfiguracionModelo::mdlGetDatosConfiguracion($id);

        return $usuario_permiso_modulo;
    }

    static public function ctrGetVentasMesActual(){

        $ventasMesActual = ConfiguracionModelo::mdlGetVentasMesActual();

        return $ventasMesActual;
    }

    static public function ctrProductosMasVendidos(){
    
        $productosMasVendidos = ConfiguracionModelo::mdlProductosMasVendidos();
    
        return $productosMasVendidos;
    
    }

    static public function ctrProductosPocoStock(){
    
        $productosPocoStock = ConfiguracionModelo::mdlProductosPocoStock();
    
        return $productosPocoStock;
    
    }

    

   
}