<style>
    /* body { font-family: Arial, sans-serif; } */ /* Comentado: Es mejor definir esto globalmente en tu CSS principal si es necesario */
    .calendar-container { padding: 20px; }
    .schedule { width: 100px; text-align: right; padding-right: 10px; }
    .calendar-wrapper { 
        display: flex; 
        min-height: 600px; /* O la altura que consideres adecuada */

    }
    /* Para los números de los días en la vista de mes */
#calendar .fc-daygrid-day-number {
    color: #333333 !important; 
}

/* Para los encabezados de las columnas (ej. Lunes, Martes...) */
#calendar .fc-col-header-cell-cushion {
    color: #333333 !important;
}

/* Para el título de los eventos - Comentado o eliminado para permitir que textColor del evento funcione */
#calendar .fc-event-title {
    /* color: #ffffff !important; */ /* Esta línea puede impedir que textColor funcione correctamente */
}

/* Para el texto de los eventos en la vista de lista */
#calendar .fc-list-event-title a { /* FullCalendar a veces envuelve títulos de lista en <a> */
    color: #333333 !important;
}
#calendar .fc-list-event-time {
    color: #555555 !important;
}

/* Para asegurar que los botones de navegación de FullCalendar (prev, next, today) sean legibles */
#calendar .fc-button {
    background-color: #f0f0f0; /* Un fondo claro para los botones */
    color: #333333;            /* Texto oscuro */
    border: 1px solid #cccccc;
}
#calendar .fc-button-primary:hover {
    background-color: #e0e0e0;
}
#calendar .fc-toolbar-title {
    color: #333333; /* Asegurar que el título del mes/semana/día sea legible */
}

/* Estilos para los botones de cambio de vista (Día, Semana, Mes) cuando están activos */
.container.mt-3 > .d-flex.justify-content-between.align-items-center.mb-3 > div > .btn.btn-primary.active,
.container.mt-3 > .d-flex.justify-content-between.align-items-center.mb-3 > div > .btn.btn-primary:focus, /* Bootstrap usa :focus para algunos estados activos */
.container.mt-3 > .d-flex.justify-content-between.align-items-center.mb-3 > div > .btn.btn-primary:active { /* :active es para el estado mientras se presiona */
    background-color: #0056b3 !important; /* Un azul más oscuro, estándar para .active en Bootstrap primary */
    border-color: #004085 !important;     /* Borde correspondiente */
    color: #ffffff !important;            /* Texto blanco para contraste */
}

/* Estilo para el fondo del calendario */
#calendar {
    background-color: ivory;
   /* color: #f9f9f9; /* Cambia este valor al color que desees, por ejemplo, un gris claro */
}
.modal-header.bg-indigo {
    cursor: move; /* Cambiar cursor para indicar que es arrastrable */
   /* color: #f9f9f9; /* Cambia este valor al color que desees, por ejemplo, un gris claro */
}
</style>

<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Calendario</h4>
            <div class="calendar-view-buttons">
            <button class="btn btn-primary" onclick="changeView('timeGridDay')">Día</button>
            <button class="btn btn-primary" onclick="changeView('timeGridWeek')">Semana</button>
            <button class="btn btn-primary" onclick="changeView('dayGridMonth')">Mes</button>
        </div>
    </div>
    <div class="calendar-wrapper">
        
        <div id="calendar" class="flex-grow-1">
            <!-- El calendario se renderizará aquí -->
             
        </div>
    </div>
</div>
<!-- Modal para Registrar/Editar Sesión -->
<div class="modal fade" id="modalSesion" tabindex="-1" aria-labelledby="modalSesionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success py-1" id="modalSesionHeader"> <!-- Color verde para sesiones -->
                <h5 class="modal-title" id="modalSesionLabel">Registrar Nueva Sesión</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formSesion">
                    <input type="hidden" id="id_sesion_editar"> <!-- Para edición -->
                    <input type="hidden" id="id_cita_sesion"> <!-- ID de la cita a la que pertenece -->
                    <input type="hidden" id="id_cita_sesion_editar"> <!-- ID de la cita para edicion -->

                    <div class="mb-3">
                        <label for="selServicio" class="form-label">Servicio</label>
                        <select class="form-select" id="selServicio" required>
                            <!-- Opciones se cargarán dinámicamente -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fechaHoraSesion" class="form-label">Fecha y Hora de la Sesión</label>
                        <input type="datetime-local" class="form-control" id="fechaHoraSesion" required>
                    </div>
                    <div class="mb-3">
                        <label for="notasSesion" class="form-label">Notas de la Sesión</label>
                        <textarea class="form-control" id="notasSesion" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnGuardarSesion">Guardar Sesión</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Registrar/Editar Cita -->
<div class="modal fade" id="modalCita" tabindex="-1" aria-labelledby="modalCitaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
             <div class="modal-header bg-indigo py-1" id="modalCitaHeader"> <!-- Añadido bg-indigo y un ID -->
                <h5 class="modal-title" id="modalCitaLabel">Registrar Nueva Cita</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCita">
                    <input type="hidden" id="id_cita"> <!-- Para edición futura -->
                    <div class="mb-3">
                        <label for="selPaciente" class="form-label">Paciente</label>
                        <select class="form-select" id="selPaciente" required>
                            <!-- Opciones se cargarán dinámicamente -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="selFisioterapeuta" class="form-label">Fisioterapeuta</label>
                        <select class="form-select" id="selFisioterapeuta" required>
                            <!-- Opciones se cargarán dinámicamente -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fechaHoraCita" class="form-label">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="fechaHoraCita" required>
                    </div>
                    <div class="mb-3">
                        <label for="motivoCita" class="form-label">Motivo</label>
                        <textarea class="form-control" id="motivoCita" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="estadoCita" class="form-label">Estado</label>
                        <select class="form-select" id="estadoCita">
                            <option value="Pendiente" selected>Pendiente</option>
                            <option value="Confirmada">Confirmada</option>
                            <option value="Cancelada">Cancelada</option>
                            <option value="Completada">Completada</option>
                        </select>
                    </div>
                </form>
            </div>
            <!-- Nueva sección para Sesiones dentro del modal de Cita -->
            <div class="modal-body border-top pt-3">
                <h5>Sesiones de esta Cita</h5>
                <button type="button" class="btn btn-sm btn-success mb-2" id="btnAbrirModalNuevaSesion">
                    <i class="fas fa-plus"></i> Agregar Nueva Sesión
                </button>
                <div id="listaSesionesContainer">
                    <!-- Las sesiones se listarán aquí -->
                    <p>No hay sesiones registradas para esta cita.</p>
                </div>
            </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                <button type="button" class="btn btn-primary" id="btnGuardarCita">Guardar Cita</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal para Registrar/Editar Historial Clínico -->
<div class="modal fade" id="modalHistorialClinico" tabindex="-1" role="dialog" aria-labelledby="modalHistorialClinicoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHistorialClinicoLabel">Registrar Evolución Clínica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formHistorialClinico"> 
                    <input type="hidden" id="id_historial_form" name="id_historial_form" value="">

                    <div class="form-group">
                        <label for="id_sesion_historial">Sesión Asociada <span class="text-danger">*</span></label>
                        <select class="form-control" id="id_sesion_historial" name="id_sesion_historial" required>
                            <!-- Opciones se cargarán dinámicamente -->
                        </select>
                        <small class="form-text text-muted">Seleccione la sesión a la que corresponde esta evolución.</small>
                    </div>

                    <div class="form-group">
                        <label for="fecha_evaluacion_historial">Fecha de Evaluación <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="fecha_evaluacion_historial" name="fecha_evaluacion_historial" required>
                    </div>

                    <div class="form-group">
                        <label for="subjetivo_historial">Subjetivo (S.O.A.P.)</label>
                        <textarea class="form-control" id="subjetivo_historial" name="subjetivo_historial" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="objetivo_historial">Objetivo (S.O.A.P.)</label>
                        <textarea class="form-control" id="objetivo_historial" name="objetivo_historial" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="diagnostico_historial">Diagnóstico Fisioterapéutico</label>
                        <select class="form-control" id="diagnostico_historial" name="diagnostico_historial">
                            <option value="">Seleccione un diagnóstico...</option>
                            <!-- Opciones se cargarán dinámicamente -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="plan_tratamiento_historial">Plan de Tratamiento / Intervención en Sesión</label>
                        <textarea class="form-control" id="plan_tratamiento_historial" name="plan_tratamiento_historial" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="evolucion_historial">Evolución / Análisis (S.O.A.P.)</label>
                        <textarea class="form-control" id="evolucion_historial" name="evolucion_historial" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="objetivos_corto_historial">Objetivos a Corto Plazo</label>
                        <textarea class="form-control" id="objetivos_corto_historial" name="objetivos_corto_historial" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="objetivos_largo_historial">Objetivos a Largo Plazo</label>
                        <textarea class="form-control" id="objetivos_largo_historial" name="objetivos_largo_historial" rows="2"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="recomendaciones_historial">Recomendaciones Domiciliarias / Plan (S.O.A.P.)</label>
                        <textarea class="form-control" id="recomendaciones_historial" name="recomendaciones_historial" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="proxima_cita_historial">Próxima Cita Sugerida</label>
                        <input type="date" class="form-control" id="proxima_cita_historial" name="proxima_cita_historial">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnGuardarHistorialClinico">Guardar Evolución</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal para el Menú Contextual del Calendario -->
