<?php

// require_once "conexion.php"; // Si no está autocargada

class CitasModelo {
    /*=============================================
    REGISTRAR CITA
    =============================================*/
    static public function mdlRegistrarCita($tabla, $datos) {
        // Asumimos que $datos ya incluye "id_empresa" desde el controlador
        $stmt = Conexion::conectar()->prepare("INSERT INTO citas (id_paciente, id_fisioterapeuta, fecha_hora, motivo, estado, id_empresa) VALUES (:id_paciente, :id_fisioterapeuta, :fecha_hora, :motivo, :estado, :id_empresa)");

        $stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
        $stmt->bindParam(":id_fisioterapeuta", $datos["id_fisioterapeuta"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_hora", $datos["fecha_hora_formateada"], PDO::PARAM_STR); // Usar la fecha formateada
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->closeCursor(); // Buena práctica cerrar el cursor
            $stmt = null;         // y liberar el statement
            return array("resultado" => "ok", "mensaje" => "Cita registrada correctamente.");
        } else {
            $errorInfo = $stmt->errorInfo();
            return array("resultado" => "error", "mensaje" => "Error al registrar la cita.", "detalle" => $errorInfo);
        }
        $stmt = null;
    }

    /*=============================================
    LISTAR CITAS (PARA FULLCALENDAR U OTROS LISTADOS GENERALES)
    DEBE FILTRAR POR EMPRESA
    =============================================*/
    static public function mdlListarCitas($tabla) {
        // $tabla es "Citas", pero tu tabla real podría ser "tblcitas"
        // Asegúrate de que S_IDCLINICA esté disponible.
        // Es mejor pasar id_empresa como parámetro desde el controlador.
        // Por ahora, asumiré que está en la sesión para este ejemplo,
        // pero pasarla como argumento es más limpio.
        $id_empresa_actual = isset($_SESSION['S_IDCLINICA']) ? $_SESSION['S_IDCLINICA'] : null;

        if ($id_empresa_actual === null) {
            return array(); // No hay empresa, no hay citas que mostrar
        }

        $stmt = Conexion::conectar()->prepare(
            "SELECT
                c.id_cita,
                c.fecha_hora,
                c.id_paciente,      -- Añadido id_paciente
                c.id_fisioterapeuta, -- Añadido id_fisioterapeuta
                c.id_empresa, -- Añadido id_empresa
                c.motivo,
                c.estado,
                p.NOMBRE AS nombre_paciente,
                CONCAT(f.nombre, ' ', f.apellido) AS nombre_fisioterapeuta
            FROM citas c
            INNER JOIN tblpacientes p ON c.id_paciente = p.id AND c.id_empresa = p.id_empresa -- Clave compuesta
            LEFT JOIN tblmaoespecialistas f ON c.id_fisioterapeuta = f.id_fisioterapeuta -- Asumiendo que especialistas es global o se filtra de otra forma
            WHERE c.id_empresa = :id_empresa" 
        );

        $stmt->bindParam(":id_empresa", $id_empresa_actual, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
    }
    // Dentro de la clase ModeloCitas

    static public function mdlObtenerSesionesPorCita($idCita) {
        // Asumo que tu tabla de sesiones se llama 'sesiones' y tiene 'id_cita' e 'id_servicio'
        $stmt = Conexion::conectar()->prepare("SELECT s.*, serv.nombre_servicio, serv.precio 
                                            FROM tblsesiones s
                                            JOIN tblmao_servicio serv ON s.id_servicio = serv.id_servicio
                                            WHERE s.id_cita = :id_cita");
        $stmt->bindParam(":id_cita", $idCita, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = null;
    }


    /*=============================================
    OBTENER CITA POR ID (Añadir filtro por empresa por seguridad)
    =============================================*/
    static public function mdlObtenerCitaPorId($id_cita) {
        // $id_empresa_actual = isset($_SESSION['S_IDCLINICA']) ? $_SESSION['S_IDCLINICA'] : null;
        // Si id_cita es globalmente único, el filtro de empresa no es estrictamente necesario aquí, pero no hace daño.
        $stmt = Conexion::conectar()->prepare("SELECT * FROM citas WHERE id_cita = :id_cita"); // Asumiendo que la tabla es tblcitas
        $stmt->bindParam(":id_cita", $id_cita, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = null;
        return $resultado;
    }

    /*=============================================
    ACTUALIZAR CITA (Añadir filtro por empresa por seguridad)
    =============================================*/
    static public function mdlActualizarCita($tabla, $datos) {
        // $id_empresa_actual = isset($_SESSION['S_IDCLINICA']) ? $_SESSION['S_IDCLINICA'] : null;
        $stmt = Conexion::conectar()->prepare(
            "UPDATE citas SET 
                id_paciente = :id_paciente, 
                id_fisioterapeuta = :id_fisioterapeuta, 
                fecha_hora = :fecha_hora, 
                motivo = :motivo, 
                estado = :estado 
                -- id_empresa no debería cambiar al actualizar una cita, se usa en el WHERE
            WHERE id_cita = :id_cita"
        );

        $stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
        $stmt->bindParam(":id_fisioterapeuta", $datos["id_fisioterapeuta"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_hora", $datos["fecha_hora_formateada"], PDO::PARAM_STR);
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":id_cita", $datos["id_cita"], PDO::PARAM_INT);
        // $stmt->bindParam(":id_empresa", $id_empresa_actual, PDO::PARAM_INT); // Para el WHERE si quieres más seguridad

        if ($stmt->execute()) {
            $stmt->closeCursor();
            $stmt = null;
            return array("resultado" => "ok", "mensaje" => "Cita actualizada correctamente.");
        } else {
            $errorInfo = $stmt->errorInfo();
            $stmt->closeCursor();
            $stmt = null;
            // Loguear $errorInfo[2] para depuración
            return array("resultado" => "error", "mensaje" => "Error al actualizar la cita en la base de datos.");
        }
    }

    /*=============================================
    VERIFICAR DISPONIBILIDAD DE CITA PARA UN ESPECIALISTA
    =============================================*/
    static public function mdlVerificarDisponibilidadCita($id_fisioterapeuta, $fecha_hora_formateada, $id_empresa, $id_cita_excluir = null) {
        $sql = "SELECT COUNT(*) as count 
                FROM tblcitas 
                WHERE id_fisioterapeuta = :id_fisioterapeuta 
                AND fecha_hora = :fecha_hora 
                AND id_empresa = :id_empresa
                AND estado NOT IN ('Cancelada', 'Completada')"; // No contar citas canceladas o completadas como conflicto

        if ($id_cita_excluir !== null) {
            $sql .= " AND id_cita != :id_cita_excluir";
        }

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id_fisioterapeuta", $id_fisioterapeuta, PDO::PARAM_INT);
        $stmt->bindParam(":fecha_hora", $fecha_hora_formateada, PDO::PARAM_STR);
        $stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);

        if ($id_cita_excluir !== null) {
            $stmt->bindParam(":id_cita_excluir", $id_cita_excluir, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchColumn(); // Devuelve el conteo directamente
    }
}

?>
