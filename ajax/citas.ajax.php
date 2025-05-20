<?php
// Es importante incluir la sesión si vas a usar variables de sesión como S_IDCLINICA
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../controladores/citas.controlador.php";
require_once "../modelos/citas.modelo.php";
// También necesitarás la conexión si no está autocargada en los modelos/controladores
require_once "../modelos/conexion.php";


class AjaxCitas {
    
    
    
    public function ajaxRegistrarCita() {
        if (isset($_POST["id_paciente"])) {
            $datos = array(
                "id_paciente" => $_POST["id_paciente"],
                "id_fisioterapeuta" => $_POST["id_fisioterapeuta"],
                "fecha_hora" => $_POST["fecha_hora"],
                "motivo" => isset($_POST["motivo"]) ? $_POST["motivo"] : "",
                // "id_empresa" se añadirá en el controlador desde la sesión
                "estado" => $_POST["estado"]
            );

            $respuesta = CitasControlador::ctrRegistrarCita($datos);
            echo json_encode($respuesta); // $respuesta debería ser ['resultado' => 'ok'] o ['resultado' => 'error', 'mensaje' => '...']
        }
    }
    /*=============================================
    OBTENER CITA POR ID
    =============================================*/
    public function ajaxObtenerCitaPorId() {
        if (isset($_POST["id_cita"])) {
            $id_cita = $_POST["id_cita"];
            $respuesta = CitasControlador::ctrObtenerCitaPorId($id_cita);
            header('Content-Type: application/json');
            echo json_encode($respuesta);
        } else {
            header('Content-Type: application/json');
            echo json_encode(null); // O un objeto de error
        }
    }

    /*=============================================
    ACTUALIZAR CITA
    =============================================*/
    public function ajaxActualizarCita() {
        $respuesta = CitasControlador::ctrActualizarCita($_POST); // Enviamos todo el $_POST
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }
    public function ajaxListarCitas() {
        $respuesta = CitasControlador::ctrListarCitas();
        echo json_encode($respuesta); // Devuelve un array de eventos para FullCalendar
    }
}

if (isset($_GET["accion"]) && $_GET["accion"] == "listar") {
    $citas = new AjaxCitas();
    $citas->ajaxListarCitas();
} else if (isset($_POST["accion"]) && $_POST["accion"] == "registrarCita") {
    $citas = new AjaxCitas();
    $citas->ajaxRegistrarCita();
}else if ($_POST["accion"] == "obtenerCitaPorId") {
        $obtener = new AjaxCitas();
        $obtener->ajaxObtenerCitaPorId();
    } else if ($_POST["accion"] == "actualizarCita") {
        $actualizar = new AjaxCitas();
        $actualizar->ajaxActualizarCita();
    }

?>
