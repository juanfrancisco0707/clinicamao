<?php
// d:\xampp\htdocs\mao\controladores\recordatorios_controlador.php

require_once __DIR__ . '/../modelos/recordatorios_modelo.php';

class ControladorRecordatorios {

    /**
     * Obtiene las citas para mañana y las devuelve como JSON.
     */
    public function ajaxObtenerCitasManana() {
        header('Content-Type: application/json');
        date_default_timezone_set('America/Mazatlan'); // Ajustado a Mazatlán
         $hoy_dia_semana = date('N'); // 1 (para lunes) hasta 7 (para domingo)
        $fecha_referencia_titulo = '';

        if ($hoy_dia_semana == 5) { // Si es viernes
            // Buscar para el próximo lunes
            $fecha_objetivo_inicio = date('Y-m-d 00:00:00', strtotime('next monday'));
            $fecha_objetivo_fin = date('Y-m-d 23:59:59', strtotime('next monday'));
            $fecha_referencia_titulo = date('d/m/Y', strtotime('next monday'));
        } else {
            // Buscar para mañana
            $fecha_objetivo_inicio = date('Y-m-d 00:00:00', strtotime('+1 day'));
            $fecha_objetivo_fin = date('Y-m-d 23:59:59', strtotime('+1 day'));
            $fecha_referencia_titulo = date('d/m/Y', strtotime('+1 day'));
        }

        $citas = ModeloRecordatorios::mdlObtenerCitasParaRecordatorio($fecha_objetivo_inicio, $fecha_objetivo_fin);
        echo json_encode(['citas' => $citas, 'fecha_referencia' => $fecha_referencia_titulo]);
        exit;
    }

    /**
     * Procesa el envío de recordatorios para las citas seleccionadas.
     * Llama al script cron/enviar_recordatorios.php
     */
    public function ajaxEnviarRecordatoriosSeleccionados() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['citas_seleccionadas']) || !is_array($_POST['citas_seleccionadas']) || empty($_POST['citas_seleccionadas'])) {
            echo json_encode(['success' => false, 'message' => 'No se seleccionaron citas o datos inválidos.']);
            exit;
        }

        // Simular el POST al script enviar_recordatorios.php
        // Esto es una forma de reutilizar tu script existente.
        // Una alternativa sería integrar la lógica de enviar_recordatorios.php aquí o en el modelo.
        $url_script_envio = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF'], 2) . '/cron/enviar_recordatorios.php';
        
        $postData = http_build_query(['citas_seleccionadas' => $_POST['citas_seleccionadas']]);

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => $postData,
            ],
        ];
        $context  = stream_context_create($options);
        $result = @file_get_contents($url_script_envio, false, $context); // Usamos @ para suprimir warnings si el script tiene echos

        if ($result === FALSE) {
            echo json_encode(['success' => false, 'message' => 'Error al contactar el script de envío de recordatorios.']);
        } else {
            // El script enviar_recordatorios.php hace echo de su progreso.
            // Podrías modificarlo para que devuelva JSON, pero por ahora capturamos su salida.
            echo json_encode(['success' => true, 'message' => 'Proceso de envío iniciado.', 'details' => nl2br(htmlspecialchars($result))]);
        }
        exit;
    }
    /**
     * Verifica si hay citas pendientes de recordatorio para el día siguiente
     * (o lunes si hoy es viernes) y devuelve un JSON.
     */
    public function ajaxVerificarCitasPendientesParaBoton() {
        header('Content-Type: application/json');
        date_default_timezone_set('America/Mazatlan'); // Ajustado a Mazatlán

        $hoy_dia_semana = date('N'); // 1 (para lunes) hasta 7 (para domingo)

        if ($hoy_dia_semana == 5) { // Si es viernes
            // Buscar para el próximo lunes
            $fecha_objetivo_inicio = date('Y-m-d 00:00:00', strtotime('next monday'));
            $fecha_objetivo_fin = date('Y-m-d 23:59:59', strtotime('next monday'));
        } else {
            // Buscar para mañana
            $fecha_objetivo_inicio = date('Y-m-d 00:00:00', strtotime('+1 day'));
            $fecha_objetivo_fin = date('Y-m-d 23:59:59', strtotime('+1 day'));
        }

        $cantidadCitas = ModeloRecordatorios::mdlContarCitasPendientesRecordatorio($fecha_objetivo_inicio, $fecha_objetivo_fin);

        echo json_encode(['hayCitas' => $cantidadCitas > 0, 'cantidad' => $cantidadCitas]);
        exit;
    }
}

// Enrutador simple para las acciones AJAX
if (isset($_GET['accion'])) {
    $controlador = new ControladorRecordatorios();
    if ($_GET['accion'] == 'obtenerCitas') {
        $controlador->ajaxObtenerCitasManana();
    } elseif ($_GET['accion'] == 'enviarSeleccionados' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $controlador->ajaxEnviarRecordatoriosSeleccionados();
    } elseif ($_GET['accion'] == 'verificarPendientesBoton') {
        $controlador->ajaxVerificarCitasPendientesParaBoton();
    }
}