<?php

class CitasControlador {

    static public function ctrRegistrarCita($datos) {
        // Aquí podrías añadir validaciones de datos si es necesario
        if (empty($datos["id_paciente"]) || empty($datos["id_fisioterapeuta"]) || empty($datos["fecha_hora"])) {
            return array("resultado" => "error", "mensaje" => "Faltan datos obligatorios para registrar la cita.");
        }

        // Asegurarse de que id_empresa esté en $datos
        $datos["id_empresa"] = $_SESSION['S_IDCLINICA']; // O de donde la obtengas
        $datos["fecha_hora_formateada"] = str_replace('T', ' ', $datos["fecha_hora"]) . ':00';

        // Verificar disponibilidad
        $conflictos = CitasModelo::mdlVerificarDisponibilidadCita($datos["id_fisioterapeuta"], $datos["fecha_hora_formateada"], $datos["id_empresa"]);

        if ($conflictos > 0) {
            return array("resultado" => "error", "mensaje" => "El especialista ya tiene una cita programada en esa fecha y hora.");
        }

        $respuesta = CitasModelo::mdlRegistrarCita("tblcitas", $datos); // Usar nombre real de la tabla

        if (isset($respuesta["resultado"]) && $respuesta["resultado"] == "ok") { // Ajuste para coincidir con el retorno del modelo
            return array("resultado" => "ok");
        } else {
            // $respuesta podría contener información del error de PDO
            return array("resultado" => "error", "mensaje" => "Error al guardar la cita en la base de datos.", "detalle" => $respuesta);
        }
    }
    /*=============================================
    OBTENER CITA POR ID
    =============================================*/
    static public function ctrObtenerCitaPorId($id_cita) {
        // La validación de si id_cita existe debería hacerse en la capa AJAX
        // o al principio de este método si se llama directamente desde otro lugar.        
        $respuesta = CitasModelo::mdlObtenerCitaPorId($id_cita);
        return $respuesta; // El controlador devuelve los datos, AJAX se encarga del JSON
    }

    /*=============================================
    ACTUALIZAR CITA
    =============================================*/
    static public function ctrActualizarCita($datos) {
        // Aquí podrías añadir validaciones de datos si es necesario
        if (empty($datos["id_cita"]) || empty($datos["id_paciente"]) || empty($datos["id_fisioterapeuta"]) || empty($datos["fecha_hora"])) {
            return array("resultado" => "error", "mensaje" => "Faltan datos obligatorios para actualizar.");
        }

        // Asegurarse de que id_empresa esté en $datos si es necesario para el WHERE en el modelo
        // $datos["id_empresa"] = $_SESSION['S_IDCLINICA'];
        $datos["fecha_hora_formateada"] = str_replace('T', ' ', $datos["fecha_hora"]) . ':00';
        $id_empresa_actual = $_SESSION['S_IDCLINICA']; // Asumimos que la empresa no cambia al actualizar

        // Verificar disponibilidad, excluyendo la cita actual
        $conflictos = CitasModelo::mdlVerificarDisponibilidadCita($datos["id_fisioterapeuta"], $datos["fecha_hora_formateada"], $id_empresa_actual, $datos["id_cita"]);

        if ($conflictos > 0) {
            return array("resultado" => "error", "mensaje" => "El especialista ya tiene otra cita programada en esa fecha y hora.");
        }

        $respuesta = CitasModelo::mdlActualizarCita("tblcitas", $datos); // Usar nombre real de la tabla
        return $respuesta; // El modelo debería devolver un array como ['resultado' => 'ok'] o ['resultado' => 'error', 'mensaje' => '...']
    }
    static public function ctrListarCitas() {
        $tabla = "citas"; // Usar nombre real de la tabla
        // Asumimos que tienes una tabla Pacientes y Fisioterapeutas (tblmaoespecialistas)
        // para obtener los nombres para el título del evento.
        $respuesta = CitasModelo::mdlListarCitas($tabla);
        
        $eventos = array();
        foreach ($respuesta as $fila) {
            $backgroundColor = '#3788d8'; // Color azul por defecto de FullCalendar
            $textColor = '#ffffff';       // Texto blanco por defecto

            if ($fila['estado'] == 'Confirmada') {
                $backgroundColor = '#28a745'; // Verde
                $textColor = '#ffffff';
            } elseif ($fila['estado'] == 'Pendiente') {
                $backgroundColor = '#ffc107'; // Amarillo
                $textColor = '#000000';       // Texto negro para mejor contraste con amarillo
            } elseif ($fila['estado'] == 'Cancelada') {
                $backgroundColor = '#dc3545'; // Rojo
                $textColor = '#ffffff';
            } elseif ($fila['estado'] == 'Completada') {
                $backgroundColor = '#6c757d'; // Gris
                $textColor = '#ffffff';
            }

            $eventos[] = array(
                "id" => $fila["id_cita"], // ID del evento
                "title" => $fila["nombre_paciente"] . " / " . $fila["nombre_fisioterapeuta"] . ($fila['motivo'] ? ' (' . $fila['motivo'] . ')' : ''), // Título del evento
                "start" => $fila["fecha_hora"], // Fecha y hora de inicio
                // "end" => $fila["fecha_hora_fin"], // Si tienes una fecha de fin diferente
                "allDay" => false, // O true si son eventos de día completo
                // Puedes añadir más propiedades personalizadas aquí
                "motivo" => $fila["motivo"],
                "estado" => $fila["estado"],
                "backgroundColor" => $backgroundColor,
                "borderColor" => $backgroundColor, // Usualmente el mismo que el fondo
                "textColor" => $textColor,
                "extendedProps" => array(
                    "id_paciente" => $fila["id_paciente"], // Asegúrate que esta columna exista en tu consulta de mdlListarCitas
                    "id_fisioterapeuta" => $fila["id_fisioterapeuta"], // Ejemplo, si también lo necesitas
                    // "motivo_cita" => $fila["motivo"], // Ya lo tienes fuera, pero podrías moverlo aquí
                    // "estado_cita" => $fila["estado"] // Ya lo tienes fuera, pero podrías moverlo aquí
                )
            );
        }
        return $eventos;
    }
}

?>