<div class="modal fade" id="modalMenuContextualCalendario" tabindex="-1" aria-labelledby="modalMenuContextualLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm"> <!-- modal-sm para un menú más pequeño -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMenuContextualLabel">Acciones</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <!-- Las opciones se añadirán/mostrarán dinámicamente aquí -->
                    <button type="button" class="list-group-item list-group-item-action" id="btnMenuAgregarCita" style="display: none;">
                        <i class="fas fa-plus-circle"></i> Agregar Nueva Cita
                    </button>
                    <button type="button" class="list-group-item list-group-item-action" id="btnMenuEditarCita" style="display: none;">
                        <i class="fas fa-edit"></i> Editar Cita
                    </button>
                    <button type="button" class="list-group-item list-group-item-action" id="btnMenuEditarPaciente" style="display: none;">
                        <i class="fas fa-user-edit"></i> Ver/Editar Paciente
                    </button>
                    <button type="button" class="list-group-item list-group-item-action" id="btnMenuPagos" style="display: none;">
                        <i class="fas fa-dollar-sign"></i> Gestionar Pagos
                    </button>
                    <!-- Puedes añadir más opciones si es necesario -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal para Gestionar Pagos -->
<div class="modal fade" id="modalPagos" tabindex="-1" aria-labelledby="modalPagosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-purple py-1" id="modalPagosHeader"> <!-- Puedes definir .bg-purple en tu CSS -->
                <h5 class="modal-title" id="modalPagosLabel">Gestionar Pagos de Cita</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPago">
                    <input type="hidden" id="pago_id_cita_actual">
                    <input type="hidden" id="pago_id_paciente_actual">
                    <input type="hidden" id="pago_id_fisioterapeuta_actual"> <!-- Para mostrar nombre del fisio -->


                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Paciente:</strong> <span id="pago_display_nombre_paciente"></span>
                        </div>
                        <div class="col-md-6">
                            <strong>Fisioterapeuta:</strong> <span id="pago_display_nombre_fisioterapeuta"></span>
                        </div>
                        <div class="col-md-12">
                            <strong>Fecha Cita:</strong> <span id="pago_display_fecha_cita"></span>
                        </div>
                    </div>

                    <h6>Detalle de Servicios de la Cita:</h6>
                    <div id="pago_detalle_servicios_container" class="mb-3" style="max-height: 150px; overflow-y: auto; border: 1px solid #eee; padding: 10px;">
                        <!-- Los servicios se listarán aquí -->
                        <p>Cargando servicios...</p>
                    </div>

                    <div class="row mb-3 alert alert-info">
                        <div class="col-md-4"><strong>Total Calculado:</strong> S./ <span id="pago_monto_total_calculado_cita">0.00</span></div>
                        <div class="col-md-4"><strong>Total Abonado:</strong> S./ <span id="pago_total_ya_pagado_cita">0.00</span></div>
                        <div class="col-md-4 text-danger"><strong>Monto Pendiente:</strong> S./ <span id="pago_monto_pendiente_cita">0.00</span></div>
                    </div>
                    
                    <hr>
                    <h6>Registrar Nuevo Pago:</h6>
                     <div class="row align-items-end">
                        <div class="col-md-3 mb-3">
                            <label for="pago_monto_a_pagar" class="form-label">Monto a Pagar <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="pago_monto_a_pagar" step="0.01" required>
                        </div>
                         <div class="col-md-3 mb-3">
                            <label for="pago_descuento" class="form-label">Descuento</label>
                            <input type="number" class="form-control" id="pago_descuento" step="0.01" value="0.00">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pago_metodo_pago" class="form-label">Método de Pago <span class="text-danger">*</span></label>
                            <select class="form-select form-control" id="pago_metodo_pago" required>
                                <option value="">Seleccione...</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta">Tarjeta de Crédito/Débito</option>
                                <option value="Transferencia SPEI">Transferencia SPEI</option>
                                <!-- <option value="OXXO Pay">OXXO Pay</option> --> <!-- Opcional si aplica -->
                                <!-- <option value="Cheque">Cheque</option> --> <!-- Opcional si aplica -->
                                <!-- <option value="Otro">Otro</option> --> <!-- Mantener si quieres una opción genérica -->
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pago_referencia" class="form-label">Referencia</label>
                            <input type="text" class="form-control" id="pago_referencia" placeholder="Ej: ID Transacción">
                        </div>
                        
                    <div class="row mb-3">
                        <div class="col-md-12"><strong>Monto Neto de esta Transacción: S./ <span id="pago_monto_neto_transaccion">0.00</span></strong></div>


                    </div>
                    <div class="mb-3">
                        <label for="pago_notas" class="form-label">Notas Adicionales</label>
                        <textarea class="form-control" id="pago_notas" rows="2"></textarea>
                    </div>
                </form>

                <hr>
                <h6>Historial de Pagos de esta Cita:</h6>
                <div id="pago_historial_pagos_container" style="max-height: 150px; overflow-y: auto; border: 1px solid #eee; padding: 10px;">
                    <p>No hay pagos registrados para esta cita.</p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnRegistrarPago">Registrar Pago</button> 
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    var calendarEl = document.getElementById('calendar');
    var scheduleEl = document.getElementById('schedule');
    var calendarInstance; // Declarar la instancia aquí para que sea accesible en changeView
    // Variables para el contexto de la cita/sesión activa para el historial
    let idPacienteCitaActiva = null;
    let idCitaParaRefrescarSesiones = null;
    // Variables para guardar la información del clic en el calendario para el menú contextual
    let currentSelectionInfo = null;
    let currentEventInfo = null;
    // Seleccionar los botones de vista
    const botonesVista = {
        'timeGridDay': document.querySelector('button[onclick="changeView(\'timeGridDay\')"]'),
        'timeGridWeek': document.querySelector('button[onclick="changeView(\'timeGridWeek\')"]'),
        'dayGridMonth': document.querySelector('button[onclick="changeView(\'dayGridMonth\')"]')
    };


    if (!calendarEl) {
        console.error("Elemento #calendar no encontrado. El calendario no se puede inicializar.");
        return;
    }
    // Hacer el modal arrastrable
    $('#modalCita').draggable({
        handle: "#modalCitaHeader" // Especifica el encabezado como el área para arrastrar
    });
       // Hacer el modal de Sesiones arrastrable
    $('#modalSesion').draggable({
        handle: "#modalSesionHeader" // Usa el ID del encabezado del modal de sesiones
    });
    if (typeof FullCalendar === 'undefined' || typeof FullCalendar.Calendar === 'undefined') {
        console.error("FullCalendar o FullCalendar.Calendar no está definido. Asegúrate de que la librería esté cargada en plantilla.php.");
        return;
    }

    // Prevenir reinicialización si ya existe una instancia (útil si se carga el contenido múltiples veces)
    if (calendarEl.fullCalendarInstance) {
        console.log("Calendario ya inicializado en este elemento. Si necesitas recargar, considera destruirlo primero.");
        // Podrías querer usar la instancia existente o destruirla y crear una nueva.
        // Por ejemplo, para usar la existente:
        // window.changeView se redefiniría abajo para usar esta instancia.
        // calendarInstance = calendarEl.fullCalendarInstance;
        // return; // Opcional, dependiendo de si quieres re-renderizar o no.
        // O destruir:
        // calendarEl.fullCalendarInstance.destroy();
        // delete calendarEl.fullCalendarInstance;
    }

    calendarInstance = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: '' // Los botones de cambio de vista están fuera
        },
        slotMinTime: "08:00:00",
        slotMaxTime: "20:00:00",
       // slotDuration: "01:00:00",
        selectable: true, // Permitir seleccionar rangos de tiempo/días
        locale: 'es', // Descomenta si cargaste el locale 'es' en plantilla.php
        events: '../ajax/citas.ajax.php?accion=listar', // URL para cargar eventos
        select: function(selectionInfo) {
            currentSelectionInfo = selectionInfo; // Guardar info de la selección
            currentEventInfo = null; // No hay evento existente

            // Configurar y mostrar el menú contextual para "Agregar Cita"
            $('#btnMenuAgregarCita').show();
            $('#btnMenuEditarCita').hide();
            $('#btnMenuEditarPaciente').hide();
            $('#btnMenuPagos').hide();
            $('#modalMenuContextualCalendario').modal('show');
            /*
            $('#modalCitaLabel').text('Registrar Nueva Cita');
            $('#formCita')[0].reset(); 
            $('#id_cita').val(''); 
            
            
            $('#listaSesionesContainer').html('<p>No hay sesiones registradas para esta cita.</p>');

            
            let startDate = new Date(selectionInfo.startStr);
            if (!selectionInfo.allDay) {
                
                startDate.setMinutes(startDate.getMinutes() - startDate.getTimezoneOffset());
                $('#fechaHoraCita').val(startDate.toISOString().slice(0, 16));
            } else {
                
                let defaultTime = "08:00";
                $('#fechaHoraCita').val(selectionInfo.startStr + 'T' + defaultTime);
            }

            $('#estadoCita').val('Pendiente');
            $('#modalCita').modal('show');*/
        },
        eventClick: function(info) { // Cuando se hace clic en un evento existente
            currentEventInfo = info; // Guardar info del evento
            currentSelectionInfo = null; // No es una nueva selección

            // Configurar y mostrar el menú contextual para cita existente
            $('#btnMenuAgregarCita').hide();
            $('#btnMenuEditarCita').show();
            $('#btnMenuEditarPaciente').show(); // Mostrar si hay id_paciente
            $('#btnMenuPagos').show(); // Mostrar si es relevante

            // Podrías querer ocultar "Editar Paciente" o "Pagos" si no hay un paciente asociado
            // if (!info.event.extendedProps || !info.event.extendedProps.id_paciente) {
            //     $('#btnMenuEditarPaciente').hide();
            //     $('#btnMenuPagos').hide(); // O solo pagos si depende del paciente
            // }

            $('#modalMenuContextualCalendario').modal('show');


          /*  $('#modalCitaLabel').text('Editar Cita');
            $('#formCita')[0].reset(); 

            $('#listaSesionesContainer').html('<p>Cargando sesiones...</p>'); /
            $.ajax({
                url: '../ajax/citas.ajax.php',
                type: 'POST',
                data: {
                    accion: 'obtenerCitaPorId',
                    id_cita: info.event.id
                },
                dataType: 'json',
                success: function(cita) {
                    if (cita) {
                        $('#id_cita').val(cita.id_cita);
                        $('#selPaciente').val(cita.id_paciente);
                        $('#selFisioterapeuta').val(cita.id_fisioterapeuta);
                          let fechaHoraFormateada = cita.fecha_hora.replace(' ', 'T').substring(0, 16);
                        $('#fechaHoraCita').val(fechaHoraFormateada);
                        $('#motivoCita').val(cita.motivo);
                        $('#estadoCita').val(cita.estado);
                        $('#modalCita').modal('show');
                      
                        cargarSesionesDeCita(cita.id_cita, cita.id_paciente); 
                    } else {
                        Swal.fire('Error', 'No se pudieron obtener los detalles de la cita.', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Problema al obtener datos de la cita.', 'error');
                }
            });*/
        },
        eventDidMount: function(info) {
            // Inicializar tooltips para los eventos del calendario si es necesario
            // $(info.el).tooltip({ title: info.event.extendedProps.tooltipContent || info.event.title });
        }
        // Puedes añadir más opciones de FullCalendar aquí
    });

    calendarInstance.render();
    calendarEl.fullCalendarInstance = calendarInstance; // Guardar la instancia en el elemento

    window.changeView = function(view) {
        if (calendarInstance) {
            calendarInstance.changeView(view);

            // Actualizar la clase 'active' en los botones
            for (const key in botonesVista) {
                if (botonesVista[key]) {
                    botonesVista[key].classList.remove('active');
                }
            }
            if (botonesVista[view]) {
                botonesVista[view].classList.add('active');
            }

            if (scheduleEl) { // Asegurarse de que scheduleEl exista
                if (view === 'timeGridDay' || view === 'timeGridWeek') {
                    scheduleEl.classList.remove('d-none');
                } else {
                    scheduleEl.classList.add('d-none');
                }
            }
        } else {
            console.error("Instancia del calendario no encontrada en changeView.");
        }
    };

    // Marcar el botón de la vista inicial como activo después de renderizar el calendario
    // Asumiendo que la vista inicial es 'dayGridMonth' como en tu configuración de FullCalendar
    if (calendarInstance && botonesVista[calendarInstance.currentData.currentViewType]) {
        botonesVista[calendarInstance.currentData.currentViewType].classList.add('active');
    } else if (botonesVista['dayGridMonth']) { // Fallback a mes si es necesario
        botonesVista['dayGridMonth'].classList.add('active');
    }

    // Cargar Pacientes y Fisioterapeutas en los selects del modal
    function cargarSelectsModal() {
        // Cargar Pacientes (asumiendo que tienes un endpoint similar para pacientes)
        $.ajax({
            url: '../ajax/pacientes.ajax.php', // Necesitarás crear este endpoint o uno similar
            type: 'POST',
            data: { accion: 'listarParaSelect' }, // Una nueva acción en tu AJAX de pacientes
            dataType: 'json',
            success: function(pacientes) {
                $('#selPaciente').empty().append('<option value="">Seleccione Paciente</option>');
                pacientes.forEach(function(paciente) {
                    $('#selPaciente').append(`<option value="${paciente.id_paciente}">${paciente.nombre_completo}</option>`);
                });
            }
        });

        // Cargar Fisioterapeutas (reutilizando la lógica de especialistas)
        $.ajax({
            url: '../ajax/mao.especialistas.ajax.php',
            type: 'POST',
            data: { accion: 1 }, // La acción 1 ya lista especialistas
            dataType: 'json',
            success: function(fisioterapeutas) {
                $('#selFisioterapeuta').empty().append('<option value="">Seleccione Fisioterapeuta</option>');
                fisioterapeutas.forEach(function(fisio) {
                    // Asumo que 'nombre_completo' existe o lo construyes como en tu tabla de especialistas
                    let nombreCompleto = fisio.nombre_completo || `${fisio.nombre} ${fisio.apellido}`;
                    $('#selFisioterapeuta').append(`<option value="${fisio.id_fisioterapeuta}">${nombreCompleto}</option>`);
                });
            }
        });
    }

    cargarSelectsModal(); // Llamar al cargar la página
    cargarServiciosSelect(); // Cargar servicios para el modal de sesiones
    // Guardar Cita
    $('#btnGuardarCita').on('click', function() {
        const idCitaActual = $('#id_cita').val();
        // Validaciones básicas del formulario (puedes añadir más)
        if (!$('#selPaciente').val() || !$('#selFisioterapeuta').val() || !$('#fechaHoraCita').val()) {
            Swal.fire('Error', 'Paciente, Fisioterapeuta y Fecha/Hora son obligatorios.', 'error');
            return; 
        }

        // Validación para el estado "Completada"
        const estadoSeleccionado = $('#estadoCita').val();
        const fechaHoraCitaStr = $('#fechaHoraCita').val();

        if (estadoSeleccionado === 'Completada') {
            const fechaHoraCitaDate = new Date(fechaHoraCitaStr);
            const fechaHoraActual = new Date();

            // Ajustar la fecha de la cita para compararla correctamente (puede que no sea necesario si el input datetime-local ya está en la zona horaria correcta)
            // Si tu input datetime-local ya maneja la zona horaria local correctamente, puedes omitir el ajuste de zona horaria.
            // fechaHoraCitaDate.setMinutes(fechaHoraCitaDate.getMinutes() - fechaHoraCitaDate.getTimezoneOffset());


            if (fechaHoraCitaDate > fechaHoraActual) {
                Swal.fire('Acción no permitida', 'No se puede marcar una cita como "Completada" si su fecha y hora aún no ha llegado.', 'warning');
                return; // Detener la ejecución
            }
        }

        var datosCita = {
            // La acción se determinará si id_cita tiene valor o no
            id_paciente: $('#selPaciente').val(),
            id_fisioterapeuta: $('#selFisioterapeuta').val(),
            fecha_hora: $('#fechaHoraCita').val(),
            motivo: $('#motivoCita').val(),
            estado: $('#estadoCita').val()
        };

        datosCita.accion = idCitaActual ? 'actualizarCita' : 'registrarCita';
        if (idCitaActual) datosCita.id_cita = idCitaActual;

        $.ajax({
            url: '../ajax/citas.ajax.php',
            type: 'POST',
            data: datosCita,
            dataType: 'json',
            success: function(respuesta) {
                if (respuesta.resultado === 'ok') {
                    let mensajeExito = idCitaActual ? '¡Actualizado!' : '¡Registrado!';
                    Swal.fire(mensajeExito, respuesta.mensaje || 'La operación se realizó correctamente.', 'success');
                    $('#modalCita').modal('hide');
                    calendarInstance.refetchEvents(); // Recargar eventos en el calendario
                } else {
                    Swal.fire('Error', respuesta.mensaje || 'No se pudo registrar la cita.', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Ocurrió un problema de comunicación con el servidor.', 'error');
            }
        });
    });
    function cargarServiciosSelect() {
    // Asumiendo que tienes un endpoint similar para servicios
    // o puedes adaptar el existente si 'accion: 1' en mao.servicios.ajax.php ya lista los servicios.
    $.ajax({
        url: '../ajax/mao.servicios.ajax.php', 
        type: 'POST',
        data: { accion: 1 }, // O la acción que liste todos los servicios
        dataType: 'json',
        success: function(servicios) {
            $('#selServicio').empty().append('<option value="">Seleccione Servicio</option>');
            servicios.forEach(function(servicio) {
                // Asegúrate que los nombres de las propiedades (id_servicio, nombre_servicio) coincidan con tu respuesta AJAX
                $('#selServicio').append(`<option value="${servicio.id_servicio}">${servicio.nombre_servicio}</option>`);
            });
        },
        error: function() {
            console.error("Error al cargar servicios para el select de sesiones.");
            $('#selServicio').empty().append('<option value="">Error al cargar</option>');
        }
    });
}
// En d:\xampp\htdocs\mao\vistas\maocalendario.php
// Dentro de la IIFE (function() { ... })();

// --- INICIO: Lógica para el Historial Clínico (Adaptada para maocalendario.php) ---

function cargarSesionesParaModalHistorial(idPaciente, idSesionPreseleccionada = null, callback) {
    const $selectSesiones = $("#id_sesion_historial"); // ID del select en modalHistorialClinico
    $selectSesiones.html('<option value="">Cargando sesiones...</option>').prop('disabled', true);

    if (!idPaciente) {
        console.error("cargarSesionesParaModalHistorial: ID del paciente no proporcionado.");
        $selectSesiones.html('<option value="">Error: Paciente no identificado</option>').prop('disabled', false);
        if (callback) callback();
        return;
    }

    let promesaSesionActual = $.Deferred();
    let detallesSesionActual = null;

    // Promesa para obtener la sesión actualmente asociada (si estamos editando o es la sesión actual)
    if (idSesionPreseleccionada) {
        $.ajax({
            url: '../ajax/historialclinico.ajax.php', // Asegúrate que esta ruta sea correcta
            type: 'POST',
            data: {
                accionHistorial: 'obtenerDetallesSesionPorId', // Acción para obtener detalles de UNA sesión
                id_sesion_detalle: idSesionPreseleccionada
            },
            dataType: 'json'
        }).done(function(data) {
            detallesSesionActual = data;
        }).fail(function() {
            console.error("Error al cargar detalles de la sesión preseleccionada: " + idSesionPreseleccionada);
            // No necesariamente un error fatal, podría no existir o haber un problema de red.
        }).always(function() {
            promesaSesionActual.resolve();
        });
    } else {
        promesaSesionActual.resolve(); // Resolver inmediatamente si no hay sesión preseleccionada
    }

    // Promesa para obtener las sesiones disponibles del paciente (sin historial y completadas)
    let promesaSesionesDisponibles = $.ajax({
        url: '../ajax/historialclinico.ajax.php', // Asegúrate que esta ruta sea correcta
        type: 'POST',
        data: {
            accionHistorial: 'obtenerSesionesSinHistorial', // Acción para obtener sesiones del paciente sin historial
            id_paciente_sesiones: idPaciente
        },
        dataType: 'json'
    }).fail(function() {
        console.error("Error al cargar sesiones disponibles para el paciente: " + idPaciente);
    });

    // Cuando ambas promesas AJAX se completen (hayan tenido éxito o no)
    $.when(promesaSesionActual, promesaSesionesDisponibles).always(function(resultadoSesionActual, resultadoSesionesDisponibles) {
        let opcionesHtml = '';
        let opcionesAgregadas = new Set(); // Para evitar duplicar sesiones si aparecen en ambas listas

        // Añadir la sesión preseleccionada/actual primero si se cargaron sus detalles
        if (detallesSesionActual && detallesSesionActual.id_sesion) { // Verificar que id_sesion exista
            opcionesHtml += `<option value="${detallesSesionActual.id_sesion}">
                                ${new Date(detallesSesionActual.fecha_hora).toLocaleString()} - ${detallesSesionActual.nombre_servicio || 'Servicio no especificado'} (Sesión seleccionada)
                           </option>`;
            opcionesAgregadas.add(String(detallesSesionActual.id_sesion));
        }

        // Añadir las sesiones disponibles (que no sean la preseleccionada si ya se añadió)
        // resultadoSesionesDisponibles es un array, el primer elemento es la data
        const sesionesDisponiblesData = (resultadoSesionesDisponibles && resultadoSesionesDisponibles[0]) ? resultadoSesionesDisponibles[0] : []; 
        if (sesionesDisponiblesData && sesionesDisponiblesData.length > 0) {
            sesionesDisponiblesData.forEach(function(sesion) {
                if (!opcionesAgregadas.has(String(sesion.id_sesion))) {
                    opcionesHtml += `<option value="${sesion.id_sesion}">
                                        ${new Date(sesion.fecha_hora).toLocaleString()} - ${sesion.nombre_servicio || 'Servicio no especificado'}
                                   </option>`;
                    // No es necesario agregar a opcionesAgregadas aquí si la lógica es solo para no duplicar la preseleccionada.
                }
            });
        }
        
        // Si no se agregaron opciones (ni la preseleccionada ni disponibles), mostrar un mensaje adecuado
        if (opcionesHtml === '') {
            opcionesHtml = '<option value="">No hay sesiones disponibles o asociadas</option>';
        } else if (!idSesionPreseleccionada || (idSesionPreseleccionada && sesionesDisponiblesData.length > 0 && !sesionesDisponiblesData.find(s => s.id_sesion == idSesionPreseleccionada))) {
            // Añadir el placeholder "Seleccione una sesión..." si no hay una sesión preseleccionada
            // O si hay una preseleccionada Y además hay otras opciones disponibles (para permitir cambiar)
             opcionesHtml = '<option value="">Seleccione una sesión...</option>' + opcionesHtml;
        }
        
        $selectSesiones.html(opcionesHtml).prop('disabled', false);

        // Seleccionar la sesión preseleccionada si existe
        if (idSesionPreseleccionada && detallesSesionActual && detallesSesionActual.id_sesion) {
            $selectSesiones.val(idSesionPreseleccionada);
        }
        
        if (callback) {
            callback();
        }
    });
}
// En d:\xampp\htdocs\mao\vistas\maocalendario.php
// Dentro de la IIFE (function() { ... })();
// Y dentro de la sección // --- INICIO: Lógica para el Historial Clínico (Adaptada para maocalendario.php) ---

function cargarCatalogoDiagnosticosParaModalHistorial(idDiagnosticoSeleccionado = null) {
    const $selectDiagnosticos = $("#diagnostico_historial"); // ID del select en modalHistorialClinico

    // Mostrar un mensaje de carga mientras se obtienen los datos
    $selectDiagnosticos.html('<option value="">Cargando diagnósticos...</option>').prop('disabled', true);

    $.ajax({
        url: '../ajax/historialclinico.ajax.php', // Asegúrate que esta ruta sea correcta
        type: 'POST',
        data: { accionHistorial: 'obtenerCatalogoDiagnosticos' }, // Acción para obtener todos los diagnósticos
        dataType: 'json',
        success: function(diagnosticos) {
            let options = '<option value="">Seleccione un diagnóstico...</option>';
            if (diagnosticos && diagnosticos.length > 0) {
                diagnosticos.forEach(function(diag) {
                    // Construir el texto de la opción, incluyendo el código estándar si existe
                    let textoOpcion = diag.nombre_diagnostico;
                    if (diag.codigo_estandar) {
                        textoOpcion = `${diag.codigo_estandar} - ${diag.nombre_diagnostico}`;
                    }
                    options += `<option value="${diag.id_diagnostico}" ${idDiagnosticoSeleccionado == diag.id_diagnostico ? 'selected' : ''}>
                                    ${textoOpcion}
                                </option>`;
                });
            } else {
                options = '<option value="">No hay diagnósticos disponibles</option>';
            }
            $selectDiagnosticos.html(options).prop('disabled', false); // Poblar y habilitar el select

            // Si se pasó un ID para preseleccionar, asegurarse de que esté seleccionado
            if (idDiagnosticoSeleccionado) {
                $selectDiagnosticos.val(idDiagnosticoSeleccionado);
            }
        },
        error: function() {
            console.error("Error al cargar el catálogo de diagnósticos.");
            $selectDiagnosticos.html('<option value="">Error al cargar diagnósticos</option>').prop('disabled', false);
        }
    });
}


// ... (Aquí iría la función cargarCatalogoDiagnosticosParaModalHistorial si también falta) ...
// ... (Y luego el evento $(document).on('click', '.btnGestionarEvolucionSesion', ...) que ya tienes) ...


function cargarSesionesDeCita(idCita, idPacienteDeLaCita) {
    // Guardar el idPaciente de la cita actual para usarlo después si es necesario
    idPacienteCitaActiva = idPacienteDeLaCita;
    idCitaParaRefrescarSesiones = idCita;
    $.ajax({
        url: '../ajax/sesiones.ajax.php',
        type: 'POST',
        data: {
            accionSesion: 'listarPorCita',
            id_cita_para_sesiones: idCita
        },
        dataType: 'json',
        success: function(sesiones) {
            var sesionesHtml = '<ul class="list-group list-group-flush">';
            if (sesiones && sesiones.length > 0) {
                sesiones.forEach(function(sesion) {
                    sesionesHtml += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Servicio:</strong> ${sesion.nombre_servicio || 'N/A'} <br>
                                            <strong>Fecha:</strong> ${new Date(sesion.fecha_hora).toLocaleString()} <br>
                                            <strong>Notas:</strong> ${sesion.notas || 'Sin notas'}
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-info btnGestionarEvolucionSesion" 
                                                    data-id-sesion="${sesion.id_sesion}" 
                                                    data-id-cita="${sesion.id_cita}"
                                                    data-id-paciente="${idPacienteDeLaCita}"
                                                    data-fecha-sesion="${sesion.fecha_hora}"
                                                    data-toggle="tooltip" title="Ver/Registrar Evolución Clínica">
                                                <i class="fas fa-notes-medical"></i> Evolución
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary btnEditarSesion" data-id-sesion="${sesion.id_sesion}" data-id-cita="${sesion.id_cita}"><i class="fas fa-pencil-alt"></i></button>
                                            <button class="btn btn-sm btn-outline-danger btnEliminarSesion" data-id-sesion="${sesion.id_sesion}" data-id-cita="${sesion.id_cita}"><i class="fas fa-trash"></i></button>
                                        </div>
                                     </li>`;
                });
            } else {
                sesionesHtml += '<li class="list-group-item">No hay sesiones registradas para esta cita.</li>';
            }
            sesionesHtml += '</ul>';
            $('#listaSesionesContainer').html(sesionesHtml);
            // Reinicializar tooltips para los nuevos botones
            $('[data-toggle="tooltip"]').tooltip();
        },
        error: function() {
            $('#listaSesionesContainer').html('<p class="text-danger">Error al cargar las sesiones.</p>');
        }
    });
}
// En d:\xampp\htdocs\mao\vistas\maocalendario.php
// Dentro de la IIFE (function() { ... })(); y después de definir
// cargarSesionesParaModalHistorial y cargarCatalogoDiagnosticosParaModalHistorial

// Evento para gestionar la evolución de una sesión desde el modal de Cita
$(document).on('click', '.btnGestionarEvolucionSesion', function() {
    // Descomenta las siguientes líneas si necesitas depurar:
    // alert("¡Clic en botón Evolución detectado en maocalendario.php!"); 
    // console.log("Botón Evolución clickeado. Datos:", $(this).data());

    const idSesion = $(this).data('id-sesion');
    const idPaciente = $(this).data('id-paciente'); // Este es idPacienteCitaActiva
    const fechaSesion = $(this).data('fecha-sesion');
    // Actualizar la variable global para saber qué cita refrescar después de guardar
    idCitaParaRefrescarSesiones = $(this).data('id-cita'); 

    $("#formHistorialClinico")[0].reset();
    $("#id_historial_form").val(''); // Limpiar el ID del historial por si acaso

    if (!idPaciente) {
        Swal.fire("Error", "No se pudo identificar el paciente para esta sesión. Asegúrese de que la cita tenga un paciente asignado.", "error");
        return;
    }
    if (!idSesion) {
        Swal.fire("Error", "No se pudo identificar la sesión.", "error");
        return;
    }

    // Verificar si ya existe una evolución para esta sesión
    $.ajax({
        url: '../ajax/historialclinico.ajax.php', // Ruta al AJAX del historial
        type: 'POST',
        data: { 
            accionHistorial: 'obtenerPorSesion', 
            id_sesion_ver_historial: idSesion 
        },
        dataType: 'json',
        success: function(historialExistente) {
            if (historialExistente && historialExistente.id_historial) { 
                // Si existe historial, cargar para editar/ver
                $("#modalHistorialClinicoLabel").text("Ver/Editar Evolución Clínica");
                $("#id_historial_form").val(historialExistente.id_historial);
                
                // Cargar el select de sesiones: la sesión actual debe estar y seleccionarse.
                // Se deshabilita porque no se debe cambiar la sesión de una evolución existente desde este flujo.
                cargarSesionesParaModalHistorial(idPaciente, historialExistente.id_sesion, function() {
                    $("#id_sesion_historial").val(historialExistente.id_sesion).prop("disabled", true); 
                });

                // Formatear y establecer la fecha de evaluación
                let fechaEval = historialExistente.fecha_evaluacion.replace(' ', 'T').substring(0, 16);
                $("#fecha_evaluacion_historial").val(fechaEval);

                // Llenar los campos del formulario
                $("#subjetivo_historial").val(historialExistente.subjetivo);
                $("#objetivo_historial").val(historialExistente.objetivo);
                
                cargarCatalogoDiagnosticosParaModalHistorial(historialExistente.id_diagnostico); // Cargar y seleccionar diagnóstico
                
                $("#plan_tratamiento_historial").val(historialExistente.plan_tratamiento_sesion);
                $("#objetivos_corto_historial").val(historialExistente.objetivos_corto_plazo);
                $("#objetivos_largo_historial").val(historialExistente.objetivos_largo_plazo);
                $("#recomendaciones_historial").val(historialExistente.recomendaciones_domiciliarias);
                $("#evolucion_historial").val(historialExistente.evolucion_notas);
                $("#proxima_cita_historial").val(historialExistente.proxima_cita_sugerida);

            } else { 
                // Si no existe historial, preparar para nuevo registro
                $("#modalHistorialClinicoLabel").text("Registrar Nueva Evolución Clínica");
                
                // Cargar el select de sesiones: la sesión actual debe estar seleccionada y deshabilitada.
                cargarSesionesParaModalHistorial(idPaciente, idSesion, function() {
                     $("#id_sesion_historial").val(idSesion).prop("disabled", true); 
                });
                
                cargarCatalogoDiagnosticosParaModalHistorial(); // Cargar diagnósticos sin preselección
                
                // Usar la fecha y hora de la sesión como fecha de evaluación por defecto
                let fechaSesFormateada = fechaSesion.replace(' ', 'T').substring(0, 16);
                $("#fecha_evaluacion_historial").val(fechaSesFormateada); 
            }
            // Mostrar el modal del historial clínico
            $("#modalHistorialClinico").modal("show");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error al verificar historial de sesión:", textStatus, errorThrown);
            Swal.fire("Error", "No se pudo verificar el historial de la sesión. Por favor, intente de nuevo.", "error");
        }
    });
});

  // Guardar (Registrar o Editar) Historial Clínico
$("#btnGuardarHistorialClinico").on("click", function() {
        
        // Validación simple del lado del cliente (puedes mejorarla)
        if (!$("#id_sesion_historial").val() || !$("#fecha_evaluacion_historial").val()) {
            Swal.fire("Atención", "La sesión asociada y la fecha de evaluación son obligatorias.", "warning");
            return;
        }
        
        const idHistorial = $("#id_historial_form").val();
        const accion = idHistorial ? "editar" : "registrar";
        let formData = $("#formHistorialClinico").serializeArray(); // Obtiene datos del form
        formData.push({name: "accionHistorial", value: accion});
        // El id_historial_form ya está en el serialize si tiene valor.
        // El id_sesion_historial también.
        // Los nombres de los campos en el form deben coincidir con los esperados por el controlador.
        // Ejemplo: name="subjetivo_historial" en el textarea.

        // Convertir serializeArray a un objeto para facilitar el acceso
        let dataToSend = {};
        formData.forEach(item => {
            dataToSend[item.name] = item.value;
        });
        // Asegurar que el id_sesion se envíe correctamente si estaba deshabilitado
        if (accion === "editar") {
            dataToSend["id_sesion_historial"] = $("#id_sesion_historial").val();
        }


        $.ajax({
            url: '../ajax/historialclinico.ajax.php',
            type: 'POST',
            data: dataToSend,
            dataType: 'json',
            success: function(response) {
                if (response.status === "ok") {
                    Swal.fire("¡Guardado!", `La evolución clínica ha sido ${accion === 'registrar' ? 'registrada' : 'actualizada'}.`, "success");
                    $("#modalHistorialClinico").modal("hide");
                    if (idPacienteCitaActiva && idCitaParaRefrescarSesiones) { 
                     cargarSesionesDeCita(idCitaParaRefrescarSesiones, idPacienteCitaActiva);
                }
                    //if (idPacienteFicha) { // Usar el id de la ficha
                        //cargarHistorialClinico(idPacienteFicha); // Recargar la lista
                    //if (idPacienteActual) {
                    //    cargarHistorialClinico(idPacienteActual); // Recargar la lista
                    
                } else {
                    Swal.fire("Error", response.message || "No se pudo guardar la evolución.", "error");
                }
            },
            error: function() {
                Swal.fire("Error", "Ocurrió un problema de comunicación.", "error");
            }
        });
});
// Event handler para abrir el modal de nueva sesión
$(document).on('click', '#btnAbrirModalNuevaSesion', function() {
    const citaId = $('#id_cita').val(); // Obtener el ID de la cita actual desde el modal de citas
    if (!citaId) {
        Swal.fire('Error', 'Primero debe seleccionar o guardar una cita.', 'error');
        return;
    }
    $('#formSesion')[0].reset();
    $('#id_sesion_editar').val(''); 
    $('#id_cita_sesion').val(citaId); 
    $('#modalSesionLabel').text('Registrar Nueva Sesión');
    // cargarServiciosSelect(); // Ya se llama al inicio, o si prefieres, aquí de nuevo
    $('#modalSesion').modal('show');
});

// Event handler para guardar una sesión (nueva o editada)
$('#btnGuardarSesion').on('click', function() {
    var idSesionEditar = $('#id_sesion_editar').val();
    var accionAjax = idSesionEditar ? 'actualizar' : 'registrar';
    
    var datosSesion = {
        accionSesion: accionAjax,
        id_cita_sesion: $('#id_cita_sesion').val(), 
        selServicio: $('#selServicio').val(),
        fechaHoraSesion: $('#fechaHoraSesion').val(),
        notasSesion: $('#notasSesion').val()
    };

    if (idSesionEditar) {
        datosSesion.id_sesion_editar = idSesionEditar;
        datosSesion.id_cita_sesion_editar = $('#id_cita_sesion_editar').val(); 
    }
    
    if (!datosSesion.selServicio || !datosSesion.fechaHoraSesion) {
        Swal.fire('Error', 'Servicio y Fecha/Hora son obligatorios para la sesión.', 'error');
        return;
    }

    $.ajax({
        url: '../ajax/sesiones.ajax.php',
        type: 'POST',
        data: datosSesion,
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.resultado === 'ok') {
                Swal.fire(idSesionEditar ? '¡Actualizada!' : '¡Registrada!', respuesta.mensaje || 'La sesión se guardó correctamente.', 'success');
                $('#modalSesion').modal('hide');
                // Necesitamos el id_paciente para recargar las sesiones correctamente
                // Asumimos que idPacienteCitaActiva tiene el ID del paciente de la cita que está abierta
                let idCitaParaRecargar = datosSesion.id_cita_sesion || datosSesion.id_cita_sesion_editar;
                 if (idCitaParaRecargar && idPacienteCitaActiva) {
                    cargarSesionesDeCita(idCitaParaRecargar, idPacienteCitaActiva);
                }
                // cargarSesionesDeCita(datosSesion.id_cita_sesion || datosSesion.id_cita_sesion_editar); 
            } else {
                Swal.fire('Error', respuesta.mensaje || 'No se pudo guardar la sesión.', 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'Ocurrió un problema de comunicación con el servidor para la sesión.', 'error');
        }
    });
});

// Delegated event handler para editar una sesión
$(document).on('click', '.btnEditarSesion', function() {
   
    var idSesion = $(this).data('id-sesion');
    var idCitaOriginal = $(this).data('id-cita'); 
    
    $.ajax({
        url: '../ajax/sesiones.ajax.php',
        type: 'POST',
        data: { accionSesion: 'obtenerPorId', id_sesion_obtener: idSesion },
        dataType: 'json',
        success: function(sesion) {
            if (sesion) {
                $('#formSesion')[0].reset();
                $('#id_sesion_editar').val(sesion.id_sesion);
                $('#id_cita_sesion').val(sesion.id_cita); 
                $('#id_cita_sesion_editar').val(sesion.id_cita); 
                
                $('#selServicio').val(sesion.id_servicio);
                let fechaHoraSesionFormateada = sesion.fecha_hora.replace(' ', 'T').substring(0, 16);
                $('#fechaHoraSesion').val(fechaHoraSesionFormateada);
                $('#notasSesion').val(sesion.notas);
                
                $('#modalSesionLabel').text('Editar Sesión');
                $('#modalSesion').modal('show');
            } else {
                Swal.fire('Error', 'No se pudieron obtener los detalles de la sesión.', 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'Problema al obtener datos de la sesión para editar.', 'error');
        }
    });
});

// Delegated event handler para eliminar una sesión
$(document).on('click', '.btnEliminarSesion', function() {
    var idSesion = $(this).data('id-sesion');
    var idCitaDeLaSesion = $(this).data('id-cita');

    Swal.fire({
        title: '¿Está seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, ¡eliminarla!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../ajax/sesiones.ajax.php',
                type: 'POST',
                data: { accionSesion: 'eliminar', id_sesion_eliminar: idSesion },
                dataType: 'json',
                success: function(respuesta) {
                    if (respuesta.resultado === 'ok') {
                        Swal.fire('¡Eliminada!', respuesta.mensaje || 'La sesión ha sido eliminada.', 'success');
                        // Necesitamos el id_paciente para recargar las sesiones correctamente
                        // Asumimos que idPacienteCitaActiva tiene el ID del paciente de la cita que está abierta
                        if (idCitaDeLaSesion && idPacienteCitaActiva) {
                            cargarSesionesDeCita(idCitaDeLaSesion, idPacienteCitaActiva);
                        }
                    } else {
                        Swal.fire('Error', respuesta.mensaje || 'No se pudo eliminar la sesión.', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Problema al eliminar la sesión.', 'error');
                }
            });
        }
    });
});
// Ajustar z-index del modal de sesión cuando se muestra, para asegurar que esté encima del modal de cita
$('#modalSesion').on('shown.bs.modal', function () {
    var zIndexCita = parseInt($('#modalCita').css('z-index'), 10);
    var zIndexActualSesion = parseInt($(this).css('z-index'), 10);

    // Si el modal de cita tiene un z-index y el modal de sesión está por debajo o igual,
    // se incrementa el z-index del modal de sesión.
    // Bootstrap 4 asigna z-index base de 1050, y para modales apilados va incrementando (ej. 1070 para el segundo).
    // Este ajuste es por si jQuery UI draggable ha elevado mucho el z-index del modal de cita.
    if (!isNaN(zIndexCita) && (isNaN(zIndexActualSesion) || zIndexActualSesion <= zIndexCita)) {
        $(this).css('z-index', zIndexCita + 10); // +10 debería ser suficiente para ponerlo encima
    }
    // Bootstrap 4 maneja el z-index de los backdrops apilados automáticamente.
});
// --- INICIO: Lógica para el Menú Contextual del Calendario ---

$('#btnMenuAgregarCita').on('click', function() {
    $('#modalMenuContextualCalendario').modal('hide');
    if (currentSelectionInfo) {
        $('#modalCitaLabel').text('Registrar Nueva Cita');
        $('#formCita')[0].reset();
        $('#id_cita').val('');
        $('#listaSesionesContainer').html('<p>No hay sesiones registradas para esta cita.</p>');

        let startDate = new Date(currentSelectionInfo.startStr);
        if (!currentSelectionInfo.allDay) {
            startDate.setMinutes(startDate.getMinutes() - startDate.getTimezoneOffset());
            $('#fechaHoraCita').val(startDate.toISOString().slice(0, 16));
        } else {
            let defaultTime = "08:00";
            $('#fechaHoraCita').val(currentSelectionInfo.startStr + 'T' + defaultTime);
        }
        $('#estadoCita').val('Pendiente');
        $('#modalCita').modal('show');
    }
});

$('#btnMenuEditarCita').on('click', function() {
    $('#modalMenuContextualCalendario').modal('hide');
    if (currentEventInfo && currentEventInfo.event) {
        $('#modalCitaLabel').text('Editar Cita');
        $('#formCita')[0].reset();
        $('#listaSesionesContainer').html('<p>Cargando sesiones...</p>');

        $.ajax({
            url: '../ajax/citas.ajax.php',
            type: 'POST',
            data: {
                accion: 'obtenerCitaPorId',
                id_cita: currentEventInfo.event.id
            },
            dataType: 'json',
            success: function(cita) {
                if (cita) {
                    $('#id_cita').val(cita.id_cita);
                    $('#selPaciente').val(cita.id_paciente);
                    $('#selFisioterapeuta').val(cita.id_fisioterapeuta);
                    let fechaHoraFormateada = cita.fecha_hora.replace(' ', 'T').substring(0, 16);
                    $('#fechaHoraCita').val(fechaHoraFormateada);
                    $('#motivoCita').val(cita.motivo);
                    $('#estadoCita').val(cita.estado);
                    $('#modalCita').modal('show');
                    cargarSesionesDeCita(cita.id_cita, cita.id_paciente);
                } else {
                    Swal.fire('Error', 'No se pudieron obtener los detalles de la cita.', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Problema al obtener datos de la cita.', 'error');
            }
        });
    }
});

$('#btnMenuEditarPaciente').on('click', function() {
    $('#modalMenuContextualCalendario').modal('hide');
    alert(currentEventInfo.event.extendedProps.id_paciente); // Aquí puedes implementar la lógica para editar el paciente
    if (currentEventInfo && currentEventInfo.event && currentEventInfo.event.extendedProps && currentEventInfo.event.extendedProps.id_paciente) {
        const idPaciente = currentEventInfo.event.extendedProps.id_paciente;
        // Opción 1: Redirigir a la vista de pacientes con el ID para mostrar la ficha
        // window.location.href = 'index.php?pagina=pacientes&id_paciente_ficha=' + idPaciente;
        
        // Cargar la vista de pacientes, pasando el id_paciente_ficha como parámetro.
        // La vista pacientes.php se encargará de mostrar la ficha y/o el modal de edición.
        CargarContenido('pacientes.php?id_paciente_ficha=' + idPaciente, 'content-wrapper');
        
    } else {
        Swal.fire('Error', 'No hay un paciente asociado a esta cita para editar.', 'error');
    }
});

/*$('#btnMenuPagos').on('click', function() {
    $('#modalMenuContextualCalendario').modal('hide');
    Swal.fire('Próximamente', 'La funcionalidad de Pagos se implementará aquí.', 'info');
    // Aquí iría la lógica para abrir el modal de pagos o redirigir a la sección de pagos
});*/

// --- FIN: Lógica para el Menú Contextual del Calendario ---
// Hacer el modal de Pagos arrastrable
$('#modalPagos').draggable({
    handle: "#modalPagosHeader"
});

// Evento para el botón "Gestionar Pagos" del menú contextual
$('#btnMenuPagos').on('click', function() {
    $('#modalMenuContextualCalendario').modal('hide');

    if (currentEventInfo && currentEventInfo.event) {
        const idCita = currentEventInfo.event.id;
        // Asumimos que id_paciente y id_fisioterapeuta están en extendedProps
        const idPaciente = currentEventInfo.event.extendedProps.id_paciente;
        const idFisioterapeuta = currentEventInfo.event.extendedProps.id_fisioterapeuta;

        if (!idPaciente) {
            Swal.fire('Error', 'No hay un paciente asociado a esta cita para gestionar pagos.', 'error');
            return;
        }

        $('#pago_id_cita_actual').val(idCita);
        $('#pago_id_paciente_actual').val(idPaciente);
        $('#pago_id_fisioterapeuta_actual').val(idFisioterapeuta); // Guardar para mostrar nombre

        // Limpiar campos antes de cargar nueva info
        $('#pago_display_nombre_paciente').text('Cargando...');
        $('#pago_display_nombre_fisioterapeuta').text('Cargando...');
        $('#pago_display_fecha_cita').text('Cargando...');
        $('#pago_detalle_servicios_container').html('<p>Cargando servicios...</p>');
        $('#pago_monto_total_calculado_cita').text('0.00');
        $('#pago_total_ya_pagado_cita').text('0.00');
        $('#pago_monto_pendiente_cita').text('0.00');
        $('#pago_historial_pagos_container').html('<p>Cargando historial...</p>');
        $('#formPago')[0].reset(); // Resetear el formulario de nuevo pago

        // AJAX para obtener información de la cita y pagos
        $.ajax({
            url: '../ajax/pagos.ajax.php', // Crear este archivo
            type: 'POST',
            data: {
                accion: 'obtener_info_pago_cita',
                id_cita: idCita
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    $('#pago_display_nombre_paciente').text(data.nombre_paciente || 'N/A');
                    $('#pago_display_nombre_fisioterapeuta').text(data.nombre_fisioterapeuta || 'N/A');
                    $('#pago_display_fecha_cita').text(new Date(data.fecha_cita.replace(' ', 'T')).toLocaleString() || 'N/A');

                    let serviciosHtml = '<ul class="list-group list-group-flush">';
                    if (data.sesiones_detalle && data.sesiones_detalle.length > 0) {
                        data.sesiones_detalle.forEach(function(detalle) {
                            serviciosHtml += `<li class="list-group-item">${detalle.nombre_servicio}: S./ ${parseFloat(detalle.precio_servicio).toFixed(2)}</li>`;
                        });
                    } else {
                        serviciosHtml += '<li class="list-group-item">No hay servicios detallados para esta cita.</li>';
                    }
                    serviciosHtml += '</ul>';
                    $('#pago_detalle_servicios_container').html(serviciosHtml);

                    $('#pago_monto_total_calculado_cita').text(parseFloat(data.monto_total_calculado_cita).toFixed(2));
                    $('#pago_total_ya_pagado_cita').text(parseFloat(data.total_ya_pagado_cita).toFixed(2));
                    $('#pago_monto_pendiente_cita').text(parseFloat(data.monto_pendiente_cita).toFixed(2));
                    
                    $('#pago_descuento').val('0.00');

                    // Pre-llenar el monto a pagar con el monto pendiente (que ya considera descuentos previos)
                    // O con el total calculado si no hay pagos previos.
                    if (parseFloat(data.monto_pendiente_cita) > 0 || parseFloat(data.monto_total_calculado_cita) > 0 && parseFloat(data.total_ya_pagado_cita) == 0) {

                        $('#pago_monto_a_pagar').val(parseFloat(data.monto_pendiente_cita).toFixed(2));
                    }


                    let historialHtml = '<ul class="list-group list-group-flush">';
                    if (data.historial_pagos && data.historial_pagos.length > 0) {
                        data.historial_pagos.forEach(function(pago) {
                            historialHtml += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    ${new Date(pago.fecha_pago.replace(' ', 'T')).toLocaleString()}: 
                                                    S./ ${parseFloat(pago.monto_transaccion).toFixed(2)} 
                                                    (${pago.metodo_pago})
                                                   ${parseFloat(pago.descuento_aplicado) > 0 ? ' (Desc: S./ ' + parseFloat(pago.descuento_aplicado).toFixed(2) + ')' : ''}
                                                    ${pago.notas_pago ? ' <br><small><i>' + pago.notas_pago + '</i></small>' : ''}
                                                </div>
                                                <div>
                                                    <button class="btn btn-sm btn-outline-primary btnImprimirTicketHistorial" data-id-pago="${pago.id_pago}" data-toggle="tooltip" title="Imprimir Ticket">
                                                        <i class="fas fa-print"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-secondary btnEnviarCorreoTicketHistorial" data-id-pago="${pago.id_pago}" data-correo-paciente="${data.correo_paciente || ''}" data-toggle="tooltip" title="Enviar por Correo">
                                                        <i class="fas fa-envelope"></i>
                                                    </button>
                                                </div>
                                                        <button class="btn btn-sm btn-outline-secondary btnVerDetallesPago" 
                                                        data-id-pago="${pago.id_pago}" 
                                                        data-toggle="tooltip" title="Ver detalles del pago">
                                                    <i class="fas fa-eye
                                              </li>`;
                        });
                    } else {
                        historialHtml += '<li class="list-group-item">No hay pagos registrados para esta cita.</li>';
                    }
                    historialHtml += '</ul>';
                    $('#pago_historial_pagos_container').html(historialHtml);
                    $('[data-toggle="tooltip"]').tooltip(); // Reinicializar tooltips
                      actualizarMontoNetoTransaccion(); // Actualizar monto neto al cargar


                    $('#modalPagos').modal('show');
                } else {
                    Swal.fire('Error', 'No se pudo obtener la información de pago para esta cita.', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Problema al conectar con el servidor para obtener datos de pago.', 'error');
            }
        });

    } else {
        Swal.fire('Error', 'No se ha seleccionado una cita válida.', 'error');
    }
});


// Función para actualizar el monto neto de la transacción
function actualizarMontoNetoTransaccion() {
    const montoAPagar = parseFloat($('#pago_monto_a_pagar').val()) || 0;
    const descuento = parseFloat($('#pago_descuento').val()) || 0;
    let montoNeto = montoAPagar - descuento;
    if (montoNeto < 0) montoNeto = 0; // El monto neto no puede ser negativo
    $('#pago_monto_neto_transaccion').text(montoNeto.toFixed(2));
}

// Eventos para recalcular el monto neto cuando cambian el monto a pagar o el descuento
$('#pago_monto_a_pagar, #pago_descuento').on('keyup change', function() {
    actualizarMontoNetoTransaccion();
});
// Evento para el botón "Registrar Pago" dentro del modal de Pagos
$('#btnRegistrarPago').on('click', function() {
    console.log("Botón #btnRegistrarPago clickeado!"); // Para depuración
    const idCita = $('#pago_id_cita_actual').val();
    const idPaciente = $('#pago_id_paciente_actual').val();
    const montoBrutoAPagar = parseFloat($('#pago_monto_a_pagar').val()) || 0;
    const descuentoAplicado = parseFloat($('#pago_descuento').val()) || 0;
    const metodoPago = $('#pago_metodo_pago').val();
    const referenciaPago = $('#pago_referencia').val();
    const notasPago = $('#pago_notas').val();
    const montoPendiente = parseFloat($('#pago_monto_pendiente_cita').text()) || 0;

    const montoNetoTransaccion = montoBrutoAPagar - descuentoAplicado;

    if (montoBrutoAPagar <= 0) {
        Swal.fire('Error', 'El "Monto a Pagar" (antes de descuento) debe ser mayor a cero.', 'error');
        return;
    }

    if (montoNetoTransaccion < 0) {
        Swal.fire('Error', 'El monto neto de la transacción (después del descuento) no puede ser negativo.', 'error');
        return;
    }

    if (!metodoPago) {
        Swal.fire('Error', 'Debe seleccionar un método de pago.', 'error');
        return;
    }

    // Comprobar si el monto neto a pagar excede el monto pendiente
    if (montoNetoTransaccion > montoPendiente) { 
         Swal.fire({
            title: 'Monto Excedente',
            text: `El monto neto a pagar (S./ ${montoNetoTransaccion.toFixed(2)}) es mayor al monto pendiente (S./ ${montoPendiente.toFixed(2)}). ¿Desea continuar y registrar el pago?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, registrar pago',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                procederConRegistroPago(); 
            }
        });
    } else {
         procederConRegistroPago(); // Proceder directamente si el monto no excede
    }

    function procederConRegistroPago() {
        //console.log("Ejecutando procederConRegistroPago..."); // Para depuración
        $.ajax({
            url: '../ajax/pagos.ajax.php', 
            type: 'POST',
            data: {
                accion: 'registrar_pago',
                id_cita: idCita,
                id_paciente: idPaciente,
                monto_transaccion: montoNetoTransaccion.toFixed(2), 
                descuento_aplicado: descuentoAplicado.toFixed(2), // Enviar el descuento
                metodo_pago: metodoPago,
                referencia_pago: referenciaPago,
                notas_pago: notasPago
                // id_usuario_registra se tomará de la sesión en el backend
            },
            dataType: 'json',
            success: function(respuesta) {
                if (respuesta.resultado === 'ok') {
                   Swal.fire({
                        title: '¡Pago Registrado!',
                        text: respuesta.mensaje || 'El pago se registró correctamente.',
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: '<i class="fas fa-download"></i> Descargar Ticket',
                        cancelButtonText: '<i class="fas fa-envelope"></i> Enviar por Correo',
                        showDenyButton: true,
                        denyButtonText: 'Cerrar',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Descargar Ticket
                            window.open('../reportes/generar_ticket_pago.php?id_pago=' + respuesta.id_pago, '_blank');
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            // Enviar por Correo (Implementación futura)
                            Swal.fire('Próximamente', 'La función de enviar ticket por correo se implementará pronto.', 'info');
                            // Aquí llamarías a la función para enviar correo, pasando respuesta.id_pago
                        }
                        $('#modalPagos').modal('hide');
                        if (typeof calendarInstance !== 'undefined' && calendarInstance.refetchEvents) {
                            calendarInstance.refetchEvents(); 
                        }
                    });
                    // Para actualizar la info en el modal si se vuelve a abrir, es mejor que el clic en btnMenuPagos siempre recargue.
                } else {
                    Swal.fire('Error', respuesta.mensaje || 'No se pudo registrar el pago.', 'error');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error AJAX en registrar_pago:", textStatus, errorThrown, jqXHR.responseText);
                Swal.fire('Error de Comunicación', 'Problema al conectar con el servidor para registrar el pago. Revise la consola para más detalles.', 'error');
            }
        });
    }
});
// --- INICIO: Eventos para botones en el Historial de Pagos ---
$(document).on('click', '.btnImprimirTicketHistorial', function() {
    const idPago = $(this).data('id-pago');
    if (idPago) {
        window.open('../reportes/generar_ticket_pago.php?id_pago=' + idPago, '_blank');
    } else {
        Swal.fire('Error', 'No se pudo obtener el ID del pago para imprimir el ticket.', 'error');
    }
});

$(document).on('click', '.btnEnviarCorreoTicketHistorial', function() {
    const idPago = $(this).data('id-pago');
    const correoPaciente = $(this).data('correo-paciente');

    if (!idPago) {
        Swal.fire('Error', 'No se pudo obtener el ID del pago.', 'error');
        return;
    }
    // Por ahora, solo un mensaje. La implementación real requeriría AJAX y PHPMailer.
    Swal.fire('Próximamente', `Se enviaría el ticket del pago ID: ${idPago} al correo: ${correoPaciente || 'No disponible'}. Esta función aún no está implementada.`, 'info');
    
    // Aquí iría la lógica para llamar a un AJAX que envíe el correo con el ticket.
    // Ejemplo: enviarTicketPorCorreo(idPago, correoPaciente);
});
// --- FIN: Eventos para botones en el Historial de Pagos ---

// --- FIN: Lógica para Pagos ---
})();
// --- INICIO: Lógica para Pagos ---


</script>