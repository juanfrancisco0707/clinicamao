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

<script>
(function() {
    var calendarEl = document.getElementById('calendar');
    var scheduleEl = document.getElementById('schedule');
    var calendarInstance; // Declarar la instancia aquí para que sea accesible en changeView
    // Variables para el contexto de la cita/sesión activa para el historial
    let idPacienteCitaActiva = null;
    let idCitaParaRefrescarSesiones = null;

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
            // selectionInfo contiene start, end, allDay
            $('#modalCitaLabel').text('Registrar Nueva Cita');
            $('#formCita')[0].reset(); // Limpiar formulario
            $('#id_cita').val(''); // Limpiar ID para nuevo registro
            
            // Limpiar el contenedor de sesiones para una nueva cita
            $('#listaSesionesContainer').html('<p>No hay sesiones registradas para esta cita.</p>');

            // Formatear fecha y hora para datetime-local input
            // FullCalendar devuelve fechas en formato ISO. Necesitamos ajustarlo.
            let startDate = new Date(selectionInfo.startStr);
            if (!selectionInfo.allDay) {
                // Ajustar por la zona horaria local para que coincida con el input
                startDate.setMinutes(startDate.getMinutes() - startDate.getTimezoneOffset());
                $('#fechaHoraCita').val(startDate.toISOString().slice(0, 16));
            } else {
                // Si es allDay, podrías querer poner una hora por defecto, ej. 08:00
                let defaultTime = "08:00";
                $('#fechaHoraCita').val(selectionInfo.startStr + 'T' + defaultTime);
            }

            $('#estadoCita').val('Pendiente');
            $('#modalCita').modal('show');
        },
        eventClick: function(info) { // Cuando se hace clic en un evento existente
            $('#modalCitaLabel').text('Editar Cita');
            $('#formCita')[0].reset(); // Limpiar formulario

            $('#listaSesionesContainer').html('<p>Cargando sesiones...</p>'); // Placeholder

            // Hacemos una petición AJAX para obtener los detalles completos de la cita
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
                        // Asegurarse de que la fecha y hora estén en el formato correcto para datetime-local
                        // El formato de la BD es 'YYYY-MM-DD HH:MM:SS', el input necesita 'YYYY-MM-DDTHH:MM'
                        let fechaHoraFormateada = cita.fecha_hora.replace(' ', 'T').substring(0, 16);
                        $('#fechaHoraCita').val(fechaHoraFormateada);
                        $('#motivoCita').val(cita.motivo);
                        $('#estadoCita').val(cita.estado);
                        $('#modalCita').modal('show');
                        // Cargar sesiones para esta cita
                        cargarSesionesDeCita(cita.id_cita, cita.id_paciente); // Pasar id_paciente
                    } else {
                        Swal.fire('Error', 'No se pudieron obtener los detalles de la cita.', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Problema al obtener datos de la cita.', 'error');
                }
            });
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
                    if (idPacienteFicha) { // Usar el id de la ficha
                        cargarHistorialClinico(idPacienteFicha); // Recargar la lista
                    //if (idPacienteActual) {
                    //    cargarHistorialClinico(idPacienteActual); // Recargar la lista
                    }
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
    alert("Entrando al evento de edición de sesión");
    var idSesion = $(this).data('id-sesion');
    var idCitaOriginal = $(this).data('id-cita'); 
    alert("idCitaOriginal: " + idCitaOriginal);
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

})();
</script>