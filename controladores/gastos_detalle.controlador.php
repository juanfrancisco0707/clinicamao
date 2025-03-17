<?php

class Gastos_detalleControlador{

    static public function ctrListarGastos_detalle(){
        
        $gastos_detalle = gastos_detalleModelo::mdlListarGastos_detalle();

        return $gastos_detalle;

    }
}