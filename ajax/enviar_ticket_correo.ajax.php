<?php
// Incluir PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Ajusta estas rutas según dónde hayas colocado PHPMailer
//D:\xampp\htdocs\mao\email/vendor/phpmailer/src/PHPMailer.php

require '../email/vendor/phpmailer/phpmailer/src/Exception.php';
require '../email/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../email/vendor/phpmailer/phpmailer/src/SMTP.php';

// Incluir FPDF y la conexión a la BD
require_once('../modelos/conexion.php');
// La ruta a FPDF debe ser la correcta. Si en generar_ticket_pago.php usas '../libs/fpdf/fpdf.php', usa esa aquí también.
require_once('../reportes/fpdf/fpdf.php'); // Ajustado para coincidir con la estructura común de FPDF

// --- INICIO: Lógica de generación de PDF (adaptada de generar_ticket_pago.php) ---
// Esta función es una adaptación. Idealmente, refactorizarías esto a una clase.
function generarContenidoPdfTicket($id_pago) {
    $conexion = Conexion::conectar();
    $stmtPago = $conexion->prepare(
        "SELECT p.*, c.fecha_hora AS fecha_cita, c.id_empresa,
                pac.nombre AS nombre_paciente, pac.correo AS correo_paciente,
                CONCAT(f.nombre, ' ', f.apellido) AS nombre_fisioterapeuta,
                emp.nombre AS nombre_clinica, emp.direccion AS direccion_clinica, emp.telefono AS telefono_clinica
         FROM tblmao_pagos p
         JOIN citas c ON p.id_cita = c.id_cita
         JOIN tblpacientes pac ON p.id_paciente = pac.id AND c.id_empresa = pac.id_empresa
         LEFT JOIN tblmaoespecialistas f ON c.id_fisioterapeuta = f.id_fisioterapeuta
         LEFT JOIN tblempresa emp ON c.id_empresa = emp.id
         WHERE p.id_pago = :id_pago"
    );
    $stmtPago->bindParam(":id_pago", $id_pago, PDO::PARAM_INT);
    $stmtPago->execute();
    $pago = $stmtPago->fetch(PDO::FETCH_ASSOC);

    if (!$pago) {
        return null; // O lanzar una excepción
    }

    $stmtServicios = $conexion->prepare(
        "SELECT s.id_sesion, serv.nombre_servicio, serv.precio AS precio_servicio
         FROM tblsesiones s
         JOIN tblmao_servicio serv ON s.id_servicio = serv.id_servicio
         WHERE s.id_cita = :id_cita"
    );
    $stmtServicios->bindParam(":id_cita", $pago['id_cita'], PDO::PARAM_INT);
    $stmtServicios->execute();
    $servicios = $stmtServicios->fetchAll(PDO::FETCH_ASSOC);

    // Usar una variable global temporal para pasar $pago al Header de FPDF
    // Esto no es ideal, pero es una forma de adaptar el código existente rápidamente.
    $GLOBALS['pago_temporal_para_pdf'] = $pago;

    class PDF_Email extends FPDF {
        function Header() {
            $pagoInfo = isset($GLOBALS['pago_temporal_para_pdf']) ? $GLOBALS['pago_temporal_para_pdf'] : null;

            if (!$pagoInfo) return;

            // Fondo para la información de la clínica
            $this->SetFillColor(230, 230, 230); // Gris claro
            $this->Rect(10, 10, $this->GetPageWidth() - 20, 25, 'F'); // Rectángulo de fondo

            // Logo - Asegúrate que la ruta sea correcta desde este script AJAX
            if (file_exists('../vistas/assets/dist/img/logomaofisioterapia.png')) {
                $this->Image('../vistas/assets/dist/img/logomaofisioterapia.png', 15, 12, 20);
            }
            
            $this->SetY(12);
            $this->SetFont('Arial', 'B', 16);
            $this->SetTextColor(50, 50, 50);
            $this->Cell(0, 8, utf8_decode($pagoInfo['nombre_clinica'] ?: 'CLÍNICA'), 0, 1, 'C');
            $this->SetFont('Arial', '', 10);
            $this->SetTextColor(80, 80, 80);
            $this->Cell(0, 6, utf8_decode($pagoInfo['direccion_clinica'] ?: 'Dirección no disponible'), 0, 1, 'C');
            $this->Cell(0, 6, utf8_decode('Tel: ' . ($pagoInfo['telefono_clinica'] ?: 'N/A')), 0, 1, 'C');
            $this->Ln(8);
            $this->SetFont('Arial', 'B', 14);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(0, 10, 'RECIBO DE PAGO', 0, 1, 'C');
            $this->Ln(5);
        }
        function Footer() {
            $this->SetY(-15);
            $this->SetDrawColor(150,150,150);
            $this->Line(10, $this->GetY() - 2, $this->GetPageWidth() - 10, $this->GetY() - 2);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }

    $pdf = new PDF_Email('P', 'mm', 'Letter');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);
    $leftMarginInfo = 15; // Si lo usas en alguna parte

    // Información del Pago
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, 'Recibo No.:', 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 7, $pago['id_pago'], 0, 1);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, 'Fecha de Pago:', 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 7, date("d/m/Y H:i:s", strtotime($pago['fecha_pago'])), 0, 1);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, 'Paciente:', 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 7, utf8_decode($pago['nombre_paciente']), 0, 1);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, 'Fisioterapeuta:', 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 7, utf8_decode($pago['nombre_fisioterapeuta'] ?: 'No asignado'), 0, 1);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, 'Fecha Cita:', 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 7, date("d/m/Y H:i", strtotime($pago['fecha_cita'])), 0, 1);

    $pdf->Ln(5);
    $pdf->SetDrawColor(200,200,200);
    $pdf->Line(10, $pdf->GetY(), $pdf->GetPageWidth() - 10, $pdf->GetY());
    $pdf->Ln(3);

    if (!empty($servicios)) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 7, 'Detalle de Servicios:', 0, 1);
        // Usar el color de fondo definido para encabezados de tabla
        $tableHeaderBgColor = [220, 220, 220];
        $pdf->SetFillColor($tableHeaderBgColor[0], $tableHeaderBgColor[1], $tableHeaderBgColor[2]);
        $pdf->Cell(120, 7, 'Servicio', 1, 0, 'C', true);
        $pdf->Cell(60, 7, 'Precio', 1, 1, 'C', true);
        $pdf->SetFont('Arial', '', 10);
        $totalServicios = 0;
        foreach ($servicios as $servicio) {
            $pdf->Cell(120, 7, utf8_decode($servicio['nombre_servicio']), 1, 0);
            $pdf->Cell(60, 7, '$ ' . number_format($servicio['precio_servicio'], 2), 1, 1, 'R');
            $totalServicios += $servicio['precio_servicio'];
        }
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(120, 7, 'Total Servicios Cita', 1, 0, 'R');
        $pdf->Cell(60, 7, '$ ' . number_format($totalServicios, 2), 1, 1, 'R');
        $pdf->Ln(5);
    }

    // Montos del Pago
    $pdf->SetDrawColor(200,200,200);
    $pdf->Line(10, $pdf->GetY(), $pdf->GetPageWidth() - 10, $pdf->GetY());
    $pdf->Ln(3);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(120, 7, 'Monto Pagado:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(60, 7, '$ ' . number_format($pago['monto_transaccion'], 2), 0, 1, 'R');

    if (floatval($pago['descuento_aplicado']) > 0) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(120, 7, 'Descuento Aplicado:', 0, 0, 'R');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 7, '$ ' . number_format($pago['descuento_aplicado'], 2), 0, 1, 'R');
    }
    
    $montoNetoPagado = floatval($pago['monto_transaccion']);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(120, 8, 'TOTAL PAGADO EN ESTA TRANSACCION:', 0, 0, 'R');
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(60, 8, '$ ' . number_format($montoNetoPagado, 2), 0, 1, 'R');

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 7, utf8_decode('Método de Pago:'), 0, 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 7, utf8_decode($pago['metodo_pago']), 0, 1);

    if (!empty($pago['referencia_pago'])) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 7, 'Referencia:', 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 7, utf8_decode($pago['referencia_pago']), 0, 1);
    }

    if (!empty($pago['notas_pago'])) {
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 7, 'Notas Adicionales:', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(0, 5, utf8_decode($pago['notas_pago']));
    }

    $pdf->Ln(15);
    $pdf->SetFont('Arial', 'I', 9);
    $pdf->Cell(0, 10, utf8_decode('Gracias por su preferencia.'), 0, 0, 'C');

    unset($GLOBALS['pago_temporal_para_pdf']); // Limpiar la variable global
    return $pdf->Output('S'); // 'S' devuelve el PDF como string
}


