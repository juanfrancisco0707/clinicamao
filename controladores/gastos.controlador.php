<?php

class ModulosGastos{

    static public function ctrListarGastos(){
        
        $gastos = gastosModelo::mdlListarGastos();

        return $gastos;

    }
}