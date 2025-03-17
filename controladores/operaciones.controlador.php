<?php

class OperacionesControlador{

    static public function ctrListarOperaciones(){
        
        $operaciones = OperacionesModelo::mdlListarOperaciones();

        return $operaciones;

    }
}