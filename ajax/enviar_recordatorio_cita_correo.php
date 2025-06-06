<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Ajusta estas rutas según dónde hayas colocado PHPMailer
require '../email/vendor/phpmailer/phpmailer/src/Exception.php';
require '../email/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../email/vendor/phpmailer/phpmailer/src/SMTP.php';

// Opcional: Incluir conexión si necesitas obtener más datos de la clínica desde aquí
// require_once('../modelos/conexion.php');

/**
 * Envía un correo de recordatorio de cita.
 * @param int    $id_cita El ID de la cita para generar el enlace de confirmación
 * @param string $correo_paciente La dirección de correo del paciente.
 * @param string $nombre_paciente El nombre del paciente.
 * @param string $fecha_hora_cita_formateada La fecha y hora de la cita (ya formateada como string, ej: "06/06/2025 a las 08:00").
 * @param string $nombre_fisioterapeuta El nombre del fisioterapeuta.
 * @param string $motivo_cita El motivo de la cita.
 * @param string $nombre_clinica El nombre de la clínica (opcional, por defecto "Clínica MAO").
 * @return bool True si el correo se envió con éxito, false en caso contrario.
 */
//function enviarCorreoRecordatorioCita($correo_paciente, $nombre_paciente, $fecha_hora_cita_formateada, $nombre_fisioterapeuta, $motivo_cita, $nombre_clinica = "Clínica MAO") {
function enviarCorreoRecordatorioCita($id_cita, $correo_paciente, $nombre_paciente, $fecha_hora_cita_formateada, $nombre_fisioterapeuta, $motivo_cita, $nombre_clinica = "Clínica MAO") { 
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP (ajusta según tu proveedor de correo)
        $mail->CharSet = 'UTF-8';
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Habilita salida de depuración detallada (para desarrollo)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';        // Ej: smtp.gmail.com, smtp.office365.com
        $mail->SMTPAuth   = true;
        $mail->Username   = 'clinicaced2022@gmail.com'; // Tu dirección de correo SMTP
        $mail->Password   = 'amid ybzy frfu axei';       // Tu contraseña SMTP (considera usar variables de entorno)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O PHPMailer::ENCRYPTION_SMTPS
        $mail->Port       = 587;                     // Puerto TLS (o 465 para SMTPS)

        // Remitente y Destinatarios
        // Es buena práctica usar un correo no-reply o uno específico para notificaciones
        $mail->setFrom('no-reply@clinicamao.com', $nombre_clinica); 
        $mail->addAddress($correo_paciente, $nombre_paciente); // Añadir destinatario

        // Contenido del correo
        $mail->isHTML(true); // Establecer formato de correo a HTML
        $mail->Subject = 'Recordatorio de Cita en ' . htmlspecialchars($nombre_clinica);
        
        // Construir el enlace de confirmación
        // Asegúrate de que la URL base sea correcta para tu entorno.
        // Podrías obtenerla dinámicamente o configurarla.
        $url_base = "http://" . $_SERVER['HTTP_HOST'] . "/mao"; // Ajusta si tu proyecto no está en la raíz de 'mao'
        $enlace_confirmacion = $url_base . "/confirmar_cita.php?id_cita=" . $id_cita;
        // Podrías añadir un token para más seguridad, pero por ahora lo mantenemos simple.

        // Cuerpo del mensaje (HTML)
        $cuerpoMensaje = "<p>Hola " . htmlspecialchars($nombre_paciente) . ",</p>";
        $cuerpoMensaje .= "<p>Te recordamos tu cita en <strong>" . htmlspecialchars($nombre_clinica) . "</strong> para el <strong>" . htmlspecialchars($fecha_hora_cita_formateada) . "</strong>.</p>";
        $cuerpoMensaje .= "<p>Serás atendido(a) por: <strong>" . htmlspecialchars($nombre_fisioterapeuta) . "</strong>.</p>";
        $cuerpoMensaje .= "<p>Motivo de la cita: " . htmlspecialchars($motivo_cita) . ".</p>";
        $cuerpoMensaje .= "<p>Por favor, confirma tu asistencia haciendo clic en el siguiente enlace:</p>";
        $cuerpoMensaje .= "<p><a href=\"" . $enlace_confirmacion . "\" style=\"background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; border-radius: 5px;\">Confirmar mi Cita</a></p>";
        $cuerpoMensaje .= "<p>Si no puedes asistir, por favor contáctanos lo antes posible para reprogramar o cancelar tu cita.</p>";
        $cuerpoMensaje .= "<p>Por favor, llega con unos minutos de anticipación. Si necesitas reprogramar o cancelar tu cita, contáctanos lo antes posible.</p>";
        $cuerpoMensaje .= "<p>¡Te esperamos!</p>";
        $cuerpoMensaje .= "<br>";
        $cuerpoMensaje .= "<p>Saludos cordiales,<br>El equipo de " . htmlspecialchars($nombre_clinica) . "</p>";
        // Puedes añadir aquí la dirección, teléfono de la clínica, etc.
        
        $mail->Body    = $cuerpoMensaje;
        
        // Cuerpo del mensaje (Texto plano para clientes de correo que no soportan HTML)
        $cuerpoMensajeAlt = "Hola " . $nombre_paciente . ",\n\n";
        $cuerpoMensajeAlt .= "Te recordamos tu cita en " . $nombre_clinica . " para el " . $fecha_hora_cita_formateada . ".\n";
        $cuerpoMensajeAlt .= "Serás atendido(a) por: " . $nombre_fisioterapeuta . ".\n";
        $cuerpoMensajeAlt .= "Motivo de la cita: " . $motivo_cita . ".\n\n";
        $cuerpoMensajeAlt .= "Por favor, confirma tu asistencia visitando el siguiente enlace:\n";
        $cuerpoMensajeAlt .= $enlace_confirmacion . "\n\n";
        $cuerpoMensajeAlt .= "Por favor, llega con unos minutos de anticipación. Si necesitas reprogramar o cancelar tu cita, contáctanos lo antes posible.\n\n";
        $cuerpoMensajeAlt .= "¡Te esperamos!\n\n";
        $cuerpoMensajeAlt .= "Saludos cordiales,\nEl equipo de " . $nombre_clinica;

        $mail->AltBody = $cuerpoMensajeAlt;

        $mail->send();
        return true;
    } catch (Exception $e) {
        // En un entorno de producción, loggear este error en lugar de (o además de) hacer echo.
        // error_log("PHPMailer Error al enviar recordatorio a {$correo_paciente}: " . $mail->ErrorInfo);
        return false;
    }
}


?>
