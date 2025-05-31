<?php
require_once "../controladores/pagos.controlador.php"; // Crear este controlador
require_once "../modelos/pagos.modelo.php";       // Crear este modelo
require_once "../modelos/citas.modelo.php";         // Para obtener detalles de la cita y sesiones
require_once "../modelos/pacientes.modelo.php";     // Para obtener nombre del paciente
require_once "../modelos/mao.especialistas.modelo.php"; // Para obtener nombre del fisio
require_once "../modelos/mao.servicios.modelo.php";     // Para obtener precios de servicios

class AjaxPagos {

    public $id_cita;
    public $id_paciente;
    public $monto_transaccion;
    public $descuento_aplicado;
    public $metodo_pago;
    public $referencia_pago;
    public $notas_pago;

    public function ajaxObtenerInfoPagoCita() {
        $respuesta = PagosControlador::ctrObtenerInfoPagoCita($this->id_cita);
        echo json_encode($respuesta);
    }

    public function ajaxRegistrarPago() {
        session_start(); // Para obtener el id_usuario_registra
        $datos = array(
            "id_cita" => $this->id_cita,
            "id_paciente" => $this->id_paciente,
            "monto_transaccion" => $this->monto_transaccion,
            "descuento_aplicado" => $this->descuento_aplicado,
            "metodo_pago" => $this->metodo_pago,
            "referencia_pago" => $this->referencia_pago,
            "notas_pago" => $this->notas_pago,
            "id_usuario_registra" => isset($_SESSION['S_IDUSUARIO']) ? $_SESSION['S_IDUSUARIO'] : null
        );
        $respuesta = PagosControlador::ctrRegistrarPago($datos);
        echo json_encode($respuesta);
    }
}

if (isset($_POST["accion"])) {
    $ajaxPagos = new AjaxPagos();

    if ($_POST["accion"] == "obtener_info_pago_cita") {
        $ajaxPagos->id_cita = $_POST["id_cita"];
        $ajaxPagos->ajaxObtenerInfoPagoCita();
    }

    if ($_POST["accion"] == "registrar_pago") {
        $ajaxPagos->id_cita = $_POST["id_cita"];
        $ajaxPagos->id_paciente = $_POST["id_paciente"];
        $ajaxPagos->monto_transaccion = $_POST["monto_transaccion"];
        $ajaxPagos->descuento_aplicado = $_POST["descuento_aplicado"];
        $ajaxPagos->metodo_pago = $_POST["metodo_pago"];
        $ajaxPagos->referencia_pago = $_POST["referencia_pago"];
        $ajaxPagos->notas_pago = $_POST["notas_pago"];
        $ajaxPagos->ajaxRegistrarPago();
    }
}