header('Content-Type: application/json');

if (isset($_POST['id_pago']) && isset($_POST['correo_paciente'])) {
    $id_pago = $_POST['id_pago'];
    $correo_paciente = $_POST['correo_paciente'];

    if (!filter_var($correo_paciente, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "La dirección de correo no es válida."]);
        exit;
    }

    $pdf_content = generarContenidoPdfTicket($id_pago);

    if (!$pdf_content) {
        echo json_encode(["status" => "error", "message" => "No se pudo generar el ticket PDF."]);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP (ajusta según tu proveedor de correo)
        $mail->CharSet = 'UTF-8'; // Asegurar UTF-8 para el correo
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Habilita salida de depuración detallada (para desarrollo)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Ej: smtp.gmail.com, smtp.office365.com
        $mail->SMTPAuth   = true;
        $mail->Username   = 'clinicaced2022@gmail.com'; // Tu dirección de correo SMTP
        $mail->Password   = 'amid ybzy frfu axei';    // Tu contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O PHPMailer::ENCRYPTION_SMTPS
        $mail->Port       = 587; // Puerto TLS (o 465 para SMTPS)

        // Remitente y Destinatarios
        $mail->setFrom('no-reply@tuclinica.com', 'Tu Clínica Fisioterapia'); // Correo y nombre del remitente
        $mail->addAddress($correo_paciente); // Correo del paciente
        // $mail->addReplyTo('info@tuclinica.com', 'Información'); // Opcional

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Recibo de Pago - Tu Clínica Fisioterapia';
        $mail->Body    = 'Estimado(a) paciente,<br><br>Adjunto encontrará el recibo de su pago reciente.<br><br>Gracias por su preferencia.<br><br>Atentamente,<br>Tu Clínica Fisioterapia';
        $mail->AltBody = 'Estimado(a) paciente, Adjunto encontrará el recibo de su pago reciente. Gracias por su preferencia. Atentamente, Tu Clínica Fisioterapia';

        // Adjuntar el PDF
        $nombre_archivo_pdf = 'Recibo_Pago_' . $id_pago . '.pdf';
        $mail->addStringAttachment($pdf_content, $nombre_archivo_pdf, 'base64', 'application/pdf');

        $mail->send();
        echo json_encode(["status" => "ok", "message" => "El ticket ha sido enviado por correo a " . $correo_paciente]);

    } catch (Exception $e) {
        // Loggear el error $mail->ErrorInfo en un archivo de log en producción
        error_log("PHPMailer Error: " . $mail->ErrorInfo);
        echo json_encode(["status" => "error", "message" => "No se pudo enviar el correo. Error: " . $mail->ErrorInfo]);
    }

} else {
    echo json_encode(["status" => "error", "message" => "Faltan datos para enviar el correo."]);
}
?>
