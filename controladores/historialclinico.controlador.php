<?php

// Si ModeloHistorialClinico.php no se carga automáticamente, inclúyelo:
// require_once "../modelos/historialclinico.modelo.php"; 

class ControladorHistorialClinico
{

    static public function ctrMostrarHistorialPorPaciente()
    {
        if (isset($_POST["id_paciente"])) {
            $idPaciente = $_POST["id_paciente"];
            $respuesta = ModeloHistorialClinico::mdlMostrarHistorialPorPaciente($idPaciente);
            return $respuesta; // Devuelve directamente el array para JSON
        }
        return []; // Devuelve array vacío si no hay id_paciente
    }

    static public function ctrRegistrarHistorial()
    {
        // Validar que los datos necesarios estén presentes
        if (
            isset($_POST["id_sesion_historial"]) && isset($_POST["fecha_evaluacion_historial"])
            // Añade más validaciones de campos obligatorios si es necesario
        ) {
            $datos = array(
                "id_sesion" => $_POST["id_sesion_historial"],
                "fecha_evaluacion" => $_POST["fecha_evaluacion_historial"],
                "subjetivo" => $_POST["subjetivo_historial"] ?? null,
                "objetivo" => $_POST["objetivo_historial"] ?? null,
                "id_diagnostico" => !empty($_POST["diagnostico_historial"]) ? $_POST["diagnostico_historial"] : null,
                "plan_tratamiento_sesion" => $_POST["plan_tratamiento_historial"] ?? null,
                "objetivos_corto_plazo" => $_POST["objetivos_corto_historial"] ?? null,
                "objetivos_largo_plazo" => $_POST["objetivos_largo_historial"] ?? null,
                "recomendaciones_domiciliarias" => $_POST["recomendaciones_historial"] ?? null,
                "evolucion_notas" => $_POST["evolucion_historial"] ?? null,
                "proxima_cita_sugerida" => !empty($_POST["proxima_cita_historial"]) ? $_POST["proxima_cita_historial"] : null,
                "creado_por" => $_SESSION["id_usuario"] ?? null // Asumiendo que guardas el id del usuario en sesión
            );

            $respuesta = ModeloHistorialClinico::mdlRegistrarHistorial($datos);
            return array("status" => $respuesta); // Devuelve "ok" o "error"
        } else {
            return array("status" => "error", "message" => "Faltan datos obligatorios.");
        }
    }

    static public function ctrObtenerHistorialPorId()
    {
        if (isset($_POST["id_historial_editar"])) {
            $idHistorial = $_POST["id_historial_editar"];
            $respuesta = ModeloHistorialClinico::mdlObtenerHistorialPorId($idHistorial);
            return $respuesta; // Devuelve el array del historial o false
        }
        return false;
    }
    
    static public function ctrObtenerHistorialPorSesion()
    {
        if (isset($_POST["id_sesion_ver_historial"])) {
            $idSesion = $_POST["id_sesion_ver_historial"];
            $respuesta = ModeloHistorialClinico::mdlObtenerHistorialPorSesion($idSesion);
            return $respuesta; 
        }
        return false;
    }

    static public function ctrEditarHistorial()
    {
        if (
            isset($_POST["id_historial_form"]) && isset($_POST["id_sesion_historial"]) && isset($_POST["fecha_evaluacion_historial"])
        ) {
            $datos = array(
                "id_historial" => $_POST["id_historial_form"],
                "id_sesion" => $_POST["id_sesion_historial"],
                "fecha_evaluacion" => $_POST["fecha_evaluacion_historial"],
                "subjetivo" => $_POST["subjetivo_historial"] ?? null,
                "objetivo" => $_POST["objetivo_historial"] ?? null,
                "id_diagnostico" => !empty($_POST["diagnostico_historial"]) ? $_POST["diagnostico_historial"] : null,
                "plan_tratamiento_sesion" => $_POST["plan_tratamiento_historial"] ?? null,
                "objetivos_corto_plazo" => $_POST["objetivos_corto_historial"] ?? null,
                "objetivos_largo_plazo" => $_POST["objetivos_largo_historial"] ?? null,
                "recomendaciones_domiciliarias" => $_POST["recomendaciones_historial"] ?? null,
                "evolucion_notas" => $_POST["evolucion_historial"] ?? null,
                "proxima_cita_sugerida" => !empty($_POST["proxima_cita_historial"]) ? $_POST["proxima_cita_historial"] : null,
                // "actualizado_por" => $_SESSION["id_usuario"] ?? null
            );

            $respuesta = ModeloHistorialClinico::mdlEditarHistorial($datos);
            return array("status" => $respuesta);
        } else {
            return array("status" => "error", "message" => "Faltan datos obligatorios para editar.");
        }
    }

    static public function ctrEliminarHistorial()
    {
        if (isset($_POST["id_historial_eliminar"])) {
            $idHistorial = $_POST["id_historial_eliminar"];
            $respuesta = ModeloHistorialClinico::mdlEliminarHistorial($idHistorial);
            return array("status" => $respuesta);
        }
        return array("status" => "error", "message" => "ID de historial no proporcionado.");
    }

    static public function ctrObtenerSesionesSinHistorial() {
        if (isset($_POST["id_paciente_sesiones"])) {
            $idPaciente = $_POST["id_paciente_sesiones"];
            $respuesta = ModeloHistorialClinico::mdlObtenerSesionesSinHistorial($idPaciente);
            return $respuesta;
        }
        return [];
    }

    static public function ctrObtenerCatalogoDiagnosticos() {
        $respuesta = ModeloHistorialClinico::mdlObtenerCatalogoDiagnosticos();
        return $respuesta;
    }
}
