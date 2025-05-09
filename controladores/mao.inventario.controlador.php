<?php
class InventarioControlador {
    /*===================================================================
    LISTAR ITEMS DE INVENTARIO
    ====================================================================*/
    static public function ctrListarInventario() {
        $inventario = InventarioModelo::mdlListarInventario();
        return $inventario;
    }

    /*===================================================================
    REGISTRAR ITEM DE INVENTARIO
    ====================================================================*/
    static public function ctrRegistrarItem($nombre, $descripcion, $cantidad, $precio_unitario) {
        $registroItem = InventarioModelo::mdlRegistrarItem($nombre, $descripcion, $cantidad, $precio_unitario);
        return $registroItem;
    }

    /*===================================================================
    ACTUALIZAR ITEM DE INVENTARIO
    ====================================================================*/
    static public function ctrActualizarItem($id_item, $nombre, $descripcion, $cantidad, $precio_unitario) {
        $actualizarItem = InventarioModelo::mdlActualizarItem($id_item, $nombre, $descripcion, $cantidad, $precio_unitario);
        return $actualizarItem;
    }

    /*=============================================
    ELIMINAR ITEM DE INVENTARIO
    =============================================*/
    static public function ctrEliminarItem($id_item) {
        $respuesta = InventarioModelo::mdlEliminarItem($id_item);
        return $respuesta;
    }

    /*===================================================================
    LISTAR NOMBRE DE ITEMS PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function ctrListarNombreItems(){

        $items = InventarioModelo::mdlListarNombreItems();
        return $items;
    }
}
?>
