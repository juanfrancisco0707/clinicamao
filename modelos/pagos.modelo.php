<?php
require_once "conexion.php"; // Asegúrate que la ruta a tu conexión sea correcta

class ModeloPagos {
    static public function mdlIngresarPago($tabla, $datos) {
        //$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_cita, id_paciente, fecha_pago, monto_transaccion, metodo_pago, referencia_pago, notas_pago, id_usuario_registra, estado_transaccion) VALUES (:id_cita, :id_paciente, NOW(), :monto_transaccion, :metodo_pago, :referencia_pago, :notas_pago, :id_usuario_registra, 'Aplicado')");
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_cita, id_paciente, fecha_pago, monto_transaccion, descuento_aplicado, metodo_pago, referencia_pago, notas_pago, id_usuario_registra, estado_transaccion) VALUES (:id_cita, :id_paciente, NOW(), :monto_transaccion, :descuento_aplicado, :metodo_pago, :referencia_pago, :notas_pago, :id_usuario_registra, 'Aplicado')");

        $stmt->bindParam(":id_cita", $datos["id_cita"], PDO::PARAM_INT);
        $stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
        $stmt->bindParam(":monto_transaccion", $datos["monto_transaccion"], PDO::PARAM_STR);
         $stmt->bindParam(":descuento_aplicado", $datos["descuento_aplicado"], PDO::PARAM_STR);
        $stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":referencia_pago", $datos["referencia_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":notas_pago", $datos["notas_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario_registra", $datos["id_usuario_registra"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            //return "ok";
            return Conexion::conectar()->lastInsertId(); // Devolver el ID del último registro insertado
        } else {
            // Considera loguear $stmt->errorInfo() para depuración
            return "error";
        }
        $stmt->closeCursor();
        $stmt = null;
    }

    static public function mdlMostrarPagosPorCita($tabla, $idCita) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_cita = :id_cita ORDER BY fecha_pago DESC");
        $stmt->bindParam(":id_cita", $idCita, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $stmt = null;
    }

    // Podrías necesitar más métodos aquí (editar, anular pago, etc.)
}
