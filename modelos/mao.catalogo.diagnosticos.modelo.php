<?php

require_once "conexion.php"; // Asegúrate de que este archivo exista y configure la conexión PDO.

class ModeloDiagnosticos {

    /*=============================================
    OBTENER SIGUIENTE ID DE DIAGNOSTICO
    =============================================*/
    static public function mdlObtenerSiguienteIdDiagnostico($tabla) {
        $stmt = null;
        try {
            $stmt = Conexion::conectar()->prepare("SELECT IFNULL(MAX(id_diagnostico), 0) + 1 as siguiente_id FROM $tabla");
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        } finally {
            if ($stmt) {
                if (method_exists($stmt, 'closeCursor')) {
                    $stmt->closeCursor();
                }
                $stmt = null;
            }
        }
        return $resultado;
    }

    /*=============================================
    MOSTRAR DIAGNOSTICOS
    =============================================*/
    static public function mdlMostrarDiagnosticos($tabla, $item, $valor) {
        $stmt = null;
        $resultado = null;
        try {
            if ($item != null) {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR); // Asumir STR, ajustar si es INT y $item es numérico
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $stmt = Conexion::conectar()->prepare(
                    "SELECT cd.id_diagnostico, cd.codigo_estandar, cd.nombre_diagnostico, 
                            cd.descripcion_detallada,  
                            catd.nombre_categoria AS nombre_categoria_diagnostico, 
                            cd.creado_en, cd.actualizado_en 
                     FROM $tabla cd 
                     LEFT JOIN CategoriasDiagnostico catd ON cd.id_categoria_diagnostico = catd.id_categoria_diagnostico"
                );
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } finally {
            if ($stmt) {
                if (method_exists($stmt, 'closeCursor')) {
                    $stmt->closeCursor();
                }
                $stmt = null;
            }
        }
        return $resultado;
    }

    /*=============================================
    MOSTRAR CATEGORIAS DE DIAGNOSTICO
    =============================================*/
    static public function mdlMostrarCategoriasDiagnostico($tablaCategorias) {
        $stmt = null;
        $resultado = null;
        try {
            $stmt = Conexion::conectar()->prepare(
                "SELECT id_categoria_diagnostico, nombre_categoria, descripcion_categoria
                                FROM $tablaCategorias"
            );
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } finally {
            if ($stmt) {
                if (method_exists($stmt, 'closeCursor')) {
                    $stmt->closeCursor();
                }
                $stmt = null;
            }
        }
        return $resultado;
    }

    /*=============================================
    REGISTRO DE DIAGNOSTICO
    =============================================*/
    static public function mdlIngresarDiagnostico($tabla, $datos) {
        $stmt = null;
        try {
            $stmt = Conexion::conectar()->prepare(
                "INSERT INTO $tabla(id_diagnostico, codigo_estandar, nombre_diagnostico, descripcion_detallada, id_categoria_diagnostico) 
                 VALUES (:id_diagnostico, :codigo_estandar, :nombre_diagnostico, :descripcion_detallada, :id_categoria_diagnostico)"
            );

            $stmt->bindParam(":id_diagnostico", $datos["id_diagnostico"], PDO::PARAM_INT);
            $stmt->bindParam(":codigo_estandar", $datos["codigo_estandar"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_diagnostico", $datos["nombre_diagnostico"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_detallada", $datos["descripcion_detallada"], PDO::PARAM_STR);
            $stmt->bindParam(":id_categoria_diagnostico", $datos["id_categoria_diagnostico"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            // Considerar loggear el error $e->getMessage()
            return "error";
        } finally {
            if ($stmt) {
                // Para INSERT/UPDATE/DELETE, closeCursor no es aplicable.
                // Si 'close' es un método específico del wrapper de conexión del ejemplo:
                if (method_exists($stmt, 'closeCursor')) {
                    $stmt->closeCursor();
                }
                $stmt = null;
            }
        }
    }

    /*=============================================
    EDITAR DIAGNOSTICO
    =============================================*/
    static public function mdlEditarDiagnostico($tabla, $datos) {
        $stmt = null;
        try {
            $stmt = Conexion::conectar()->prepare(
                "UPDATE $tabla 
                 SET codigo_estandar = :codigo_estandar, 
                     nombre_diagnostico = :nombre_diagnostico, 
                     descripcion_detallada = :descripcion_detallada, 
                     id_categoria_diagnostico = :id_categoria_diagnostico 
                 WHERE id_diagnostico = :id_diagnostico"
            );

            $stmt->bindParam(":id_diagnostico", $datos["id_diagnostico"], PDO::PARAM_INT);
            $stmt->bindParam(":codigo_estandar", $datos["codigo_estandar"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_diagnostico", $datos["nombre_diagnostico"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_detallada", $datos["descripcion_detallada"], PDO::PARAM_STR);
            $stmt->bindParam(":id_categoria_diagnostico", $datos["id_categoria_diagnostico"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            // Considerar loggear el error $e->getMessage()
            return "error";
        } finally {
            if ($stmt) {
                 
                $stmt = null;
            }
        }
    }

    /*=============================================
    BORRAR DIAGNOSTICO
    =============================================*/
    static public function mdlBorrarDiagnostico($tabla, $idDiagnostico) {
        $stmt = null;
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_diagnostico = :id_diagnostico");
            $stmt->bindParam(":id_diagnostico", $idDiagnostico, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) { // Capturar específicamente PDOException
            // Considerar loggear el error $e->getMessage() para depuración
            return "error";
        } finally {
            if ($stmt) {
                 
                $stmt = null;
            }
        }
    }
}

?>