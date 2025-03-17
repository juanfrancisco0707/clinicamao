<?php
session_start();
if(!isset($_SESSION['S_IDUSUARIO'])){
	header('Location: ../Login/index.php');
}
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{
    public $usu_id;
    public $usu_nombre;
    public $usu_contrasena;
    public $rol_id;
    public $usu_estatus;
    public $usu_correo;
    public $usu_nombre_completo;
    public $usu_clinica;
    public $contra_actual;
    public $contra_paso;

    public function ajaxListarUsuarios(){

        $usuarios = UsuariosControlador::ctrListarUsuarios();

        echo json_encode($usuarios, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxValidarContra(){

        $respuesta = UsuariosControlador::ctrVerificarContra($this->contra_actual,$this->contra_paso);

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxRegistrarUsuarios(){
        
        $Usuario = UsuariosControlador::ctrRegistrarUsuario($this->usu_id, $this->usu_nombre,
        $this->usu_contrasena, $this->rol_id, $this->usu_estatus, $this->usu_correo,$this->usu_nombre_completo,
                    $this->usu_clinica);

        echo json_encode($Usuario);
    }

   

    public function ajaxActualizarUsuarios($data){
        
        $table = "usuarios";
        $usu_id = $_POST["usu_id"];
        $nameId = "usu_id";

        $respuesta = UsuariosControlador::ctrActualizarUsuario($table, $data, $usu_id, $nameId);

        echo json_encode($respuesta);
    }

    public function ajaxEliminarUsuario(){

        $table = "usuarios"; 
        $id = $_POST["usu_id"]; 
        $nameId = "usu_id";

        $respuesta = UsuariosControlador::ctrEliminarUsuario($table, $id, $nameId);

        echo json_encode($respuesta);
    }
    /*===================================================================
    BUSCAR UsuarioS POR SU ID
    ====================================================================*/
    public function ajaxGetDatosUsuario(){
     
        $Usuario = UsuariosControlador::ctrGetDatosUsuario($this->usu_id);
        echo json_encode($Usuario, JSON_UNESCAPED_UNICODE);
       // echo json_encode($Usuario);
    }
    /*===================================================================
    BUSCAR USUARIOS POR SU ID y ACTIVOS
    ====================================================================*/
    public function ajaxGetDatosUsuarioActivo(){
     
        $Usuario = UsuariosControlador::ctrGetDatosUsuarioActivo($this->usu_id);

        echo json_encode($Usuario);
    }
    public function ajaxGetDatosUsuarioPerfil(){
     
        $UsuarioPerfil = UsuariosControlador::ctrGetDatosUsuarioPerfil($this->usu_id);
        echo json_encode($UsuarioPerfil, JSON_UNESCAPED_UNICODE);
       // echo json_encode($Usuario);
    }
    public function ajaxGetDatosUsuarioLogin(){
     
        $UsuarioLogin = UsuariosControlador::ctrGetDatosUsuarioLogin($this->usu_nombre);
      //  echo json_encode($UsuarioLogin, JSON_UNESCAPED_UNICODE);
        echo json_encode($UsuarioLogin);
       // echo json_encode($Usuario);
    }
   
}

  if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar Usuarios

    $Usuarios = new ajaxUsuarios();
    
    $Usuarios -> ajaxListarUsuarios();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Usuarios

    $registrarUsuario = new AjaxUsuarios();
    $registrarUsuario -> usu_id = $_POST["usu_id"];
    $registrarUsuario -> usu_nombre = $_POST["usu_nombre"];
    $registrarUsuario -> usu_contrasena = password_hash($_POST['usu_contrasena'],PASSWORD_DEFAULT,['cost'=>12]);//$_POST["usu_contrasena"];
    $registrarUsuario -> rol_id = $_POST["rol_id"];
    $registrarUsuario -> usu_estatus = $_POST["usu_estatus"];
    $registrarUsuario -> usu_correo = $_POST["usu_correo"];
    
    $registrarUsuario -> usu_nombre_completo = $_POST["usu_nombre_completo"];
    $registrarUsuario -> usu_clinica = $_POST["usu_clinica"];

    $registrarUsuario -> ajaxRegistrarUsuarios();
   // $contra = password_hash($_POST['contrasena'],PASSWORD_DEFAULT,['cost'=>10]);

}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Usuario
 
    $actualizarUsuario = new ajaxUsuarios();

    $data = array(
        "usu_id" => $_POST["usu_id"],
        "usu_nombre" => $_POST["usu_nombre"],
        "usu_contrasena" => password_hash($_POST['usu_contrasena'],PASSWORD_DEFAULT,['cost'=>12]), //$_POST["usu_contrasena"],
        "rol_id" => $_POST["rol_id"],
        "usu_estatus" => $_POST["usu_estatus"],
        "usu_correo" => $_POST["usu_correo"],
       
        "usu_nombre_completo" => $_POST["usu_nombre_completo"],
        "usu_clinica" => $_POST["usu_clinica"],
    );
                           
    $actualizarUsuario -> ajaxActualizarUsuarios($data);
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 44){ // ACCION PARA ACTUALIZAR UN Usuario
 
    $actualizarUsuario = new ajaxUsuarios();

    $data = array(
        "usu_id" => $_POST["usu_id"],
        "usu_nombre" => $_POST["usu_nombre"],
        "usu_contrasena" => password_hash($_POST['usu_contrasena'],PASSWORD_DEFAULT,['cost'=>12]), //$_POST["usu_contrasena"],
      
        "usu_estatus" => $_POST["usu_estatus"],
        "usu_correo" => $_POST["usu_correo"],
       
        "usu_nombre_completo" => $_POST["usu_nombre_completo"],
       
    );
                           
    $actualizarUsuario -> ajaxActualizarUsuarios($data);
    
}

else if(isset($_POST['accion']) && $_POST['accion'] == 8){ // ACCION PARA MODIFICAR UN USUARIO
 
        $actualizarUsuario = new ajaxUsuarios();
    
        $data = array(
            "usu_id" => $_POST["usu_id"],
        "usu_nombre" => $_POST["usu_nombre"],
        "usu_contrasena" => $_POST["usu_contrasena"],
        "rol_id" => $_POST["rol_id"],
        "usu_estatus" => $_POST["usu_estatus"],
        "usu_correo" => $_POST["usu_correo"],
       
        "usu_nombre_completo" => $_POST["usu_nombre_completo"],
        "usu_clinica" => $_POST["usu_clinica"],
        );
                               
        $actualizarUsuario -> ajaxActualizarUsuarios($data);
}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN USUARIO

    $eliminarUsuario = new ajaxUsuarios();
    $eliminarUsuario -> ajaxEliminarUsuario();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE Usuarios PARA EL AUTOCOMPLETE

  //  $nombreUsuarios = new AjaxUsuarios();
  //  $nombreUsuarios -> ajaxListarNombreUsuarios();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN Usuario POR SU ID

    $listaUsuario = new AjaxUsuarios();

    $listaUsuario -> usu_id = $_POST["usu_id"];
    
    $listaUsuario -> ajaxGetDatosUsuario();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 99){ // OBTENER DATOS DE UN Usuario POR SU ID y ACTIVO

    $listaUsuarioActivo = new AjaxUsuarios();

    $listaUsuarioActivo -> usu_id = $_POST["usu_id"];
    
    $listaUsuarioActivo -> ajaxGetDatosUsuarioActivo();
   // 
}else if(isset($_POST["accion"]) && $_POST["accion"] == 77){ // OBTENER DATOS DE UN Usuario POR SU ID

    $listaUsuario = new AjaxUsuarios();
    $listaUsuario -> usu_id =  $_SESSION['S_IDUSUARIO'];   
    $listaUsuario -> ajaxGetDatosUsuario();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 78){ // OBTENER DATOS DE UN Usuario POR SU ID

    $verificarcontra = new AjaxUsuarios();
    $verificarcontra -> contra_actual = $_POST["contra_actual"];
    $verificarcontra -> contra_paso= $_POST["contra_paso"];
    $verificarcontra -> ajaxValidarContra();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 79){ // OBTENER DATOS DE UN Usuario POR SU ID para modificar el perfil

    $listaPerfil = new AjaxUsuarios();
    $listaPerfil-> usu_id =  $_SESSION['S_IDUSUARIO'];   
    $listaPerfil -> ajaxGetDatosUsuarioPerfil();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 80){ //BUASCAR A L
    
    $buscarusuario= new AjaxUsuarios();
    $buscarusuario-> usu_nombre =   $_POST["usu_nombre"]; 
    $buscarusuario -> ajaxGetDatosUsuarioLogin();


}

else if(isset($_FILES)){
   
}





