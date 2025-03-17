<?php

class PermisosControlador{

    static public function ctrListarPermisos(){
        
        $Permisos = PermisosModelo::mdlListarPermisos();

        return $Permisos;

    }
    static public function ctrListarPermisoscb(){
        
        $Permisoscb = PermisosModelo::mdlListarPermisoscb();

        return $Permisoscb;

    }

    static public function ctrRegistrarPermiso($id, $id_rol, $id_modulo,
    $consultar, $grabar,$actualizar,$borrar){
    
        $registroPermiso = PermisosModelo::mdlRegistrarPermiso($id, $id_rol, $id_modulo, $consultar,
                                                 $grabar,$actualizar,$borrar);
    
        return $registroPermiso;
    }
    
   
    
    static public function ctrActualizarPermiso($table, $data, $id, $nameId){
        
        $respuesta = PermisosModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
    }
    
    static public function ctrEliminarPermiso($table, $id, $nameId)
    {
        $respuesta = PermisosModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }
    
    /*===================================================================
    LISTAR NOMBRE DE Permiso PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombrePermisos(){
    
        $Permiso = PermisosModelo::mdlListarNombrePermisos();
    
        return $Permiso;
    }
    
    /*===================================================================
    BUSCAR Permiso POR el rol y modulo
    ==================================================================== */
    static public function ctrGetDatosPermiso($id_rol,$id_modulo){
            
        $Permiso = permisosmodelo::mdlGetDatosPermisos($id_rol,$id_modulo);
    
        return $Permiso;
    
    }
     /*===================================================================
    BUSCAR Permiso POR SU ID
    ==================================================================== */
    static public function ctrGetDatosPermisoId($id){
            
        $PermisoId= permisosmodelo::mdlGetDatosPermisosId($id);
    
        return $PermisoId;
    
    }
   
    
    
    

}