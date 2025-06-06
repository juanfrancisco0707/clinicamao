<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Recordatorios de Citas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 900px; margin: auto; padding: 20px; background-color: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1, h2 { text-align: center; color: #333; }
        h2 { font-size: 1.2em; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #e9e9e9; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .no-citas, .mensaje-ajax { text-align: center; color: #777; margin-top: 20px; padding: 15px; background-color: #fff3cd; border: 1px solid #ffeeba; border-radius: 4px; }
        .mensaje-ajax.success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
        .mensaje-ajax.error { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
        .submit-button { display: block; width: 250px; margin: 30px auto; padding: 12px 15px; background-color: #5cb85c; color: white; border: none; border-radius: 4px; cursor: pointer; text-align: center; font-size: 1em; }
        .submit-button:hover { background-color: #4cae4c; }
        .submit-button:disabled { background-color: #ccc; cursor: not-allowed; }
        input[type="checkbox"] { transform: scale(1.2); margin-right: 5px; }
        #loader { text-align: center; margin-top: 20px; font-style: italic; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Enviar Recordatorios de Citas</h1>
        <h2 id="subtituloCitas">Cargando citas para mañana...</h2>

        <div id="mensajeAjax" class="mensaje-ajax" style="display:none;"></div>

        <form id="formRecordatorios">
            <table id="tablaCitas">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="seleccionarTodo" title="Seleccionar/Deseleccionar Todo"></th>
                        <th>Paciente</th>
                        <th>Fecha y Hora</th>
                        <th>Fisioterapeuta</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
                <tbody id="cuerpoTablaCitas">
                    <!-- Las filas de citas se cargarán aquí por AJAX -->
                </tbody>
            </table>
            <div id="loader" style="display:none;">Cargando...</div>
            <button type="submit" id="btnEnviarRecordatorios" class="submit-button" disabled>Enviar Recordatorios Seleccionados</button>
        </form>
    </div>

    <script>
    // Se elimina el wrapper document.addEventListener('DOMContentLoaded', function() { ... });
    // El código se ejecutará directamente cuando el script sea parseado después de cargar el HTML del modal.
        const cuerpoTabla = document.getElementById('cuerpoTablaCitas');
        const subtituloCitas = document.getElementById('subtituloCitas');
        const seleccionarTodoCheckbox = document.getElementById('seleccionarTodo');
        const btnEnviar = document.getElementById('btnEnviarRecordatorios');
        const formRecordatorios = document.getElementById('formRecordatorios');
        const mensajeAjaxDiv = document.getElementById('mensajeAjax');
        const loaderDiv = document.getElementById('loader');

        const rutaControlador = '../controladores/recordatorios_controlador.php'; // Ajusta si es necesario

        function mostrarMensaje(texto, tipo = 'info') {
            mensajeAjaxDiv.textContent = texto;
            mensajeAjaxDiv.className = 'mensaje-ajax ' + tipo; // success, error, info
            mensajeAjaxDiv.style.display = 'block';
        }

        function cargarCitas() {
            
            loaderDiv.style.display = 'block';
            cuerpoTabla.innerHTML = ''; // Limpiar tabla
            btnEnviar.disabled = true;
            mensajeAjaxDiv.style.display = 'none';

            fetch(`${rutaControlador}?accion=obtenerCitas`)
                .then(response => response.json())
                .then(data => {
                    loaderDiv.style.display = 'none';
                    subtituloCitas.textContent = `Citas para el ${data.fecha_referencia || 'próximo día hábil'} pendientes de recordatorio`;

                   if (data.citas && data.citas.length > 0) {
                        data.citas.forEach(cita => {
                            const fila = `<tr>
                                <td><input type="checkbox" name="citas_seleccionadas[]" value="${cita.id_cita}" class="cita-checkbox" checked></td>
                                <td>${escapeHtml(cita.nombre_paciente)}</td>
                                <td>${new Date(cita.fecha_hora).toLocaleString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' })}</td>
                                <td>${escapeHtml(cita.nombre_fisioterapeuta + ' ' + cita.apellido_fisioterapeuta)}</td>
                                <td>${escapeHtml(cita.motivo)}</td>
                            </tr>`;
                            cuerpoTabla.insertAdjacentHTML('beforeend', fila);
                        });
                        btnEnviar.disabled = false;
                        seleccionarTodoCheckbox.checked = true;
                    } else {
                        cuerpoTabla.innerHTML = `<tr><td colspan="5" class="no-citas">No hay citas para el ${data.fecha_referencia || 'próximo día hábil'} pendientes de recordatorio.</td></tr>`;

                        //cuerpoTabla.innerHTML = '<tr><td colspan="5" class="no-citas">No hay citas para mañana pendientes de recordatorio.</td></tr>';
                    }
                })
                .catch(error => {
                    loaderDiv.style.display = 'none';
                    console.error('Error al cargar citas:', error);
                    mostrarMensaje('Error al cargar las citas. Intente de nuevo más tarde.', 'error');
                    subtituloCitas.textContent = 'Error al cargar citas';
                });
        }

        seleccionarTodoCheckbox.addEventListener('change', function(e) {
            document.querySelectorAll('.cita-checkbox').forEach(cb => cb.checked = e.target.checked);
        });

        formRecordatorios.addEventListener('submit', function(e) {
            e.preventDefault();
            btnEnviar.disabled = true;
            loaderDiv.style.display = 'block';
            mostrarMensaje('Enviando recordatorios...', 'info');

            const formData = new FormData(this);
            fetch(`${rutaControlador}?accion=enviarSeleccionados`, { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    loaderDiv.style.display = 'none';
                    if (data.success) {
                        mostrarMensaje('Recordatorios procesados. Detalles: <br>' + (data.details || ''), 'success');
                        cargarCitas(); // Recargar la lista, las citas enviadas ya no deberían aparecer
                    } else {
                        mostrarMensaje('Error: ' + data.message, 'error');
                        btnEnviar.disabled = false;
                    }
                })
                .catch(error => {
                    loaderDiv.style.display = 'none';
                    btnEnviar.disabled = false;
                    console.error('Error al enviar recordatorios:', error);
                    mostrarMensaje('Error de comunicación al enviar recordatorios.', 'error');
                });
        });

        function escapeHtml(unsafe) {
            return unsafe
                 .replace(/&/g, "&amp;")
                 .replace(/</g, "&lt;")
                 .replace(/>/g, "&gt;")
                 .replace(/"/g, "&quot;")
                 .replace(/'/g, "&#039;");
        }

        // Cargar citas al iniciar
        cargarCitas();
    //}); // Fin del document.addEventListener anterior
    </script>
</body>
</html>