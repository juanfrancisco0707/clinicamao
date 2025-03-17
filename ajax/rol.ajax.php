<?php

require_once "../controladores/rol.controlador.php";
require_once "../modelos/rol.modelo.php";

class AjaxRoles{

    public $id;
    public $nombre_rol;

    public function ajaxListarRoles(){

        $roles = RolesControlador::ctrListarRoles();

        echo json_encode($roles, JSON_UNESCAPED_UNICODE);
    }
    public function ajaxRegistrarRoles(){
                                               
        $Roles = RolesControlador::ctrRegistrarRol($this->id, $this->nombre_rol,
        );
    
        echo json_encode($Roles);
    }  
    public function ajaxActualizarRoless($data){
            
        $table = "rol";
        $id = $_POST["id"];
        $nameId = "id";
    
        $respuesta = RolesControlador::ctrActualizarRol($table, $data, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    public function ajaxEliminarRoles(){
    
        $table = "rol"; 
        $id = $_POST["id"]; 
        $nameId = "id";
    
        $respuesta = RolesControlador::ctrEliminarRol($table, $id, $nameId);
    
        echo json_encode($respuesta);
    }
    
    
}
        //$Roless = new AjaxRoless();
        //$Roless -> ajaxListarRoless();
    
if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar Roless
    
        $Roles = new ajaxRoles();
        $Roles -> ajaxListarRoles();
        
 }else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Roles
    
        $registrarRoles = new AjaxRoles();
        $registrarRoles -> id = $_POST["id"];
        $registrarRoles -> nombre_rol = $_POST["nombre_rol"];
     
        
        $registrarRoles -> ajaxRegistrarRoles();
        
 }else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Roles
     
        $actualizarRoles = new AjaxRoles();
    
        $data = array(
            "id" => $_POST["id"],
            "nombre_rol" => $_POST["nombre_rol"],
         
        );
                               
        $actualizarRoles -> ajaxActualizarRoless($data);
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN Roles
    
        $eliminarRoles = new ajaxRoles();
        $eliminarRoles -> ajaxEliminarRoles();
        
    
}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE RolesS PARA EL AUTOCOMPLETE
    
      //  $nombreRoles = new AjaxRoless();
      //  $nombreRoles -> ajaxListarNombreRoles();
    
}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){ // OBTENER DATOS DE UN RolesS POR SU ID
    
       // $listaRoles = new AjaxRoless();
    
       // $listaRoles -> id = $_POST["id"];
        
      // $listaRoles -> ajaxGetDatosRoless();
        
}





//$roles = new AjaxRoles();
//$roles -> ajaxListarRoles();