<?php

class UsuariosControlador{

    static public function ctrListarUsuarios(){
        
        $usuarios = UsuariosModelo::mdlListarUsuarios();

        return $usuarios;

    }
    static public function ctrListarUsuarioscb(){
        
        $Usuarioscb = UsuariosModelo::mdlListarUsuarioscb();

        return $Usuarioscb;

    }
    static public function ctrGetDatosUsuarioActivo($id){

        $UsuariosActivo = UsuariosModelo::mdlListarUsuarioActivo($id);
    
        return $UsuariosActivo;
    
    }
    static public function ctrGetDatosUsuarioPerfil($id){

        $UsuariosPerfil = UsuariosModelo::mdlListarUsuarioPerfil($id);
    
        return $UsuariosPerfil;
    
    }
    static public function ctrGetDatosUsuarioLogin($usu_nombre){

        $UsuariosLogin = UsuariosModelo::mdlListarUsuarioLogin($usu_nombre);
    
        return $UsuariosLogin;
    
    }
    static public function ctrVerificarContra($contra_actual,$contra_paso){

        $UsuariosActivo = UsuariosModelo::mdlVerificarContra($contra_actual,$contra_paso);
    
        return $UsuariosActivo;
    
    }

    static public function ctrRegistrarUsuario($usu_id, $usu_nombre,
    $usu_contrasena,$rol_id,$usu_estatus,$usu_correo,$usu_nombre_completo,$usu_clinica){
    
        $registroUsuario = UsuariosModelo::mdlRegistrarUsuario($usu_id, $usu_nombre, $usu_contrasena,$rol_id,$usu_estatus,$usu_correo,$usu_nombre_completo,$usu_clinica);
    
        return $registroUsuario;
    }
    
   
    
    static public function ctrActualizarUsuario($table, $data, $id, $nameId){
        
        $respuesta = UsuariosModelo::mdlActualizarInformacion($table, $data, $id, $nameId);
        
        return $respuesta;
    }
    
    static public function ctrEliminarUsuario($table, $id, $nameId)
    {
        $respuesta = UsuariosModelo::mdlEliminarInformacion($table, $id, $nameId);
        
        return $respuesta;
    }
    
/*===================================================================
BUSCAR usuario POR SU id
====================================================================*/
static public function ctrGetDatosUsuario($codigo_Usuario){
        
    $Usuario = UsuariosModelo::mdlGetDatosUsuario($codigo_Usuario);

    return $Usuario;

}
    /*===================================================================
    LISTAR NOMBRE DE Usuario PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
   /* static public function ctrListarNombreUsuarios(){
    
        $Usuario = UsuariosModelo::mdlListarNombreUsuarios();
    
        return $Usuario;
    }*/
    
}