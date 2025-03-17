<?php

class ModulosControlador{

    static public function ctrListarModulos(){
        
        $modulos = modulosModelo::mdlListarModulos();

        return $modulos;

    }
}