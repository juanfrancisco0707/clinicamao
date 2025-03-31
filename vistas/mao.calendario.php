<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .calendar-container { padding: 20px; }
        .schedule { width: 100px; text-align: right; padding-right: 10px; }
        .calendar-wrapper { display: flex; }
    </style>
</head>
<body>
    <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Calendario</h4>
            <div>
                <button class="btn btn-primary" onclick="changeView('timeGridDay')">Día</button>
                <button class="btn btn-primary" onclick="changeView('timeGridWeek')">Semana</button>
                <button class="btn btn-primary" onclick="changeView('dayGridMonth')">Mes</button>
            </div>
        </div>
        <div class="calendar-wrapper">
            <div id="schedule" class="schedule d-none">
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
            </div>
            <div id="calendar" class="flex-grow-1"></div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var scheduleEl = document.getElementById('schedule');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                slotMinTime: "07:00:00",
                slotMaxTime: "20:00:00",
                events: [
                    {
                        title: 'Cita con Juan',
                        start: '2025-03-26T11:00:00',
                        allDay: false
                    }
                ]
            });
            calendar.render();
            
            window.changeView = function(view) {
                calendar.changeView(view);
                if (view === 'timeGridDay' || view === 'timeGridWeek') {
                    scheduleEl.classList.remove('d-none');
                } else {
                    scheduleEl.classList.add('d-none');
                }
            }
        });
    </script>
</body>
</html>
