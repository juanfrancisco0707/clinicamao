<?php

require_once "../controladores/mao.inventario.controlador.php";
require_once "../modelos/mao.inventario.modelo.php";

class AjaxInventario {
    public $id_item;
    public $nombre;
    public $descripcion;
    public $cantidad;
    public $precio_unitario;

    /*===================================================================
    LISTAR ITEMS DE INVENTARIO
    ====================================================================*/
    public function ajaxListarInventario() {
        $inventario = InventarioControlador::ctrListarInventario();
        echo json_encode($inventario, JSON_UNESCAPED_UNICODE);
    }

    /*===================================================================
    REGISTRAR ITEM DE INVENTARIO
    ====================================================================*/
    public function ajaxRegistrarItem() {
        $respuesta = InventarioControlador::ctrRegistrarItem($this->nombre, $this->descripcion, $this->cantidad, $this->precio_unitario);
        echo json_encode($respuesta);
    }

    /*===================================================================
    ACTUALIZAR ITEM DE INVENTARIO
    ====================================================================*/
    public function ajaxActualizarItem() {
        $respuesta = InventarioControlador::ctrActualizarItem($this->id_item, $this->nombre, $this->descripcion, $this->cantidad, $this->precio_unitario);
        echo json_encode($respuesta);
    }

    /*=============================================
    ELIMINAR ITEM DE INVENTARIO
    =============================================*/
    public function ajaxEliminarItem() {
        $respuesta = InventarioControlador::ctrEliminarItem($_POST["id_item"]);
        echo json_encode($respuesta);
    }
    /*===================================================================
    OBTENER ITEM DE INVENTARIO
    ====================================================================*/
    public function ajaxObtenerItem() {
        $inventario = InventarioModelo::mdlListarInventario();
        $item = array_filter($inventario, function($item) {
            return $item["id_item"] == $_POST["id_item"];
        });
        echo json_encode(array_shift($item));
    }
}

/*=============================================
ACCIONES
=============================================*/
if (isset($_POST['accion'])) {
    $ajax = new AjaxInventario();

    switch ($_POST['accion']) {
        case 'listar':
            $ajax->ajaxListarInventario();
            break;
        case 'registrar':
            $ajax->nombre = $_POST["nombre"];
            $ajax->descripcion = $_POST["descripcion"];
            $ajax->cantidad = $_POST["cantidad"];
            $ajax->precio_unitario = $_POST["precio_unitario"];
            $ajax->ajaxRegistrarItem();
            break;
        case 'actualizar':
            $ajax->id_item = $_POST["id_item"];
            $ajax->nombre = $_POST["nombre"];
            $ajax->descripcion = $_POST["descripcion"];
            $ajax->cantidad = $_POST["cantidad"];
            $ajax->precio_unitario = $_POST["precio_unitario"];
            $ajax->ajaxActualizarItem();
            break;
        case 'eliminar':
            $ajax->ajaxEliminarItem();
            break;
        case 'obtener':
            $ajax->ajaxObtenerItem();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción desconocida.']);
            break;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Acción no especificada.']);
}
