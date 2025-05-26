<?php

require_once "conexion.php"; // Asegúrate que la ruta a tu archivo de conexión sea correcta

class ModeloHistorialClinico
{

    /**
     * Muestra todas las entradas del historial clínico para un paciente específico.
     */
    static public function mdlMostrarHistorialPorPaciente($idPaciente)
    {
        // Necesitamos unir HistorialClinicoSesion -> Sesiones -> Citas para llegar al id_paciente
        // También unimos con CatalogoDiagnosticos y opcionalmente con CategoriasDiagnostico
        $stmt = Conexion::conectar()->prepare(
            "SELECT 
                hc.id_historial, hc.id_sesion, hc.fecha_evaluacion, 
                hc.subjetivo, hc.objetivo, hc.id_diagnostico,
                hc.plan_tratamiento_sesion, hc.objetivos_corto_plazo, hc.objetivos_largo_plazo,
                hc.recomendaciones_domiciliarias, hc.evolucion_notas, hc.proxima_cita_sugerida,
                s.fecha_hora as fecha_hora_sesion,
                cd.nombre_diagnostico,
                catd.nombre_categoria as nombre_categoria_diagnostico
            FROM HistorialClinicoSesion hc
            JOIN tblSesiones s ON hc.id_sesion = s.id_sesion
            JOIN Citas ct ON s.id_cita = ct.id_cita
            LEFT JOIN CatalogoDiagnosticos cd ON hc.id_diagnostico = cd.id_diagnostico
            LEFT JOIN CategoriasDiagnostico catd ON cd.id_categoria_diagnostico = catd.id_categoria_diagnostico
            WHERE ct.id_paciente = :id_paciente
            ORDER BY hc.fecha_evaluacion DESC"
        );

        $stmt->bindParam(":id_paciente", $idPaciente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    /**
     * Registra una nueva entrada en el historial clínico.
     * $datos debe contener todos los campos de la tabla HistorialClinicoSesion.
     */
    static public function mdlRegistrarHistorial($datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO HistorialClinicoSesion 
            (id_sesion, fecha_evaluacion, subjetivo, objetivo, id_diagnostico, 
            plan_tratamiento_sesion, objetivos_corto_plazo, objetivos_largo_plazo, 
            recomendaciones_domiciliarias, evolucion_notas, proxima_cita_sugerida, creado_por) 
            VALUES 
            (:id_sesion, :fecha_evaluacion, :subjetivo, :objetivo, :id_diagnostico, 
            :plan_tratamiento_sesion, :objetivos_corto_plazo, :objetivos_largo_plazo, 
            :recomendaciones_domiciliarias, :evolucion_notas, :proxima_cita_sugerida, :creado_por)"
        );

        $stmt->bindParam(":id_sesion", $datos["id_sesion"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_evaluacion", $datos["fecha_evaluacion"], PDO::PARAM_STR);
        $stmt->bindParam(":subjetivo", $datos["subjetivo"], PDO::PARAM_STR);
        $stmt->bindParam(":objetivo", $datos["objetivo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_diagnostico", $datos["id_diagnostico"], $datos["id_diagnostico"] == null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindParam(":plan_tratamiento_sesion", $datos["plan_tratamiento_sesion"], PDO::PARAM_STR);
        $stmt->bindParam(":objetivos_corto_plazo", $datos["objetivos_corto_plazo"], PDO::PARAM_STR);
        $stmt->bindParam(":objetivos_largo_plazo", $datos["objetivos_largo_plazo"], PDO::PARAM_STR);
        $stmt->bindParam(":recomendaciones_domiciliarias", $datos["recomendaciones_domiciliarias"], PDO::PARAM_STR);
        $stmt->bindParam(":evolucion_notas", $datos["evolucion_notas"], PDO::PARAM_STR);
        $stmt->bindParam(":proxima_cita_sugerida", $datos["proxima_cita_sugerida"], $datos["proxima_cita_sugerida"] == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(":creado_por", $datos["creado_por"], $datos["creado_por"] == null ? PDO::PARAM_NULL : PDO::PARAM_INT); // Asumiendo que tienes un sistema de usuarios

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    /**
     * Obtiene una entrada específica del historial por su ID.
     */
    static public function mdlObtenerHistorialPorId($idHistorial)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM HistorialClinicoSesion WHERE id_historial = :id_historial");
        $stmt->bindParam(":id_historial", $idHistorial, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    }
    
    /**
     * Obtiene una entrada específica del historial por id_sesion.
     */
    static public function mdlObtenerHistorialPorSesion($idSesion)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM HistorialClinicoSesion WHERE id_sesion = :id_sesion");
        $stmt->bindParam(":id_sesion", $idSesion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Asume una entrada por sesión debido al UNIQUE
        $stmt = null;
    }


    /**
     * Edita una entrada existente en el historial clínico.
     */
    static public function mdlEditarHistorial($datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE HistorialClinicoSesion SET 
            id_sesion = :id_sesion, fecha_evaluacion = :fecha_evaluacion, subjetivo = :subjetivo, 
            objetivo = :objetivo, id_diagnostico = :id_diagnostico, plan_tratamiento_sesion = :plan_tratamiento_sesion, 
            objetivos_corto_plazo = :objetivos_corto_plazo, objetivos_largo_plazo = :objetivos_largo_plazo, 
            recomendaciones_domiciliarias = :recomendaciones_domiciliarias, evolucion_notas = :evolucion_notas, 
            proxima_cita_sugerida = :proxima_cita_sugerida -- , actualizado_por = :actualizado_por (si tienes este campo)
            WHERE id_historial = :id_historial"
        );

        $stmt->bindParam(":id_historial", $datos["id_historial"], PDO::PARAM_INT);
        $stmt->bindParam(":id_sesion", $datos["id_sesion"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_evaluacion", $datos["fecha_evaluacion"], PDO::PARAM_STR);
        $stmt->bindParam(":subjetivo", $datos["subjetivo"], PDO::PARAM_STR);
        $stmt->bindParam(":objetivo", $datos["objetivo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_diagnostico", $datos["id_diagnostico"], $datos["id_diagnostico"] == null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindParam(":plan_tratamiento_sesion", $datos["plan_tratamiento_sesion"], PDO::PARAM_STR);
        $stmt->bindParam(":objetivos_corto_plazo", $datos["objetivos_corto_plazo"], PDO::PARAM_STR);
        $stmt->bindParam(":objetivos_largo_plazo", $datos["objetivos_largo_plazo"], PDO::PARAM_STR);
        $stmt->bindParam(":recomendaciones_domiciliarias", $datos["recomendaciones_domiciliarias"], PDO::PARAM_STR);
        $stmt->bindParam(":evolucion_notas", $datos["evolucion_notas"], PDO::PARAM_STR);
        $stmt->bindParam(":proxima_cita_sugerida", $datos["proxima_cita_sugerida"], $datos["proxima_cita_sugerida"] == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        // $stmt->bindParam(":actualizado_por", $datos["actualizado_por"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    /**
     * Elimina una entrada del historial clínico.
     */
    static public function mdlEliminarHistorial($idHistorial)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM HistorialClinicoSesion WHERE id_historial = :id_historial");
        $stmt->bindParam(":id_historial", $idHistorial, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt = null;
    }

    /**
     * Obtiene todas las sesiones de un paciente que aún no tienen una entrada en HistorialClinicoSesion.
     * Útil para el select al agregar una nueva evolución desde la ficha del paciente.
     */
    static public function mdlObtenerSesionesSinHistorial($idPaciente)
    {
        $stmt = Conexion::conectar()->prepare(
            "SELECT s.id_sesion, s.fecha_hora, serv.nombre_servicio
            FROM tblSesiones s
            JOIN Citas ct ON s.id_cita = ct.id_cita
            JOIN tblmao_Servicio serv ON s.id_servicio = serv.id_servicio
            LEFT JOIN HistorialClinicoSesion hc ON s.id_sesion = hc.id_sesion
            WHERE ct.id_paciente = :id_paciente AND hc.id_historial IS NULL AND ct.estado = 'Completada'
            ORDER BY s.fecha_hora DESC"
        );
        $stmt->bindParam(":id_paciente", $idPaciente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }

    /**
     * Obtiene todos los diagnósticos del catálogo para poblar un select.
     */
    static public function mdlObtenerCatalogoDiagnosticos()
    {
        $stmt = Conexion::conectar()->prepare("SELECT id_diagnostico, nombre_diagnostico, codigo_estandar FROM CatalogoDiagnosticos ORDER BY nombre_diagnostico ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }
}
