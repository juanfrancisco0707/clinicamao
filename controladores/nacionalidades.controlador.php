<?php

class NacionalidadesControlador{

    static public function ctrListarNacionalidades(){
        
        $nacionalidades = NacionalidadesModelo::mdlListarNacionalidades();

        return $nacionalidades;

    }
}