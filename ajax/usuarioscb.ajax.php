<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{


    public function ajaxListarUsuarios(){

        $usuarios = UsuariosControlador::ctrListarUsuarios();

        echo json_encode($usuarios, JSON_UNESCAPED_UNICODE);
    }
}

