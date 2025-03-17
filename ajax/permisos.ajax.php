<?php

require_once "../controladores/permisos.controlador.php";
require_once "../modelos/permisos.modelo.php";

class AjaxPermisos{

    public $id;
    public $id_rol;
    public $id_modulo;
    public $consultar;
    public $grabar; 
    public $actualizar; 
    public $borrar; 

    public function ajaxListarPermisos(){

        $Permisos = PermisosControlador::ctrListarPermisos();

        echo json_encode($Permisos, JSON_UNESCAPED_UNICODE);
    }
    /*===================================================================
    BUSCAR EL PERMISO, ROL Y MODULO
    ====================================================================*/
    public function ajaxGetDatosPermisos(){
        
        $permiso = permisosControlador::ctrGetDatosPermiso($this->id_rol,$this->id_modulo);

        echo json_encode($permiso);
    }
     /*===================================================================
    BUSCAR EL PERMISO POR ID
    ====================================================================*/
    public function ajaxGetDatosPermisosId(){
        
        $permisoId = permisosControlador::ctrGetDatosPermisoId($this->id);

        echo json_encode($permisoId);
    }
public function ajaxRegistrarPermisos(){
                                               
    $Permiso = PermisosControlador::ctrRegistrarPermiso($this->id, $this->id_rol,
    $this->id_modulo, 
    $this->consultar,$this->grabar,$this->actualizar,$this->borrar);

    echo json_encode($Permiso);
}  

public function ajaxActualizarPermisos($data){
        
    $table = "permisos";
    $id = $_POST["id"];
    $nameId = "id";

    $respuesta = PermisosControlador::ctrActualizarPermiso($table, $data, $id, $nameId);

    echo json_encode($respuesta);
}

public function ajaxEliminarPermiso(){

    $table = "permisos"; 
    $id = $_POST["id"]; 
    $nameId = "id";

    $respuesta = PermisosControlador::ctrEliminarPermiso($table, $id, $nameId);

    echo json_encode($respuesta);
}


}
    //$Permisos = new AjaxPermisos();
    //$Permisos -> ajaxListarPermisos();

if(isset($_POST['accion']) && $_POST['accion'] == 1){ // parametro para listar Permisos

    $Permisos = new ajaxPermisos();
    $Permisos -> ajaxListarPermisos();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 2){ // parametro para registrar Permiso

    $registrarPermiso = new AjaxPermisos();
    $registrarPermiso -> id = $_POST["id"];
    $registrarPermiso -> id_rol = $_POST["id_rol"];
    $registrarPermiso -> id_modulo = $_POST["id_modulo"];
    $registrarPermiso -> consultar = $_POST["consultar"];
    $registrarPermiso -> grabar = $_POST["grabar"];
    $registrarPermiso -> actualizar = $_POST["actualizar"];
    $registrarPermiso -> borrar = $_POST["borrar"];
    
    $registrarPermiso -> ajaxRegistrarPermisos();
    
}else if(isset($_POST['accion']) && $_POST['accion'] == 4){ // ACCION PARA ACTUALIZAR UN Permiso
 
    $actualizarPermiso = new AjaxPermisos();

    $data = array(
        "id" => $_POST["id"],
        "id_rol" => $_POST["id_rol"],
        "id_modulo" => $_POST["id_modulo"],
        "consultar" => $_POST["consultar"],       
        "grabar" => $_POST["grabar"],
        "actualizar" => $_POST["actualizar"],
        "borrar" => $_POST["borrar"],
    );
                           
    $actualizarPermiso -> ajaxActualizarPermisos($data);

}else if(isset($_POST['accion']) && $_POST['accion'] == 5){// ACCION PARA ELIMINAR UN Permiso

    $eliminarPermiso = new ajaxPermisos();
    $eliminarPermiso -> ajaxEliminarPermiso();
    

}else if(isset($_POST["accion"]) && $_POST["accion"] == 6){  // TRAER LISTADO DE Permisos PARA EL AUTOCOMPLETE

  //  $nombrePermiso = new AjaxPermisos();
  //  $nombrePermiso -> ajaxListarNombrePermiso();

}else if(isset($_POST["accion"]) && $_POST["accion"] == 7){  // TRAER LISTADO DE Permisos PARA EL AUTOCOMPLETE
    $listaPermiso = new AjaxPermisos();
    $listaPermiso -> id_rol = $_POST["id_rol"];
    $listaPermiso -> id_modulo = $_POST["id_modulo"];

   $listaPermiso -> ajaxGetDatosPermisos();
    //  $nombrePermiso = new AjaxPermisos();
    //  $nombrePermiso -> ajaxListarNombrePermiso();
  
  }else if(isset($_POST["accion"]) && $_POST["accion"] == 8){ // OBTENER DATOS DE UN Permisos POR SU ID

    $listaPermiso = new AjaxPermisos();
    $listaPermiso -> id = $_POST["id"];
   $listaPermiso -> ajaxGetDatosPermisosId();
	
}