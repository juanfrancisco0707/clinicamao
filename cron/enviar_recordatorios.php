<?php
// d:\xampp\htdocs\mao\cron\enviar_recordatorios.php

// Incluir la función de envío de correo
require_once __DIR__ . '/../ajax/enviar_recordatorio_cita_correo.php'; // Ajusta la ruta si es necesario

// Incluir modelos necesarios para obtener datos de la cita y actualizarla
require_once __DIR__ . '/../modelos/conexion.php'; // O tu archivo de conexión
//require_once __DIR__ . '/../modelos/citas.modelo.php'; // Para actualizar 'recordatorio_enviado'
// Es probable que necesites un modelo para obtener todos los detalles de la cita por su ID
// require_once __DIR__ . '/../modelos/recordatorios_modelo.php'; // O el modelo que uses para obtener detalles de citas

date_default_timezone_set('America/Mazatlan'); // O la zona horaria que uses

// Verificar si se recibieron citas seleccionadas
if (isset($_POST['citas_seleccionadas']) && is_array($_POST['citas_seleccionadas'])) {
    $ids_citas_seleccionadas = $_POST['citas_seleccionadas'];
    
    echo "Procesando " . count($ids_citas_seleccionadas) . " citas seleccionadas.&lt;br /&gt;";

    $citas_validas_encontradas = 0;

    foreach ($ids_citas_seleccionadas as $id_cita) {
        
        // --- INICIO: Obtener detalles completos de la cita desde la BD ---
        // ESTA PARTE ES CRUCIAL Y DEBES IMPLEMENTARLA SEGÚN TU MODELO DE DATOS.
        // Necesitas una función que, dado un $id_cita, te devuelva todos los detalles.
        // Ejemplo: $datos_cita = ModeloCitas::obtenerDetallesCompletosCita($id_cita);
        // $datos_cita debería ser un array asociativo con, al menos:
        // 'id_cita', 'nombre_paciente', 'correo_paciente', 'telefono_paciente', 
        // 'fecha_hora' (string de la BD), 'nombre_fisioterapeuta', 'apellido_fisioterapeuta', 
        // 'motivo_cita', 'nombre_clinica' (si aplica y es diferente por cita)
        
        // Simulación de obtención de datos (REEMPLAZA ESTO CON TU LÓGICA REAL):
        $datos_cita = null;
        try {
            $conn_temp = Conexion::conectar();
            $stmt_temp = $conn_temp->prepare(
                "SELECT c.id_cita, c.fecha_hora, c.motivo AS motivo_cita,
                        p.nombre AS nombre_paciente, p.correo AS correo_paciente, p.telefono AS telefono_paciente,
                        f.nombre AS nombre_fisioterapeuta, f.apellido AS apellido_fisioterapeuta,
                        emp.nombre AS nombre_clinica
                 FROM citas c
                 JOIN tblpacientes p ON c.id_paciente = p.id AND c.id_empresa = p.id_empresa
                 JOIN tblmaoespecialistas f ON c.id_fisioterapeuta = f.id_fisioterapeuta AND c.id_empresa = f.id_empresa
                 JOIN tblempresa emp ON c.id_empresa = emp.id
                 WHERE c.id_cita = :id_cita AND c.recordatorio_enviado = 0"
            );
            $stmt_temp->bindParam(":id_cita", $id_cita, PDO::PARAM_INT);
            $stmt_temp->execute();
            $datos_cita = $stmt_temp->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "  Error al obtener datos de cita ID: $id_cita - " . $e->getMessage() . "&lt;br /&gt;";
            continue;
        } finally {
            $stmt_temp = null;
            $conn_temp = null;
        }
        // --- FIN: Obtener detalles completos de la cita ---

        if (!$datos_cita) {
            // Esto podría pasar si la cita ya fue marcada como enviada o no existe.
            // echo "  No se encontraron detalles para la cita ID: $id_cita o ya fue procesada. Saltando.&lt;br /&gt;";
            continue;
        }
        
        $citas_validas_encontradas++;
        echo "Procesando cita ID: " . $datos_cita['id_cita'] . " para paciente: " . htmlspecialchars($datos_cita['nombre_paciente']) . "&lt;br /&gt;";

        $email_enviado_exitosamente = false;
        // $whatsapp_enviado = false; // Conceptual
        // $sms_enviado = false;    // Conceptual

        // 1. Enviar Email
        if (!empty($datos_cita['correo_paciente'])) {
            $fecha_hora_obj = new DateTime($datos_cita['fecha_hora']);
            $fecha_formateada_email = $fecha_hora_obj->format('d/m/Y \a \l\a\s H:i');
            $nombre_completo_fisio = trim($datos_cita['nombre_fisioterapeuta'] . ' ' . $datos_cita['apellido_fisioterapeuta']);
            
            $email_enviado_exitosamente = enviarCorreoRecordatorioCita(
                $datos_cita['id_cita'], // <--- ASEGÚRATE QUE ESTA LÍNEA ESTÉ ASÍ
                $datos_cita['correo_paciente'],
                $datos_cita['nombre_paciente'],
                $fecha_formateada_email,
                $nombre_completo_fisio,
                $datos_cita['motivo_cita'],
                $datos_cita['nombre_clinica'] ?: "Clínica MAO" // Nombre de la clínica o default
            );

            if ($email_enviado_exitosamente) {
                echo "  Email de recordatorio enviado a: " . htmlspecialchars($datos_cita['correo_paciente']) . "&lt;br /&gt;";
            } else {
                echo "  Error al enviar email de recordatorio a: " . htmlspecialchars($datos_cita['correo_paciente']) . "&lt;br /&gt;";
            }
        } else {
            echo "  No hay correo electrónico para el paciente de la cita ID: " . $datos_cita['id_cita'] . ". No se envió email.&lt;br /&gt;";
        }

        // 2. Enviar WhatsApp (Conceptual - como en tu log)
        $fecha_hora_obj_wa = new DateTime($datos_cita['fecha_hora']);
        $fecha_formateada_wa = $fecha_hora_obj_wa->format('d/m/Y \a \l\a\s H:i');
        $nombre_completo_fisio_wa = trim($datos_cita['nombre_fisioterapeuta'] . ' ' . $datos_cita['apellido_fisioterapeuta']);
        $mensaje_whatsapp = "Hola " . $datos_cita['nombre_paciente'] . ", te recordamos tu cita en " . ($datos_cita['nombre_clinica'] ?: "Clínica MAO") . " para el " . $fecha_formateada_wa . " con " . $nombre_completo_fisio_wa . ". Motivo: " . $datos_cita['motivo_cita'] . ". ¡Te esperamos!";
        echo "  (Conceptual) Enviando WhatsApp a: " . htmlspecialchars($datos_cita['telefono_paciente']) . " con mensaje: " . htmlspecialchars($mensaje_whatsapp) . "&lt;br /&gt;";
        // $whatsapp_enviado = tuFuncionRealDeEnviarWhatsApp(...); 
        // $whatsapp_enviado = true; // Simular éxito

        // 3. Enviar SMS (Conceptual - como en tu log)
        $fecha_hora_obj_sms = new DateTime($datos_cita['fecha_hora']);
        $fecha_formateada_sms = $fecha_hora_obj_sms->format('d/m/Y \a \l\a\s H:i');
        $nombre_completo_fisio_sms = trim($datos_cita['nombre_fisioterapeuta'] . ' ' . $datos_cita['apellido_fisioterapeuta']);
        $mensaje_sms = "Recordatorio " . ($datos_cita['nombre_clinica'] ?: "Clinica MAO") . ": Cita " . $fecha_formateada_sms . " con " . $nombre_completo_fisio_sms . ". Motivo: " . $datos_cita['motivo_cita'] . ".";
        echo "  (Conceptual) Enviando SMS a: " . htmlspecialchars($datos_cita['telefono_paciente']) . " con mensaje: " . htmlspecialchars($mensaje_sms) . "&lt;br /&gt;";
        // $sms_enviado = tuFuncionRealDeEnviarSMS(...);
        // $sms_enviado = true; // Simular éxito

        // 4. Marcar como recordatorio enviado SI EL EMAIL FUE EXITOSO
        //    (O ajusta la condición si otras notificaciones son suficientes)
        if ($email_enviado_exitosamente) { 
            try {
                $conn_update = Conexion::conectar();
                $stmt_update = $conn_update->prepare("UPDATE citas SET recordatorio_enviado = 1 WHERE id_cita = :id_cita");
                $stmt_update->bindParam(":id_cita", $datos_cita['id_cita'], PDO::PARAM_INT);
                if ($stmt_update->execute()) {
                    echo "  Cita ID: " . $datos_cita['id_cita'] . " marcada como recordatorio enviado.&lt;br /&gt;";
                } else {
                    echo "  Error al marcar como enviado la cita ID: " . $datos_cita['id_cita'] . " en la BD.&lt;br /&gt;";
                }
            } catch (PDOException $e) {
                echo "  Excepción al actualizar BD para cita ID: " . $datos_cita['id_cita'] . " - " . $e->getMessage() . "&lt;br /&gt;";
            } finally {
                $stmt_update = null;
                $conn_update = null;
            }
        } else {
            echo "  Cita ID: " . $datos_cita['id_cita'] . " NO marcada como enviada debido a fallo en el envío del email.&lt;br /&gt;";
        }
        echo "--------------------------------------------------&lt;br /&gt;";
    }
    
    if ($citas_validas_encontradas > 0) {
        echo $citas_validas_encontradas . " citas válidas encontradas para procesar.&lt;br /&gt;";
    } else {
        echo "No se encontraron citas válidas para procesar de las seleccionadas o ya habían sido procesadas.&lt;br /&gt;";
    }
    echo "Proceso de envío de recordatorios seleccionados finalizado.&lt;br /&gt;";

} else {
    echo "No se seleccionaron citas para enviar recordatorios o los datos son inválidos.&lt;br /&gt;";
}
?>
