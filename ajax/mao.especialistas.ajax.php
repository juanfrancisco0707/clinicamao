<?php
require_once "../controladores/mao.especialistas.controlador.php";
require_once "../modelos/mao.especialistas.modelo.php";

class AjaxEspecialistas
{
    public $id_fisioterapeuta;
    public $nombre;
    public $apellido;
    public $especialidad;
    public $telefono;
    public $email;
    public $id_empresa;  
    public function ajaxListarEspecialistas()
    {
        $especialistas = EspecialistasControlador::ctrListarEspecialistas();
        echo json_encode($especialistas, JSON_UNESCAPED_UNICODE);
    }

    public function ajaxRegistrarEspecialista()
    {
        $data = array(
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "especialidad" => $this->especialidad,
            "telefono" => $this->telefono,
            "email" => $this->email,
            "id_empresa" => $this->id_empresa
        );

        $especialista = EspecialistasControlador::ctrRegistrarEspecialista($data);
        echo json_encode($especialista);
    }

    public function ajaxActualizarEspecialista($data)
    {
        $table = "tblmaoespecialistas";
        $id = $_POST["id_fisioterapeuta"];
        $nameId = "id_fisioterapeuta";
        $respuesta = EspecialistasControlador::ctrActualizarEspecialista($table, $data, $id, $nameId);
        echo json_encode($respuesta);
    }

    public function ajaxEliminarEspecialista()
    {
        $table = "tblmaoespecialistas";
        $id = $_POST["id_fisioterapeuta"];
        $nameId = "id_fisioterapeuta";
        $respuesta = EspecialistasControlador::ctrEliminarEspecialista($table, $id, $nameId);
        echo json_encode($respuesta);
    }
    public function ajaxObtenerEspecialista()
    {
        $id = $_POST["id_fisioterapeuta"];
        $especialista = EspecialistasControlador::ctrObtenerEspecialista($id);
        echo json_encode($especialista, JSON_UNESCAPED_UNICODE);
    }
}

/*=============================================
ACCIONES
=============================================*/
if (isset($_POST['accion']) && $_POST['accion'] == 1) { // parametro para listar especialistas
    $especialistas = new AjaxEspecialistas();
    $especialistas->ajaxListarEspecialistas();
} else if (isset($_POST['accion']) && $_POST['accion'] == 2) { // parametro para registrar especialista
    $registrarEspecialista = new AjaxEspecialistas();
    $registrarEspecialista->nombre = $_POST["nombre"];
    $registrarEspecialista->apellido = $_POST["apellido"];
    $registrarEspecialista->especialidad = $_POST["especialidad"];
    $registrarEspecialista->telefono = $_POST["telefono"];
    $registrarEspecialista->email = $_POST["email"];
    $registrarEspecialista->id_empresa = $_POST["id_empresa"];

    $registrarEspecialista->ajaxRegistrarEspecialista();
} else if (isset($_POST['accion']) && $_POST['accion'] == 4) { // ACCION PARA ACTUALIZAR UN especialista
    $actualizarEspecialista = new AjaxEspecialistas();

    $data = array(
        "nombre" => $_POST["nombre"],
        "apellido" => $_POST["apellido"],
        "especialidad" => $_POST["especialidad"],
        "telefono" => $_POST["telefono"],
        "email" => $_POST["email"],
        "id_empresa" => $_POST["id_empresa"]
    );

    $actualizarEspecialista->ajaxActualizarEspecialista($data);
} else if (isset($_POST['accion']) && $_POST['accion'] == 5) { // ACCION PARA ELIMINAR UN especialista
    $eliminarEspecialista = new AjaxEspecialistas();
    $eliminarEspecialista->ajaxEliminarEspecialista();
} else if (isset($_POST["accion"]) && $_POST["accion"] == 6) { // TRAER LISTADO DE especialistas PARA EL AUTOCOMPLETE
    // $nombreEspecialista = new AjaxEspecialistas();
    // $nombreEspecialista -> ajaxListarNombreEspecialista();
} else if (isset($_POST["accion"]) && $_POST["accion"] == 7) { // OBTENER DATOS DE UN especialista POR SU ID
    $listaEspecialista = new AjaxEspecialistas();
    $listaEspecialista->ajaxObtenerEspecialista();
}
