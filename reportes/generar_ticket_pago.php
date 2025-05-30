<?php
require_once('../modelos/conexion.php'); // Ajusta la ruta a tu conexión
require_once('../reportes/fpdf/fpdf.php'); // Ajusta la ruta a FPDF

if (isset($_GET['id_pago'])) {
    $id_pago = $_GET['id_pago'];
// echo "ID de Pago Recibido: " . htmlspecialchars($id_pago); // Para depurar
// exit; // Detén la ejecución para ver el ID
    // Conectar a la BD
    $conexion = Conexion::conectar();

    // 1. Obtener datos del pago
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
        die("Pago no encontrado.");
    }

    // 2. Obtener servicios/sesiones de la cita (si aplica)
    $stmtServicios = $conexion->prepare(
        "SELECT s.id_sesion, serv.nombre_servicio, serv.precio AS precio_servicio
         FROM tblsesiones s
         JOIN tblmao_servicio serv ON s.id_servicio = serv.id_servicio
         WHERE s.id_cita = :id_cita"
    );
    $stmtServicios->bindParam(":id_cita", $pago['id_cita'], PDO::PARAM_INT);
    $stmtServicios->execute();
    $servicios = $stmtServicios->fetchAll(PDO::FETCH_ASSOC);

    // Crear PDF
    class PDF extends FPDF
    {
        // Cabecera de página
        function Header()
        {
            global $pago; 

            // Fondo para la información de la clínica
            $this->SetFillColor(230, 230, 230); // Gris claro
            $this->Rect(10, 10, $this->GetPageWidth() - 20, 25, 'F'); // Rectángulo de fondo

            // Logo (opcional)
             $this->Image('../vistas/assets/dist/img/logomaofisioterapia.png', 15, 12, 20); // Ajusta ruta y tamaño
            
            $this->SetY(12); // Posicionar después del logo si se usa
            $this->SetFont('Arial', 'B', 16);
            $this->SetTextColor(50, 50, 50); // Color de texto oscuro
            $this->Cell(0, 8, utf8_decode($pago['nombre_clinica'] ?: 'CLÍNICA DE FISIOTERAPIA'), 0, 1, 'C');
            $this->SetFont('Arial', '', 10);
            $this->SetTextColor(80, 80, 80);
            $this->Cell(0, 6, utf8_decode($pago['direccion_clinica'] ?: 'Dirección no disponible'), 0, 1, 'C');
            $this->Cell(0, 6, utf8_decode('Tel: ' . ($pago['telefono_clinica'] ?: 'N/A')), 0, 1, 'C');
            $this->Ln(8); // Más espacio después de la info de la clínica
            $this->SetFont('Arial', 'B', 14);
            $this->SetTextColor(0, 0, 0); // Resetear color de texto a negro
            $this->Cell(0, 10, 'RECIBO DE PAGO', 0, 1, 'C');
            $this->Ln(5);
        }

        // Pie de página
        function Footer()
        {
            $this->SetY(-15);
            $this->SetDrawColor(150,150,150); // Color de línea para el pie
            $this->Line(10, $this->GetY() - 2, $this->GetPageWidth() - 10, $this->GetY() - 2); // Línea arriba del pie
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }

    $pdf = new PDF('P', 'mm', 'Letter'); // P: Portrait, mm: milímetros, Letter: tamaño carta
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);
    $leftMarginInfo = 15;

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
    $pdf->SetDrawColor(200,200,200); // Color de línea suave
    $pdf->Line(10, $pdf->GetY(), $pdf->GetPageWidth() - 10, $pdf->GetY()); // Línea divisoria
    $pdf->Ln(3);

    $tableHeaderBgColor = [220, 220, 220]; // Gris muy claro para encabezados de tabla
    $tableCellBorder = 1; // 1 para bordes, 0 para sin bordes

    // Detalle de Servicios (si los hay)
    if (!empty($servicios)) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 7, 'Detalle de Servicios:', 0, 1);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(120, 7, 'Servicio', 1, 0, 'C', true);
        $pdf->Cell(60, 7, 'Precio', 1, 1, 'C', true); // Ajustado ancho
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
    $pdf->Line(10, $pdf->GetY(), $pdf->GetPageWidth() - 10, $pdf->GetY()); // Línea divisoria
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
    
    $montoNetoPagado = floatval($pago['monto_transaccion']); // El monto_transaccion ya es el neto
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

    $pdf->Output('I', 'Recibo_Pago_' . $id_pago . '.pdf'); // I: Muestra en navegador, D: Descarga

} else {
    echo "ID de pago no proporcionado.";
}
?>
