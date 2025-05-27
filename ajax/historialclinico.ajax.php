<?php
// Iniciar sesión si vas a usar variables de sesión como $_SESSION["id_usuario"]
session_start();

require_once "../controladores/historialclinico.controlador.php";
require_once "../modelos/historialclinico.modelo.php";
require_once "../modelos/conexion.php"; // El modelo ya lo incluye, pero por si acaso.

class AjaxHistorialClinico
{
    public function ajaxMostrarHistorialPorPaciente()
    {
        // $_POST["id_paciente"] se establece en el controlador
        $respuesta = ControladorHistorialClinico::ctrMostrarHistorialPorPaciente();
        echo json_encode($respuesta);
    }

    public function ajaxRegistrarHistorial()
    {
        $respuesta = ControladorHistorialClinico::ctrRegistrarHistorial();
        echo json_encode($respuesta);
    }

    public function ajaxObtenerHistorialPorId()
    {
        $respuesta = ControladorHistorialClinico::ctrObtenerHistorialPorId();
        echo json_encode($respuesta);
    }
    
    public function ajaxObtenerHistorialPorSesion()
    {
        $respuesta = ControladorHistorialClinico::ctrObtenerHistorialPorSesion();
        echo json_encode($respuesta);
    }

    public function ajaxEditarHistorial()
    {
        $respuesta = ControladorHistorialClinico::ctrEditarHistorial();
        echo json_encode($respuesta);
    }

    public function ajaxEliminarHistorial()
    {
        $respuesta = ControladorHistorialClinico::ctrEliminarHistorial();
        echo json_encode($respuesta);
    }

    public function ajaxObtenerSesionesSinHistorial() {
        $respuesta = ControladorHistorialClinico::ctrObtenerSesionesSinHistorial();
        echo json_encode($respuesta);
    }

    public function ajaxObtenerCatalogoDiagnosticos() {
        $respuesta = ControladorHistorialClinico::ctrObtenerCatalogoDiagnosticos();
        echo json_encode($respuesta);
    }
    public function ajaxObtenerDetallesSesionPorId() {
        $respuesta = ControladorHistorialClinico::ctrObtenerDetallesSesionPorId();
        echo json_encode($respuesta);
    }
}

if (isset($_POST["accionHistorial"])) {
    $accion = $_POST["accionHistorial"];
    $historialAjax = new AjaxHistorialClinico();

    switch ($accion) { 
        case "mostrarPorPaciente":
            $historialAjax->ajaxMostrarHistorialPorPaciente();
            break;
        case "registrar":
            $historialAjax->ajaxRegistrarHistorial();
            break;
        case "obtenerPorId":
            $historialAjax->ajaxObtenerHistorialPorId();
            break;
        case "obtenerPorSesion":
            $historialAjax->ajaxObtenerHistorialPorSesion();
            break;
        case "editar":
            $historialAjax->ajaxEditarHistorial();
            break;
        case "eliminar":
            $historialAjax->ajaxEliminarHistorial();
            break;
        case "obtenerSesionesSinHistorial":
            $historialAjax->ajaxObtenerSesionesSinHistorial();
            break;
        case "obtenerCatalogoDiagnosticos":
            $historialAjax->ajaxObtenerCatalogoDiagnosticos();
            break;
        case "obtenerDetallesSesionPorId":
            $historialAjax->ajaxObtenerDetallesSesionPorId();
            break;
    }
}
