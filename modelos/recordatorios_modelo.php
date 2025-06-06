<?php
// d:\xampp\htdocs\mao\modelos\recordatorios_modelo.php

require_once __DIR__ . '/conexion.php';

class ModeloRecordatorios {

    /**
     * Obtiene las citas para el día siguiente que están pendientes de recordatorio.
     */
    static public function mdlObtenerCitasParaRecordatorio($fecha_inicio, $fecha_fin) {
        
        $stmt = null;
        try {
            $conn = Conexion::conectar();
            $sql = "SELECT
                        c.id_cita, c.fecha_hora, c.motivo, c.id_empresa,
                        p.nombre AS nombre_paciente, p.correo AS correo_paciente, p.telefono AS telefono_paciente,
                        f.nombre AS nombre_fisioterapeuta, f.apellido AS apellido_fisioterapeuta
                    FROM citas c
                     JOIN tblpacientes p ON c.id_paciente = p.id AND c.id_empresa = p.id_empresa
                    JOIN tblmaoespecialistas f ON c.id_fisioterapeuta = f.id_fisioterapeuta AND c.id_empresa = f.id_empresa

                    WHERE c.fecha_hora >= :fecha_inicio AND c.fecha_hora <= :fecha_fin
                    AND c.estado IN ('Confirmada', 'Pendiente')
                    AND c.recordatorio_enviado = 0
                    ORDER BY c.fecha_hora ASC";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":fecha_inicio", $fecha_inicio, PDO::PARAM_STR);
            $stmt->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar error, loggear, etc.
            error_log("Error en mdlObtenerCitasParaRecordatorio: " . $e->getMessage());
            return []; // Devolver array vacío en caso de error
        } finally {
            if ($stmt) $stmt->closeCursor();
            $conn = null;
        }
    }
     /**
     * Cuenta las citas para un rango de fechas específico que están pendientes de recordatorio.
     * @param string $fecha_inicio Formato Y-m-d H:i:s
     * @param string $fecha_fin Formato Y-m-d H:i:s
     * @return int Cantidad de citas encontradas.
     */
    static public function mdlContarCitasPendientesRecordatorio($fecha_inicio, $fecha_fin) {
        $stmt = null;
        try {
            $conn = Conexion::conectar();
            $sql = "SELECT COUNT(c.id_cita) as total_citas
                    FROM citas c
                    WHERE c.fecha_hora >= :fecha_inicio AND c.fecha_hora <= :fecha_fin
                    AND c.estado IN ('Confirmada', 'Pendiente')
                    AND c.recordatorio_enviado = 0";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":fecha_inicio", $fecha_inicio, PDO::PARAM_STR);
            $stmt->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ? (int)$resultado['total_citas'] : 0;

        } catch (PDOException $e) {
            error_log("Error en mdlContarCitasPendientesRecordatorio: " . $e->getMessage());
            return 0;
        } finally {
            if ($stmt) {
                $stmt->closeCursor();
            }
            $conn = null;
        }
    }
}