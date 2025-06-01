<?php

class PagosControlador {

    static public function ctrObtenerInfoPagoCita($idCita) {
        // Lógica para obtener:
        // 1. Datos de la cita (paciente, fisio, fecha) - Usar CitasModelo, PacientesModelo, EspecialistasModelo
        // 2. Sesiones de la cita y sus servicios con precios - Usar CitasModelo, ServiciosModelo
        // 3. Sumar precios para monto_total_calculado_cita
        // 4. Pagos previos de tblmao_pagos para esta cita - Usar PagosModelo
        // 5. Calcular total_ya_pagado_cita y monto_pendiente_cita
        // Devolver un array con toda esta información.

        // Ejemplo simplificado de la estructura de datos a devolver:
        $citaDetalles = CitasModelo::mdlObtenerCitaPorId($idCita); // Usamos el método existente
        
        // Determinar si $citaDetalles es un objeto o un array para acceder a sus propiedades
        $idPacienteCita = null;
        $idFisioCita = null;
        $idEmpresaCita = null; // Variable para el ID de la empresa de la cita
        if ($citaDetalles) {
            $idPacienteCita = is_object($citaDetalles) ? $citaDetalles->id_paciente : (isset($citaDetalles["id_paciente"]) ? $citaDetalles["id_paciente"] : null);
            $idFisioCita = is_object($citaDetalles) ? $citaDetalles->id_fisioterapeuta : (isset($citaDetalles["id_fisioterapeuta"]) ? $citaDetalles["id_fisioterapeuta"] : null);
            $idEmpresaCita = is_object($citaDetalles) ? $citaDetalles->id_empresa : (isset($citaDetalles["id_empresa"]) ? $citaDetalles["id_empresa"] : null);
        }
        $paciente = ($idPacienteCita && $idEmpresaCita) ? PacientesModelo::mdlGetDatosPaciente($idPacienteCita, $idEmpresaCita) : null;
        $fisioterapeuta = $idFisioCita ? EspecialistasModelo::mdlObtenerEspecialista($idFisioCita) : null; // mdlObtenerEspecialista devuelve un array

        $sesiones = CitasModelo::mdlObtenerSesionesPorCita($idCita); // Necesitarás crear este método en CitasModelo
        $detalleServicios = [];
        $montoTotalCalculado = 0;

        if ($sesiones) {
            foreach ($sesiones as $sesion) {
                $servicio = ModeloServicios::mdlMostrarServicios("tblmao_servicio", "id_servicio", $sesion["id_servicio"]); // Asume método
                if ($servicio) {
                    $detalleServicios[] = [
                        "nombre_servicio" => $servicio["nombre_servicio"],
                        "precio_servicio" => $servicio["precio"]
                    ];
                    $montoTotalCalculado += floatval($servicio["precio"]);
                }
            }
        }

        $historialPagos = ModeloPagos::mdlMostrarPagosPorCita("tblmao_pagos", $idCita);
        $totalYaPagado = 0;
        $totalDescuentosAplicados = 0;
        if ($historialPagos) {
            foreach ($historialPagos as $pago) {
                $totalYaPagado += floatval($pago["monto_transaccion"]);
                $totalDescuentosAplicados += floatval($pago["descuento_aplicado"]);
            }
        }
        //$montoPendiente = $montoTotalCalculado - $totalYaPagado;
        $montoPendiente = $montoTotalCalculado - ($totalYaPagado + $totalDescuentosAplicados);

        return array(
            "id_cita" => $idCita,
            "nombre_paciente" => $paciente ? $paciente->nombre : "Desconocido", // Acceso como objeto
            "id_paciente" => $idPacienteCita,
            "correo_paciente" => $paciente ? $paciente->correo : null,
            "nombre_fisioterapeuta" => $fisioterapeuta ? ($fisioterapeuta["nombre"] . " " . $fisioterapeuta["apellido"]) : "Desconocido", // $fisioterapeuta es array
            "fecha_cita" => $citaDetalles ? (is_object($citaDetalles) ? $citaDetalles->fecha_hora : $citaDetalles["fecha_hora"]) : "N/A",
            "sesiones_detalle" => $detalleServicios,
            "monto_total_calculado_cita" => $montoTotalCalculado,
            "total_ya_pagado_cita" => $totalYaPagado,
            "monto_pendiente_cita" => $montoPendiente,
            "historial_pagos" => $historialPagos ?: []
        );
    }

    static public function ctrRegistrarPago($datos) {
        // Validar datos
        // ...

        // Insertar en ModeloPagos::mdlIngresarPago
        $respuestaModelo = ModeloPagos::mdlIngresarPago("tblmao_pagos", $datos);

        // Verificar si la respuesta del modelo es un ID numérico válido y mayor que cero.
        // lastInsertId() devuelve una cadena que representa el ID, o '0' si no hubo AUTO_INCREMENT,
        // o false en algunos casos de error (aunque el modelo ya maneja "error_ejecucion").
        if (is_numeric($respuestaModelo) && intval($respuestaModelo) > 0) {
            return array("resultado" => "ok", "mensaje" => "Pago registrado exitosamente.", "id_pago" => $respuestaModelo);
        } else {
            // Puedes personalizar el mensaje de error basado en $respuestaModelo si es una cadena de error específica
            $mensajeError = "No se pudo registrar el pago. Modelo devolvió: " . htmlspecialchars($respuestaModelo);
            return array("resultado" => "error", "mensaje" => $mensajeError);
        }
    }
}
