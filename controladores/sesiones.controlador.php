<?php
// Si SesionesModelo.php no se carga automáticamente (ej. por un autoloader), inclúyelo:
// require_once "../modelos/sesiones.modelo.php"; 

class SesionesControlador {

    static public function ctrRegistrarSesion($datos) {
        if (empty($datos["id_cita"]) || empty($datos["id_servicio"]) || empty($datos["fecha_hora"])) {
            return array("resultado" => "error", "mensaje" => "Faltan datos obligatorios para registrar la sesión.");
        }
        $datos["fecha_hora_formateada"] = str_replace('T', ' ', $datos["fecha_hora"]) . ':00';
        // Podrías añadir id_empresa aquí si es relevante para las sesiones
        // $datos["id_empresa"] = $_SESSION['S_IDCLINICA'];

        $respuesta = SesionesModelo::mdlRegistrarSesion("tblsesiones", $datos); // Usa el nombre real de tu tabla de sesiones

        if (isset($respuesta["resultado"]) && $respuesta["resultado"] == "ok") {
            return array("resultado" => "ok", "mensaje" => "Sesión registrada correctamente.");
        } else {
            return array("resultado" => "error", "mensaje" => "Error al guardar la sesión.", "detalle" => $respuesta);
        }
    }

    static public function ctrListarSesionesPorCita($id_cita) {
        if (empty($id_cita)) {
            return array(); 
        }
        $respuesta = SesionesModelo::mdlListarSesionesPorCita($id_cita);
        return $respuesta; 
    }

    static public function ctrObtenerSesionPorId($id_sesion) {
        $respuesta = SesionesModelo::mdlObtenerSesionPorId($id_sesion);
        return $respuesta;
    }

    static public function ctrActualizarSesion($datos) {
        if (empty($datos["id_sesion"]) || empty($datos["id_cita"]) || empty($datos["id_servicio"]) || empty($datos["fecha_hora"])) {
            return array("resultado" => "error", "mensaje" => "Faltan datos obligatorios para actualizar la sesión.");
        }
        $datos["fecha_hora_formateada"] = str_replace('T', ' ', $datos["fecha_hora"]) . ':00';

        $respuesta = SesionesModelo::mdlActualizarSesion("tblsesiones", $datos);
        if (isset($respuesta["resultado"]) && $respuesta["resultado"] == "ok") {
            return array("resultado" => "ok", "mensaje" => "Sesión actualizada correctamente.");
        } else {
            return array("resultado" => "error", "mensaje" => "Error al actualizar la sesión.", "detalle" => $respuesta);
        }
    }

    static public function ctrEliminarSesion($id_sesion) {
        if (empty($id_sesion)) {
            return array("resultado" => "error", "mensaje" => "ID de sesión no proporcionado.");
        }
        $respuesta = SesionesModelo::mdlEliminarSesion("tblsesiones", $id_sesion);
        if (isset($respuesta["resultado"]) && $respuesta["resultado"] == "ok") {
            return array("resultado" => "ok", "mensaje" => "Sesión eliminada correctamente.");
        } else {
            return array("resultado" => "error", "mensaje" => "Error al eliminar la sesión.", "detalle" => $respuesta);
        }
    }
}
?>
