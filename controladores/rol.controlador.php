<?php

class RolesControlador{

    static public function ctrListarRoles(){
        
        $roles = RolesModelo::mdlListarRoles();

        return $roles;

    }
    static public function ctrListarRolescb(){
        
        $Rolescb = RolesModelo::mdlListarRolescb();

        return $Rolescb;

    }

    static public function ctrRegistrarRol($id, $nombre_rol){
    
        $registroRol = RolesModelo::mdlRegistrarRoles($id, $nombre_rol);
    
        return $registroRol;
    }
    
   
    
    static public function ctrActualizarRol($table, $data, $id, $nameId){
        
        $respuesta = RolesModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
    }
    
    static public function ctrEliminarRol($table, $id, $nameId)
    {
        $respuesta = RolesModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    LISTAR NOMBRE DE Rol PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombreRoles(){
    
        $Rol = RolesModelo::mdlListarNombreRoles();
    
        return $Rol;
    }
    
}