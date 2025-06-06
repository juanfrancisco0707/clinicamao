<?php
// d:\xampp\htdocs\mao\confirmar_cita.php

require_once __DIR__ . '/modelos/conexion.php'; // Ajusta la ruta a tu archivo de conexión

$mensaje_usuario = "";
$tipo_mensaje = "info"; // Puede ser 'success', 'error', 'info'

if (isset($_GET['id_cita'])) {
    $id_cita = filter_var($_GET['id_cita'], FILTER_VALIDATE_INT);

    if ($id_cita === false || $id_cita <= 0) {
        $mensaje_usuario = "El ID de la cita proporcionado no es válido.";
        $tipo_mensaje = "error";
    } else {
        // (Opcional: Aquí podrías verificar un token si lo implementas)
        // $token_recibido = isset($_GET['token']) ? $_GET['token'] : null;

        $conn = null;
        try {
            $conn = Conexion::conectar();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // 1. Verificar el estado actual de la cita
            $stmt_check = $conn->prepare("SELECT estado FROM citas WHERE id_cita = :id_cita");
            $stmt_check->bindParam(":id_cita", $id_cita, PDO::PARAM_INT);
            $stmt_check->execute();
            $cita_actual = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if (!$cita_actual) {
                $mensaje_usuario = "La cita que intentas confirmar no existe.";
                $tipo_mensaje = "error";
            } elseif ($cita_actual['estado'] === 'Confirmada') {
                $mensaje_usuario = "Esta cita ya ha sido confirmada previamente.";
                $tipo_mensaje = "info";
            } elseif ($cita_actual['estado'] === 'Cancelada') {
                $mensaje_usuario = "Esta cita fue cancelada y no puede ser confirmada.";
                $tipo_mensaje = "warning";
            } else {
                // 2. Actualizar el estado de la cita a 'Confirmada'
                $stmt_update = $conn->prepare("UPDATE citas SET estado = 'Confirmada' WHERE id_cita = :id_cita");
                $stmt_update->bindParam(":id_cita", $id_cita, PDO::PARAM_INT);
                
                if ($stmt_update->execute()) {
                    if ($stmt_update->rowCount() > 0) {
                        $mensaje_usuario = "¡Gracias! Tu cita ha sido confirmada exitosamente.";
                        $tipo_mensaje = "success";
                        // (Opcional: Aquí podrías limpiar el token de confirmación si lo usas)
                    } else {
                        // Esto podría pasar si el ID es válido pero no se actualizó ninguna fila (raro si la cita existe y no estaba confirmada)
                        $mensaje_usuario = "No se pudo actualizar el estado de la cita. Es posible que ya estuviera confirmada o no exista.";
                        $tipo_mensaje = "warning";
                    }
                } else {
                    $mensaje_usuario = "Ocurrió un error al intentar confirmar tu cita. Por favor, contacta a la clínica.";
                    $tipo_mensaje = "error";
                }
            }

        } catch (PDOException $e) {
            // En un entorno de producción, loggear este error en lugar de mostrarlo.
            // error_log("Error en confirmar_cita.php: " . $e->getMessage());
            $mensaje_usuario = "Error de base de datos. Por favor, intenta más tarde o contacta a la clínica.";
            $tipo_mensaje = "error";
        } finally {
            $conn = null;
        }
    }
} else {
    $mensaje_usuario = "No se proporcionó un ID de cita para confirmar.";
    $tipo_mensaje = "error";
}

// Determinar el color de fondo basado en el tipo de mensaje
$color_fondo = "#f0f0f0"; // Default gris claro
if ($tipo_mensaje === "success") {
    $color_fondo = "#d4edda"; // Verde claro
} elseif ($tipo_mensaje === "error") {
    $color_fondo = "#f8d7da"; // Rojo claro
} elseif ($tipo_mensaje === "warning") {
    $color_fondo = "#fff3cd"; // Amarillo claro
} elseif ($tipo_mensaje === "info") {
    $color_fondo = "#cce5ff"; // Azul claro
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Cita</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: <?php echo $color_fondo; ?>; }
        .container { text-align: center; padding: 40px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 15px rgba(0,0,0,0.1); max-width: 500px; margin: 20px;}
        h1 { color: #333; }
        p { color: #555; font-size: 1.1em; }
        .success { border-left: 5px solid #28a745; padding-left: 15px; }
        .error { border-left: 5px solid #dc3545; padding-left: 15px; }
        .info { border-left: 5px solid #17a2b8; padding-left: 15px; }
        .warning { border-left: 5px solid #ffc107; padding-left: 15px; }
        a.button-home {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
        }
        a.button-home:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="<?php echo htmlspecialchars($tipo_mensaje); ?>">
            <h1>Respuesta de Confirmación</h1>
            <p><?php echo htmlspecialchars($mensaje_usuario); ?></p>
        </div>
        <?php if ($tipo_mensaje === 'success' || $tipo_mensaje === 'info' || $tipo_mensaje === 'warning'): ?>
            <!-- Podrías poner un enlace a la página principal de tu clínica o sistema -->
            <!-- <a href="http://tu-dominio.com/mao/" class="button-home">Volver al Inicio</a> -->
        <?php endif; ?>
    </div>
</body>
</html>