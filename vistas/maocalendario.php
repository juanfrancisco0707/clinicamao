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

/* Para el título de los eventos */
#calendar .fc-event-title {
    color: #ffffff !important; /* Asumiendo que el fondo del evento es oscuro */
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
        <!-- <div id="schedule" class="schedule d-none">
           <div>07:00 AM</div>
            <div>08:00 AM</div>
            <div>09:00 AM</div>
            <div>10:00 AM</div>
            <div>11:00 AM</div>
            <div>12:00 PM</div>
            <div>01:00 PM</div>
            <div>02:00 PM</div>
            <div>03:00 PM</div>
            <div>04:00 PM</div>
            <div>05:00 PM</div>
            <div>06:00 PM</div>
            <div>07:00 PM</div>
            <div>08:00 PM</div>
        </div>-->
        <div id="calendar" class="flex-grow-1">
            <!-- El calendario se renderizará aquí -->
             
        </div>
    </div>
</div>

<script>
(function() {
    var calendarEl = document.getElementById('calendar');
    var scheduleEl = document.getElementById('schedule');
    var calendarInstance; // Declarar la instancia aquí para que sea accesible en changeView

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
        locale: 'es', // Descomenta si cargaste el locale 'es' en plantilla.php
        events: [
            {
                title: 'Cita con Juan',
                start: new Date().toISOString().slice(0,10) + 'T11:00:00', // Evento de ejemplo para hoy
                allDay: false
            }
            // Aquí puedes añadir más eventos o una URL para cargarlos
        ]
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
})();
</script>