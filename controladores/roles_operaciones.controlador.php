<?php

class Roles_operacionesControlador{

    static public function ctrListarRoles_operaciones(){
        
        $roles_operaciones = Roles_operacionesModelo::mdlListarRoles_operaciones();

        return $roles_operaciones;

    }
}