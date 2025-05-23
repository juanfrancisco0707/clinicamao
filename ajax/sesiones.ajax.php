<?php
session_start(); 

require_once "../controladores/sesiones.controlador.php";
require_once "../modelos/sesiones.modelo.php"; 
require_once "../modelos/conexion.php"; 

class AjaxSesiones {

    public function ajaxRegistrarSesion() {
        $datos = array(
            "id_cita" => $_POST["id_cita_sesion"],
            "id_servicio" => $_POST["selServicio"],
            "fecha_hora" => $_POST["fechaHoraSesion"],
            "notas" => $_POST["notasSesion"]
            // "id_empresa" => $_SESSION['S_IDCLINICA'] // Si es necesario
        );
        $respuesta = SesionesControlador::ctrRegistrarSesion($datos);
        echo json_encode($respuesta);
    }

    public function ajaxListarSesionesPorCita() {
        if (isset($_POST["id_cita_para_sesiones"])) {
            $id_cita = $_POST["id_cita_para_sesiones"];
            $respuesta = SesionesControlador::ctrListarSesionesPorCita($id_cita);
            echo json_encode($respuesta);
        } else {
            echo json_encode(array("resultado" => "error", "mensaje" => "ID de cita no proporcionado."));
        }
    }

    public function ajaxObtenerSesionPorId() {
        if (isset($_POST["id_sesion_obtener"])) {
            $id_sesion = $_POST["id_sesion_obtener"];
            $respuesta = SesionesControlador::ctrObtenerSesionPorId($id_sesion);
            echo json_encode($respuesta); 
        } else {
            echo json_encode(array("resultado" => "error", "mensaje" => "ID de sesión no proporcionado."));
        }
    }

    public function ajaxActualizarSesion() {
        $datos = array(
            "id_sesion" => $_POST["id_sesion_editar"],
            "id_cita" => $_POST["id_cita_sesion_editar"], 
            "id_servicio" => $_POST["selServicio"], // Asegúrate que el ID del select sea el mismo
            "fecha_hora" => $_POST["fechaHoraSesion"],
            "notas" => $_POST["notasSesion"]
        );
        $respuesta = SesionesControlador::ctrActualizarSesion($datos);
        echo json_encode($respuesta);
    }

    public function ajaxEliminarSesion() {
        if (isset($_POST["id_sesion_eliminar"])) {
            $id_sesion = $_POST["id_sesion_eliminar"];
            $respuesta = SesionesControlador::ctrEliminarSesion($id_sesion);
            echo json_encode($respuesta);
        } else {
            echo json_encode(array("resultado" => "error", "mensaje" => "ID de sesión no proporcionado para eliminar."));
        }
    }
}

if (isset($_POST["accionSesion"])) {
    $sesionAjax = new AjaxSesiones();
    switch ($_POST["accionSesion"]) {
        case "registrar":
            $sesionAjax->ajaxRegistrarSesion();
            break;
        case "listarPorCita":
            $sesionAjax->ajaxListarSesionesPorCita();
            break;
        case "obtenerPorId":
            $sesionAjax->ajaxObtenerSesionPorId();
            break;
        case "actualizar":
            $sesionAjax->ajaxActualizarSesion();
            break;
        case "eliminar":
            $sesionAjax->ajaxEliminarSesion();
            break;
    }
}
?>
