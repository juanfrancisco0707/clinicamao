<?php
require_once "conexion.php"; // Asegúrate que la ruta a tu archivo de conexión sea correcta

class SesionesModelo {

    // Registrar una nueva sesión
    static public function mdlRegistrarSesion($tabla, $datos) {
        // $datos debe contener: id_cita, id_servicio, fecha_hora_formateada, notas
        // Opcionalmente: id_empresa si las sesiones también dependen de la clínica
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_cita, id_servicio, fecha_hora, notas) VALUES (:id_cita, :id_servicio, :fecha_hora, :notas)");

        $stmt->bindParam(":id_cita", $datos["id_cita"], PDO::PARAM_INT);
        $stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_hora", $datos["fecha_hora_formateada"], PDO::PARAM_STR);
        $stmt->bindParam(":notas", $datos["notas"], PDO::PARAM_STR);
        // Si necesitas id_empresa: $stmt->bindParam(":id_empresa", $datos["id_empresa"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return array("resultado" => "ok", "id_sesion" => Conexion::conectar()->lastInsertId());
        } else {
            return array("resultado" => "error", "mensaje" => "Error en la base de datos al registrar sesión", "detalle" => $stmt->errorInfo());
        }
    }

    // Listar sesiones por ID de Cita
    static public function mdlListarSesionesPorCita($id_cita) {
        // Asumiendo que tienes una tabla 'tblservicios' para obtener el nombre del servicio
        $sql = "SELECT s.id_sesion, s.id_cita, s.id_servicio, s.fecha_hora, s.notas, serv.nombre_servicio 
                FROM tblsesiones s 
                LEFT JOIN tblmao_servicio serv ON s.id_servicio = serv.id_servicio
                WHERE s.id_cita = :id_cita
                ORDER BY s.fecha_hora DESC";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id_cita", $id_cita, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener una sesión por su ID
    static public function mdlObtenerSesionPorId($id_sesion) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM tblsesiones WHERE id_sesion = :id_sesion");
        $stmt->bindParam(":id_sesion", $id_sesion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar una sesión
    static public function mdlActualizarSesion($tabla, $datos) {
        // $datos debe contener: id_sesion, id_cita, id_servicio, fecha_hora_formateada, notas
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_servicio = :id_servicio, fecha_hora = :fecha_hora, notas = :notas WHERE id_sesion = :id_sesion AND id_cita = :id_cita");

        $stmt->bindParam(":id_sesion", $datos["id_sesion"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cita", $datos["id_cita"], PDO::PARAM_INT);
        $stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_hora", $datos["fecha_hora_formateada"], PDO::PARAM_STR);
        $stmt->bindParam(":notas", $datos["notas"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return array("resultado" => "ok");
        } else {
            return array("resultado" => "error", "mensaje" => "Error en la base de datos al actualizar sesión", "detalle" => $stmt->errorInfo());
        }
    }

    // Eliminar una sesión
    static public function mdlEliminarSesion($tabla, $id_sesion) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_sesion = :id_sesion");
        $stmt->bindParam(":id_sesion", $id_sesion, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return array("resultado" => "ok");
        } else {
            return array("resultado" => "error", "mensaje" => "Error en la base de datos al eliminar sesión", "detalle" => $stmt->errorInfo());
        }
    }

    // Contar sesiones por ID de Cita
    static public function mdlContarSesionesPorCita($id_cita) {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total_sesiones FROM tblsesiones WHERE id_cita = :id_cita");
        $stmt->bindParam(":id_cita", $id_cita, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve un array como ['total_sesiones' => X]
    }

}
?>
