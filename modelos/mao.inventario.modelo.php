<?php
require_once "conexion.php";

class InventarioModelo {
    /*===================================================================
    OBTENER LISTADO TOTAL DE ITEMS DE INVENTARIO PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarInventario() {
        $stmt = Conexion::conectar()->prepare("SELECT id_item, nombre, descripcion, cantidad, precio_unitario FROM tblmao_inventario");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /*===================================================================
    REGISTRAR ITEM DE INVENTARIO
    ====================================================================*/
    static public function mdlRegistrarItem($nombre, $descripcion, $cantidad, $precio_unitario) {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO tblmao_inventario(nombre, descripcion, cantidad, precio_unitario) 
                                                    VALUES (:nombre, :descripcion, :cantidad, :precio_unitario)");

            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(":precio_unitario", $precio_unitario, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' . $e->getMessage() . "\n";
        }

        return $resultado;
        $stmt = null;
    }

    /*===================================================================
    ACTUALIZAR ITEM DE INVENTARIO
    ====================================================================*/
    static public function mdlActualizarItem($id_item, $nombre, $descripcion, $cantidad, $precio_unitario) {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE tblmao_inventario SET nombre = :nombre, descripcion = :descripcion, cantidad = :cantidad, precio_unitario = :precio_unitario WHERE id_item = :id_item");

            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(":precio_unitario", $precio_unitario, PDO::PARAM_STR);
            $stmt->bindParam(":id_item", $id_item, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $resultado = "ok";
            } else {
                $resultado = "error";
            }
        } catch (Exception $e) {
            $resultado = 'Excepción capturada: ' . $e->getMessage() . "\n";
        }

        return $resultado;
        $stmt = null;
    }

    /*=============================================
    Peticion DELETE para eliminar datos
    =============================================*/
    static public function mdlEliminarItem($id_item) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM tblmao_inventario WHERE id_item = :id_item");
        $stmt->bindParam(":id_item", $id_item, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return Conexion::conectar()->errorInfo();
        }
    }
    
    /*===================================================================
    LISTAR NOMBRE DE ITEMS PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombreItems(){

        $stmt = Conexion::conectar()->prepare("SELECT id_item, nombre FROM tblmao_inventario");

        $stmt -> execute();

        return $stmt->fetchAll();
    }
}
?>
